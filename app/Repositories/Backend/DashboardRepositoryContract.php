<?php

namespace App\Repositories\Backend;

/**
 * Interface DashboardRepositoryContract
 * @package App\Repositories\Backend
 */
interface DashboardRepositoryContract
{
    /**
     * @return mixed
     */
    public function getCountList();

    /**
     * @return mixed
     */
    public function getNewUsers();

    /**
     * @return mixed
     */
    public function getNewGoods();

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getNewMessages($loops_id = 1);

    /**
     * @return mixed
     */
    public function getNewOrders();
}
