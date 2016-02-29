<?php

namespace App\Repositories\Backend\Od;

/**
 * Interface OrdersRepositoryContract
 * @package App\Repositories\Backend\Od
 */
interface OrdersRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $id
     * @return mixed
     */
    public function getInfo($id);

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getOrdersPaginated($per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param $input
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getSearchOrdersPaginated($input, $per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param $input
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function export($input, $order_by = 'id', $sort = 'asc');

    /**
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getOrdersStatusPaginated($per_page, $status = 0, $order_by = 'id', $sort = 'asc');

    /**
     * @param $input
     * @return mixed
     */
    public function store($input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);
}
