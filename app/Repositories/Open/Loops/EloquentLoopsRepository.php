<?php

namespace App\Repositories\Open\Loops;

use App\Models\Goods\Goods;
use App\Models\Loop\Loops;
use App\Models\Loop\LoopsSets;
use App\Models\Loop\LoopsTags;
use App\Models\Loop\LoopsFollows;

/**
 * Class EloquentLoopTagsRepository
 * @package App\Repositories\Backend\Loop
 */
class EloquentLoopsRepository implements LoopsRepositoryContract
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getTags($limit = 0){
        if($limit)
            return LoopsTags::select('id','title','types')->orderBy('sort')->take($limit)->get();
        else
            return LoopsTags::select('id','title','types')->orderBy('sort')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getLoopById($id){
        return Loops::with('pictures','users')->where('id',$id)->first();
    }

    /**
     * @param $tags_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getLoops($tags_id,$page,$take = 10){
        $skip = $page * $take;
        return Loops::with('pictures','users')->where('loops_tags_id',$tags_id)->orderBy('liveness','desc')->skip($skip)->take($take)->get();
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getLoopsOwn($uid){
        return Loops::where('users_id',$uid)->first();
    }

    /**
     * @param $tags_id
     * @return mixed
     */
    public function getLoopsCount($tags_id){
        return Loops::where('loops_tags_id',$tags_id)->count();
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getLoopsCountByUid($uid){
        return LoopsFollows::where('users_id',$uid)->count();
    }
    /**
     * @param $tags_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getHotLoops($tags_id,$page,$take = 10){
        $skip = $page * $take;
        return Loops::with('pictures','users')->where('loops_tags_id',$tags_id)->orderBy('id')->skip($skip)->take($take)->get();
    }

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getFollowsLoops($uid,$page,$take = 10){
        $skip = $page * $take;
        return LoopsFollows::where(['users_id'=>$uid])->orderBy('id')->skip($skip)->take($take)->get();

    }

    /**
     * @param $uid
     * @param $loops_id
     * @return mixed
     */
    public function hasFollows($uid,$loops_id){
        return LoopsFollows::where(['users_id'=>$uid,'loops_id'=>$loops_id])->first();
    }

    /**
     * @param $uid
     * @param $loops_id
     * @return mixed
     */
    public function join($uid,$loops_id){
        return LoopsFollows::insertGetId(['users_id'=>$uid,'loops_id'=>$loops_id]);
    }

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getFollows($loops_id){
        return LoopsFollows::where('loops_id',$loops_id)->count();
    }

    /**
     * @param $uid
     * @param $loops_id
     * @param int $types
     * @return mixed
     */
    public function getSets($uid,$loops_id,$types = 0){
        $loops = Loops::where('id',$loops_id)->first();
        $loop_roles = $loops->users_id == $uid ? 10 : 0;
        return LoopsSets::where(['loops_id' => $loops_id,'loops_sets.types' => $types,'loop_roles' => $loop_roles])
            ->leftJoin('loops_authority', 'loops_sets.loops_authority_id', '=', 'loops_authority.id')
            ->get();
    }

    /**
     * @param $loops_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getGoods($loops_id,$page,$take = 10){
        $skip = $page * $take;
        return Goods::where(['loops_id'=>$loops_id,'goods.status'=>10])
            ->select('goods.id','goods.title','pictures.path')
            ->leftJoin('pictures', 'goods.pictures_id', '=', 'pictures.id')
            ->orderBy('goods.id')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    /**
     * @param $loops_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getUsers($loops_id,$page,$take = 10){
        $skip = $page * $take;
        return LoopsFollows::where(['loops_id' => $loops_id,'types'=>0])
            ->select('loops_follows.id','users.name','users.headimgurl')
            ->leftJoin('users', 'loops_follows.users_id', '=', 'users.id')
            ->orderBy('loops_follows.id')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getUsersCount($loops_id){
        return LoopsFollows::where(['loops_id' => $loops_id,'types'=>0])->count();
    }

    /**
     * @param $ids
     * @return bool
     */
    public function delUsers($ids){
        if(is_array($ids)){
            LoopsFollows::whereIn('id',$ids)->delete();
            return true;
        }else{
            return false;
        }
    }
}
