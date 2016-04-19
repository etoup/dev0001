<?php

namespace App\Repositories\Open\My;

/**
 * Interface MyRepositoryContract
 * @package App\Repositories\Open\My
 */
interface MyRepositoryContract
{

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findLoopsOrThrowException($id, $withRoles = false);

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findLoopsFollowsOrThrowException($id, $withRoles = false);

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findGoodsOrThrowException($id, $withRoles = false);

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findOrdersOrThrowException($id, $withRoles = false);

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function loops($uid,$page,$take = 0);

    /**
     * @param $uid
     * @return mixed
     */
    public function loopsCount($uid);

    /**
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function deleteLoops($id,$uid);

    /**
     * @param $id
     * @return mixed
     */
    public function out($id);

    /**
     * @param $uid
     * @return mixed
     */
    public function goods($uid);

    /**
     * @param $id
     * @return mixed
     */
    public function pulled($id);

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function sales($uid,$page,$take = 0);

    /**
     * @param $id
     * @return mixed
     */
    public function delivery($id);

    /**
     * @param $uid
     * @return mixed
     */
    public function salesCount($uid);

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function followsGoods($uid,$page,$take = 0);

    /**
     * @param $uid
     * @return mixed
     */
    public function followsGoodsCount($uid);

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function followsLoops($uid,$page,$take = 0);

    /**
     * @param $uid
     * @return mixed
     */
    public function followsLoopsCount($uid);

    /**
     * @param $uid
     * @param $status
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function orders($uid,$status,$page,$take = 0);

    /**
     * @param $uid
     * @param $status
     * @return mixed
     */
    public function ordersCount($uid,$status);



}
