<?php

namespace App\Repositories\Open\My;

use App\Exceptions\GeneralException;
use App\Models\Loop\Loops;
use App\Models\Goods\Goods;
use App\Models\Ods\Orders;
use App\Models\Goods\GoodsFollows;
use App\Models\Loop\LoopsFollows;

/**
 * Class EloquentMyRepository
 * @package App\Repositories\Open\My
 */
class EloquentMyRepository implements MyRepositoryContract
{


    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findLoopsOrThrowException($id, $withRoles = false)
    {
        if (! is_null(Loops::find($id))) {

            return Loops::find($id);
        }

        throw new GeneralException('没有对应数据');
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findLoopsFollowsOrThrowException($id, $withRoles = false){
        if (! is_null(LoopsFollows::find($id))) {

            return LoopsFollows::find($id);
        }

        throw new GeneralException('没有对应数据');
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findGoodsOrThrowException($id, $withRoles = false)
    {
        if (! is_null(Goods::find($id))) {

            return Goods::find($id);
        }

        throw new GeneralException('没有对应数据');
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrdersOrThrowException($id, $withRoles = false)
    {
        if (! is_null(Orders::find($id))) {

            return Orders::find($id);
        }

        throw new GeneralException('没有对应数据');
    }

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function loops($uid,$page,$take = 2){
        $skip = $page * $take;
        $loops = Loops::with('pictures','users')->where('users_id',$uid)->orderBy('id')->skip($skip)->take($take)->get();
        return $loops;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function loopsCount($uid){
        return Loops::where('users_id',$uid)->count();
    }

    /**
     * @param $id
     * @param $uid
     * @return bool
     * @throws GeneralException
     */
    public function deleteLoops($id,$uid){
        $loops = $this->findLoopsOrThrowException($id,false);
        if($loops->delete()){
            return true;
        }

        throw new GeneralException('操作失败，请重试');
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function out($id){
        $loopsFollows = $this->findLoopsFollowsOrThrowException($id,false);
        if($loopsFollows->delete()){
            return true;
        }

        throw new GeneralException('操作失败，请重试');
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function goods($uid){
        $goods = Goods::with('pictures')->where('users_id',$uid)->orderBy('id')->get();
        return $goods;
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function pulled($id){
        $goods = $this->findGoodsOrThrowException($id,false);
        $goods->status = -1;
        if($goods->save()){
            return true;
        }

        throw new GeneralException('操作失败，请重试');
    }

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function sales($uid,$page,$take = 10){
        $skip = $page * $take;
        $orders = Orders::with('users','goods','business','users_address')->where('owner_id',$uid)->orderBy('id')->skip($skip)->take($take)->get();
        return $orders;
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function delivery($id){
        $orders = $this->findOrdersOrThrowException($id,false);
        $orders->status = 20;
        if($orders->save()){
            return true;
        }

        throw new GeneralException('操作失败，请重试');
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function salesCount($uid){
        return Orders::where('owner_id',$uid)->count();
    }

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function followsGoods($uid,$page,$take = 10){
        $skip = $page * $take;
        $followsGoods = GoodsFollows::where('goods_follows.users_id',$uid)
            ->leftJoin('goods', 'goods_follows.goods_id', '=', 'goods.id')
            ->leftJoin('pictures', 'goods.pictures_id', '=', 'pictures.id')
            ->orderBy('goods_follows.id')
            ->skip($skip)
            ->take($take)
            ->get();
        return $followsGoods;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function followsGoodsCount($uid){
        return GoodsFollows::where('users_id',$uid)->count();
    }

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function followsLoops($uid,$page,$take = 10){
        $skip = $page * $take;
        $followsLoops = LoopsFollows::where('loops_follows.users_id',$uid)
            ->select('loops_follows.id','loops_follows.loops_id','loops.title','users.headimgurl','pictures.path')
            ->leftJoin('loops', 'loops_follows.loops_id', '=', 'loops.id')
            ->leftJoin('pictures', 'loops.pictures_id', '=', 'pictures.id')
            ->leftJoin('users', 'loops.users_id', '=', 'users.id')
            ->orderBy('loops_follows.id')
            ->skip($skip)
            ->take($take)
            ->get();
        return $followsLoops;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function followsLoopsCount($uid){
        return LoopsFollows::where('users_id',$uid)->count();
    }

    /**
     * @param $uid
     * @param $status
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function orders($uid,$status,$page,$take = 10){
        $skip = $page * $take;
        $orders = Orders::with('goods')->where(['users_id'=>$uid,'status'=>$status])->orderBy('id','desc')->skip($skip)->take($take)->get();
        return $orders;
    }

    /**
     * @param $uid
     * @param $status
     * @return mixed
     */
    public function ordersCount($uid,$status){
        return Orders::where(['users_id'=>$uid,'status'=>$status])->count();
    }
}
