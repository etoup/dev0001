<?php

namespace App\Repositories\Backend\User;

use Carbon\Carbon;
use App\Models\Access\User\Business;
use App\Models\Access\User\User;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Role\RoleRepositoryContract;
use App\Exceptions\Backend\Access\User\UserNeedsRolesException;
use App\Repositories\Frontend\User\UserContract as FrontendUserContract;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentUserRepository implements UserContract
{
    /**
     * @var RoleRepositoryContract
     */
    protected $role;

    /**
     * @var FrontendUserContract
     */
    protected $user;

    /**
     * @param RoleRepositoryContract $role
     * @param FrontendUserContract $user
     */
    public function __construct(
        RoleRepositoryContract $role,
        FrontendUserContract $user
    )
    {
        $this->role = $role;
        $this->user = $user;
    }

    /**
     * @param  $id
     * @param  bool               $withRoles
     * @throws GeneralException
     * @return mixed
     */
    public function findOrThrowException($id, $withRoles = false)
    {
        if ($withRoles) {
            $user = User::with('roles','business')->withTrashed()->find($id);
        } else {
            $user = User::withTrashed()->find($id);
        }

        if (!is_null($user)) {
            return $user;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  int         $status
     * @return mixed
     */
    public function getUsersPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return User::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param $input
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getSearchUsersPaginated($input, $per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        $builder = User::where('status', $status)
            ->orderBy($order_by, $sort);

        if(count($input)){
            $fields_search = config('access.fields_search');

            foreach($input as $field => $value){
                if (empty($value)) {
                    continue;
                }
                if (!isset($fields_search[$field])) {
                    continue;
                }

                switch($field){
                    case 'date':
                        $date = explode('-',$value);
                        $value = [date('Y-m-d h:i:s',strtotime($date[0])),date('Y-m-d h:i:s',strtotime($date[1]))];
                        break;
                    default:
                        $value = [$value];
                }

                $search = $fields_search[$field];

                $builder->whereRaw($search['tags'], $value);
            }
        }

        $list = $builder->paginate($per_page);

        return $list;
    }

    /**
     * @param $input
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function export($input, $status = 1, $order_by = 'id', $sort = 'asc'){
        $builder = User::where('status', $status)
            ->orderBy($order_by, $sort);

        if(count($input)){
            $fields_search = config('access.fields_search');

            foreach($input as $field => $value){
                if (empty($value)) {
                    continue;
                }
                if (!isset($fields_search[$field])) {
                    continue;
                }

                switch($field){
                    case 'date':
                        $date = explode('-',$value);
                        $value = [date('Y-m-d h:i:s',strtotime($date[0])),date('Y-m-d h:i:s',strtotime($date[1]))];
                        break;
                    default:
                        $value = [$value];
                }

                $search = $fields_search[$field];

                $builder->whereRaw($search['tags'], $value);
            }
        }

        $list = $builder->get();

        $cellData = collect($list)->toArray();
        if(count($cellData)){
            foreach($cellData as $k => $v){
                $cellData[$k] = [
                    '用户ID' => $v['id'],
                    '用户名' => $v['name'],
                    '邮箱' => $v['email']?$v['email']:'NULL',
                    '手机号码' => $v['mobile']?$v['mobile']:'NULL',
                    '属性' => $v['loop_roles']?'圈主':'会员',
                    '认证' => $v['confirmed']?'yes':'no',
                    '创建时间' => $v['created_at']
                ];
            }
        }

        $file_name = 'Users-'.Carbon::now();

        Excel::create($file_name,function($excel) use ($cellData){
            $excel->sheet('用户列表', function($sheet) use ($cellData){
                $sheet->fromArray($cellData);
            });
        })->store('xls')->export('xls');
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedUsersPaginated($per_page)
    {
        return User::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllUsers($order_by = 'id', $sort = 'asc')
    {
        return User::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @param  $roles
     * @param  $permissions
     * @throws GeneralException
     * @throws UserNeedsRolesException
     * @return bool
     */
    public function create($input, $roles, $permissions)
    {
        $user = $this->createUserStub($input);

        if ($user->save()) {
            //User Created, Validate Roles
            $this->validateRoleAmount($user, $roles['assignees_roles']);

            //Attach new roles
            $user->attachRoles($roles['assignees_roles']);

            //Attach other permissions
            $user->attachPermissions($permissions['permission_user']);

            //Send confirmation email if requested
            if (isset($input['confirmation_email']) && $user->confirmed == 0) {
                $this->user->sendConfirmationEmail($user->id);
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param $input
     * @return bool
     */
    public function editBusiness($input){
        $business = isset($input['id']) ? Business::find($input['id']) : new Business;
        $business->users_id = $input['users_id'];
        $business->business_name = $input['business_name'];
        $business->business_mobile = $input['business_mobile'];
        $business->business_card = $input['business_card'];
        $business->business_card_bank = $input['business_card_bank'];
        $business->save();
        $business_id = $business->id;

        $user = User::find($input['users_id']);
        $user->business_id = $business_id;
        $user->save();

        return true;
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input, $roles, $permissions)
    {
        $user = $this->findOrThrowException($id);
        $this->checkUserByEmail($input, $user);

        if ($user->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $user->status    = isset($input['status']) ? 1 : 0;
            $user->confirmed = isset($input['confirmed']) ? 1 : 0;
            $user->save();

            $this->checkUserRolesCount($roles);
            $this->flushRoles($roles, $user);
            $this->flushPermissions($permissions, $user);

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return bool
     */
    public function updatePassword($id, $input)
    {
        $user = $this->findOrThrowException($id);

        //Passwords are hashed on the model
        $user->password = $input['password'];
        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        $user = $this->findOrThrowException($id);
        if ($user->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        $user = $this->findOrThrowException($id, true);

        //Detach all roles & permissions
        $user->detachRoles($user->roles);
        $user->detachPermissions($user->permissions);

        try {
            $user->forceDelete();
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function restore($id)
    {
        $user = $this->findOrThrowException($id);

        if ($user->restore()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param  $id
     * @param  $status
     * @throws GeneralException
     * @return bool
     */
    public function mark($id, $status)
    {
        if (access()->id() == $id && $status == 0) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user         = $this->findOrThrowException($id);
        $user->status = $status;

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.mark_error'));
    }

    /**
     * Check to make sure at lease one role is being applied or deactivate user
     *
     * @param  $user
     * @param  $roles
     * @throws UserNeedsRolesException
     */
    private function validateRoleAmount($user, $roles)
    {
        //Validate that there's at least one role chosen, placing this here so
        //at lease the user can be updated first, if this fails the roles will be
        //kept the same as before the user was updated
        if (count($roles) == 0) {
            //Deactivate user
            $user->status = 0;
            $user->save();

            $exception = new UserNeedsRolesException();
            $exception->setValidationErrors(trans('exceptions.backend.access.users.role_needed_create'));

            //Grab the user id in the controller
            $exception->setUserID($user->id);
            throw $exception;
        }
    }

    /**
     * @param  $input
     * @param  $user
     * @throws GeneralException
     */
    private function checkUserByEmail($input, $user)
    {
        //Figure out if email is not the same
        if ($user->email != $input['email']) {
            //Check to see if email exists
            if (User::where('email', '=', $input['email'])->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }

        }
    }

    /**
     * @param $roles
     * @param $user
     */
    private function flushRoles($roles, $user)
    {
        //Flush roles out, then add array of new ones
        $user->detachRoles($user->roles);
        $user->attachRoles($roles['assignees_roles']);
    }

    /**
     * @param $permissions
     * @param $user
     */
    private function flushPermissions($permissions, $user)
    {
        //Flush permissions out, then add array of new ones if any
        $user->detachPermissions($user->permissions);
        if (count($permissions['permission_user']) > 0) {
            $user->attachPermissions($permissions['permission_user']);
        }

    }

    /**
     * @param  $roles
     * @throws GeneralException
     */
    private function checkUserRolesCount($roles)
    {
        //User Updated, Update Roles
        //Validate that there's at least one role chosen
        if (count($roles['assignees_roles']) == 0) {
            throw new GeneralException(trans('exceptions.backend.access.users.role_needed'));
        }

    }

    /**
     * @param  $input
     * @return mixed
     */
    private function createUserStub($input)
    {
        $user                    = new User;
        $user->name              = $input['name'];
        $user->email             = $input['email'];
        $user->password          = bcrypt($input['password']);
        $user->status            = isset($input['status']) ? 1 : 0;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed         = isset($input['confirmed']) ? 1 : 0;
        return $user;
    }
}
