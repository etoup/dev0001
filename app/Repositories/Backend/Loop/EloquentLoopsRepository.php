<?php

namespace App\Repositories\Backend\Loop;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Access\User\User;
use App\Models\Loop\LoopsTags;
use App\Models\Loop\Loops;
use App\Models\Loop\LoopsDiaries;
use App\Models\Loop\LoopsAuthority;
use App\Models\Loop\LoopsSets;
use App\Models\Loop\LoopsUsers;
use App\Models\Loop\LoopsMessages;
use App\Models\Pictures\Pictures;
use App\Exceptions\GeneralException;

/**
 * Class EloquentLoopTagsRepository
 * @package App\Repositories\Backend\Loop
 */
class EloquentLoopsRepository implements LoopsRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return Loops::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInfo($id){
        $info = Loops::with('users','loops_tags' , 'pictures')->find($id);
        return $info;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function saveLoop($input){
        //获取用户ID
        $usersinfo = User::where('name',$input['username'])->first();
        //调整用户角色 10=圈主
        User::where('id',$usersinfo['id'])->update(['loop_roles'=>10]);

        //保存圈子
        $loop = isset($input['id']) ? $this->find($input['id']) : new Loops;
        $loop->users_id = $usersinfo['id'];
        $loop->loops_tags_id = $input['loops_tags_id'];
        $loop->title = $input['title'];
        $loop->profiles = $input['profiles'];
        $loop->save();
        $loop_id = $loop->id;

        return $loop_id;
    }

    /**
     * @param $loop_id
     * @param $input
     * @return mixed
     */
    public function savePictures($loop_id,$input){
        $pictures = isset($input['pictures_id']) ? Pictures::find($input['pictures_id']) : new Pictures;
        $pictures->foreign_id = $loop_id;
        $pictures->path = config('pictures.qiniu_host').'/'.$input['key'];
        $pictures->key = $input['key'];
        $pictures->types = 3;
        $pictures->save();
        $pictures_id = $pictures->id;

        return $pictures_id;
    }

    /**
     * @param $loop_id
     * @param $input
     * @param bool $clear
     */
    public function saveSets($loop_id,$input,$clear = false){

        //是否清空权限
        $clear and LoopsSets::where('loops_id',$input['id'])->delete();

        //保存权限
        $catas = isset($input['catas']) ? $input['catas'] : [];
        $catas_user = isset($input['catas_user']) ? $input['catas_user'] : [];
        $funs = isset($input['funs']) ? $input['funs'] : [];
        $funs_user = isset($input['funs_user']) ? $input['funs_user'] : [];

        if(count($catas) and count($catas_user)){
            $catas_loop = $catas + $catas_user;

            foreach($catas_loop as $v){
                $loop_sets = new LoopsSets;
                $loop_sets->loops_id = $loop_id;
                $loop_sets->loops_authority_id = $v;
                $loop_sets->loop_roles = 10;
                $loop_sets->save();
            }

            foreach($catas_user as $val){
                $loop_sets = new LoopsSets;
                $loop_sets->loops_id = $loop_id;
                $loop_sets->loops_authority_id = $val;
                $loop_sets->save();
            }
        }

        if(count($funs) and count($funs_user)){
            $funs_loop = $funs + $funs_user;

            foreach($funs_loop as $v){
                $loop_sets = new LoopsSets;
                $loop_sets->loops_id = $loop_id;
                $loop_sets->loops_authority_id = $v;
                $loop_sets->types = 1;
                $loop_sets->loop_roles = 10;
                $loop_sets->save();
            }

            foreach($funs_user as $val){
                $loop_sets = new LoopsSets;
                $loop_sets->loops_id = $loop_id;
                $loop_sets->loops_authority_id = $val;
                $loop_sets->types = 1;
                $loop_sets->save();
            }
        }
    }

    /**
     * @param $input
     * @return bool
     */
    public function store($input)
    {
        //保存圈子
        $loop_id = $this->saveLoop($input);

        //保存图片
        $pictures_id = $this->savePictures($loop_id,$input);

        //更新封面
        Loops::where('id',$loop_id)->update(['pictures_id'=>$pictures_id]);

        //保存权限
        $this->saveSets($loop_id,$input);

        return true;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function update($input)
    {
        //保存圈子
        $loop_id = $this->saveLoop($input);

        //保存图片
        $this->savePictures($loop_id,$input);

        //保存权限
        $this->saveSets($loop_id,$input,true);

        return true;
    }

    /**
     * @return mixed
     */
    public function getTags(){
        return LoopsTags::get();
    }

    /**
     * @return mixed
     */
    public function getTagsArray(){
        return LoopsTags::orderBy('id')->lists('title','id');
    }

    /**
     * @param $types
     * @return mixed
     */
    public function getAuthorityList($types){
        return LoopsAuthority::where('types',$types)->get();
    }

    /**
     * @param $id
     * @param $types
     * @param $role
     * @return mixed
     */
    public function getSetsList($id,$types,$role){
        $sets = $this->getAuthorityList($types);
        if(count($sets)){
            foreach($sets as $k => $v){
                $info = LoopsSets::where(['loops_id'=>$id,'types'=>$types,'loop_roles'=>$role,'loops_authority_id'=>$v->id])->first();

                if(count($info)){
                    $sets[$k]['select'] = true;
                }else{
                    $sets[$k]['select'] = false;
                }
            }
        }
        return $sets;
    }

    /**
     * @param $per_page
     * @return mixed
     */
    public function getLoopsPaginated($per_page)
    {
        $list = Loops::with('users','loops_tags')
            ->orderBy('types')
            ->orderBy('sort')
            ->orderBy('created_at','desc')
            ->paginate($per_page);

        if(!empty($list)){
            foreach($list as $k => $v){
                $where = ['loops_id'=> $v->id];
                $diaries = LoopsDiaries::where($where)->count();
                $members = LoopsUsers::where(['loops_id'=> $v->id,'types'=>0])->count();
                $last_msg_time = LoopsMessages::where($where)->orderBy('id','desc')->pluck('created_at')->first();
                $list[$k]['diaries'] = $diaries;
                $list[$k]['members'] = $members;
                $list[$k]['last_msg_time'] = $last_msg_time;
            }
        }
        return $list;
    }

    /**
     * @param $id
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getMsgsPaginated($id, $per_page, $order_by = 'id', $sort = 'desc'){
        $list = LoopsMessages::where('loops_id',$id)
            ->orderBy($order_by, $sort)
            ->groupBy('date_node')
            ->paginate($per_page);
        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['li'] = LoopsMessages::with('users','loops_authority')
                    ->where(['loops_id'=>$id,'date_node'=>$v->date_node])
                    ->orderBy($order_by, $sort)
                    ->get();
            }
        }
//        dd($list);
        return $list;
    }

    /**
     * @param int $expires
     * @return mixed
     */
    public function cacheLiveness($expires = 1){

        if(!Cache::has('liveness')) {
            $list = Loops::get();
            if(!empty($list)){
                foreach ($list as $k => $v) {
                    $where = ['loops_id' => $v->id];
                    $diaries = LoopsDiaries::where($where)->count();
                    $members = LoopsUsers::where(['loops_id' => $v->id, 'types' => 0])->count();
                    $last_msg_time = LoopsMessages::where($where)->orderBy('id', 'desc')->pluck('created_at')->first();
                    $diff = strtotime(date('Y-m-d h:i:s')) - (strtotime($last_msg_time));

                    $this->getLiveness($v->id, $members, $diff, $diaries);
                }
                $expiresAt = Carbon::now()->addMinutes($expires);

                Cache::put('liveness', true, $expiresAt);

                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $loop = $this->find($id);
        if ($loop->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.loop.destroy-error'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function cancelTop($id){
        $info = $this->find($id);
        if($info->loops_tags_id ==1 and $info->sort == 0){
            $info->sort = 1;
            $info->save();
            return true;
        }else{
            throw new GeneralException('无效操作');
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function doTop($id){
        $info = $this->find($id);
        if($info->loops_tags_id ==1 and $info->sort == 1){
            //取消已经置顶项目
            Loops::where('sort',0)->update(['sort'=>1]);
            $info->sort = 0;
            $info->save();
            return true;
        }else{
            throw new GeneralException('无效操作');
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function msgDestroy($id){
        $msg = LoopsMessages::find($id);

        if ($msg->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.loop.msg-destroy-error'));
    }

    /**
     * 活跃度=圈子人数+（1/圈子最近发言时间到当前时间的差）*5000+圈主日记数量*5
     */
    private function getLiveness($id,$members,$diff,$diaries){

        $liveness = $members + (1/$diff)*5000 + $diaries*5;

        if($liveness){
            Loops::where('id',$id)->update(['liveness'=>$liveness]);
        }
    }

}
