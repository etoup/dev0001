<?php

namespace App\Repositories\Backend\Od;

use App\Models\Access\User\UsersAddress;
use App\Exceptions\GeneralException;
use App\Models\Ods\Orders;


/**
 * Class EloquentOrdersRepository
 * @package App\Repositories\Backend\Od
 */
class EloquentOrdersRepository implements OrdersRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return Orders::find($id);
    }

    public function getInfo($id){
        $info = Orders::with('users','goods','business','users_address')->find($id);
//        dd($info);
        return $info;
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getOrdersPaginated($per_page, $order_by = 'id', $sort = 'desc')
    {
        $list = Orders::with('users','goods','business','users_address')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);

        return $list;
    }

    /**
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getOrdersStatusPaginated($per_page, $status = 0, $order_by = 'id', $sort = 'asc'){
        $list = Orders::with('users')
            ->where('status',$status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
//        dd($list);
        return $list;
    }

    public function store($input){
        $orders = $this->find($input['id']);
        if (isset($input['status'])) {
            $orders->status = $input['status'];
            if(isset($input['price'])){
                $orders->price = $input['price'];
            }
            $orders->save();
            if(isset($input['address']) and isset($input['code'])){
                $user_address = UsersAddress::find($orders->users_address_id);
                $user_address->address = $input['address'];
                $user_address->code = $input['code'];
                $user_address->save();
            }
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.orders.store-error'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $orders = $this->find($id);
        if ($orders->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.orders.destroy-error'));
    }
}
