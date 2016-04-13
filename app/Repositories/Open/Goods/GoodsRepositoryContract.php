<?php

namespace App\Repositories\Open\Goods;

/**
 * Interface GoodsRepositoryContract
 * @package App\Repositories\Open\Goods
 */
interface GoodsRepositoryContract
{

    /**
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getGoods($page,$take = 0);

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getFollows($goods_id);

}
