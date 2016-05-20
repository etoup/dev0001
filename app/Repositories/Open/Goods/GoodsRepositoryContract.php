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
     * @return mixed
     */
    public function getGoodsCount();

    /**
     * @param $id
     * @return mixed
     */
    public function getInfoById($id);

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getFollows($goods_id);

    /**
     * @param $id
     * @return mixed
     */
    public function cancelFollows($id);

    /**
     * @param $goods_id
     * @param $uid
     * @return mixed
     */
    public function follows($goods_id,$uid);

    /**
     * @param $goods_id
     * @param $uid
     * @return mixed
     */
    public function getGoodsInfo($goods_id,$uid);

    /**
     * @param $goods_id
     * @param int $uid
     * @return mixed
     */
    public function isLike($goods_id,$uid=0);

    /**
     * @param $goods_id
     * @return mixed
     */
    public function recommendGoods($goods_id);

    /**
     * @param $goods_id
     * @return mixed
     */
    public function collectionLoops($goods_id);

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getImages($goods_id);
}
