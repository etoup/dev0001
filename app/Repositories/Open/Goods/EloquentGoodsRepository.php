<?php

namespace App\Repositories\Open\Goods;

use App\Models\Goods\Goods;
use App\Models\Goods\GoodsFollows;
use App\Models\Goods\GoodsLoops;
use App\Models\Pictures\Pictures;

/**
 * Class EloquentGoodsRepository
 * @package App\Repositories\Open\Goods
 */
class EloquentGoodsRepository implements GoodsRepositoryContract
{

    /**
     *
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getGoods($page,$take = 10){
        $skip = $page * $take;
        $goods = Goods::with('pictures')->where('status',10)->orderBy('id')->skip($skip)->take($take)->get();
        if(count($goods)){
            foreach($goods as $k => $v){
                $goods[$k]['follows'] = $this->getFollows($v->id);
            }
        }
        return $goods;
    }

    /**
     *
     * @return mixed
     */
    public function getGoodsCount(){
        return Goods::where('status',10)->count();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInfoById($id){
        return Goods::with('pictures')->find($id);
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getFollows($goods_id){
        return GoodsFollows::where(['goods_id'=>$goods_id])->count();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function cancelFollows($id){
        return GoodsFollows::where('id',$id)->delete();
    }

    /**
     * @param $goods_id
     * @param $uid
     * @return mixed
     */
    public function follows($goods_id,$uid){
        return GoodsFollows::insertGetId(['goods_id'=>$goods_id,'users_id'=>$uid]);
    }

    /**
     * @param $goods_id
     * @param $uid
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getGoodsInfo($goods_id,$uid){
        $info = Goods::with('goods_pictures')->where('id',$goods_id)->first();
        //商品图片
        if(count($info->goods_pictures)){
            $collection = collect($info->goods_pictures);
            $plucked = $collection->pluck('pictures_id');
            $info['goods_pictures_path'] = Pictures::whereIn('id',$plucked->all())->get();
            unset($info->goods_pictures);
        }
        //关注数量
        $info['follows'] = $this->getFollows($goods_id);
        //是否关注
        $info['like'] = $this->isLike($goods_id,$uid);
        //推荐商品
        if(count($this->recommendGoods($goods_id)))
            $info['recommends'] = $this->recommendGoods($goods_id);
        //被分享的圈子
        if(count($this->collectionLoops($goods_id)))
            $info['collections'] = $this->collectionLoops($goods_id);
        return $info;
    }

    /**
     * @param $goods_id
     * @param int $uid
     * @return bool
     */
    public function isLike($goods_id,$uid=0){
        if($uid){
            $info = GoodsFollows::where(['goods_id'=>$goods_id,'users_id'=>$uid])->first();
            return count($info) ? ['has'=>true,'id'=>$info['id'],'goods_id'=>$goods_id,'users_id'=>$uid,'types'=>$info['types']] : ['has'=>false,'goods_id'=>$goods_id,'users_id'=>$uid,'types'=>$info['types']];
        }

        return ['has'=>false,'goods_id'=>$goods_id,'users_id'=>$uid,'types'=>0];
    }

    /**
     * @param $goods_id
     * @return array
     */
    public function recommendGoods($goods_id){
        $list = Goods::select('goods.id','pictures.path')
            ->where('goods.id','!=',$goods_id)
            ->where(function($query){
                $query->where('goods.status',10);
                })
            ->leftJoin('pictures', 'goods.pictures_id', '=', 'pictures.id')
            ->take(4)
            ->get();
        $map = [];
        if(count($list)){
            foreach($list as $k => $v){
                if($k%2 == 0){
                    $map[0][] = $v;
                }
                if($k%2 == 1){
                    $map[1][] = $v;
                }
            }
        }

        return $map;
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function collectionLoops($goods_id){
        return GoodsLoops::where('goods_id',$goods_id)
            ->select('loops.id','loops.title','loops.profiles','pictures.path','users.name','users.headimgurl')
            ->leftJoin('loops','goods_loops.loops_id','=','loops.id')
            ->leftJoin('pictures','loops.pictures_id','=','pictures.id')
            ->leftJoin('users','loops.users_id','=','users.id')
            ->get();
    }
}
