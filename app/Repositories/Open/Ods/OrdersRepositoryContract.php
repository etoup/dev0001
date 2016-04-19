<?php

namespace App\Repositories\Open\Ods;

/**
 * Interface OrdersRepositoryContract
 * @package App\Repositories\Open\Ods
 */
interface OrdersRepositoryContract
{
    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findOrdersOrThrowException($id, $withRoles = false);

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findGoodsOrThrowException($id, $withRoles = false);

    /**
     * @param $uid
     * @param $goods_id
     * @return mixed
     */
    public function createOrders($uid,$goods_id);

    /**
     * @return mixed
     */
    public function getOrdersNumbers();

    /**
     * @param $uid
     * @param $name
     * @param $mobile
     * @param $address
     * @param $remark
     * @param $orders_numbers
     * @return mixed
     */
    public function buyer($uid,$name,$mobile,$address,$remark,$orders_numbers);
}
