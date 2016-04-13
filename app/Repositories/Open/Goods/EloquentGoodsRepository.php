<?php

namespace App\Repositories\Open\Goods;

use App\Models\Goods\Goods;
use App\Models\Goods\GoodsFollows;

/**
 * Class EloquentGoodsRepository
 * @package App\Repositories\Open\Goods
 */
class EloquentGoodsRepository implements GoodsRepositoryContract
{

    /**
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getGoods($page,$take = 10){
        $skip = $page * $take;
        $goods = Goods::with('pictures')->orderBy('id')->skip($skip)->take($take)->get();
        if(count($goods)){
            foreach($goods as $k => $v){
                $goods[$k]['follows'] = $this->getFollows($v->id);
            }
        }
        return $goods;
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getFollows($goods_id){
        return GoodsFollows::where('goods_id',$goods_id)->count();
    }
}
