<?php

namespace App\Repositories\Backend\Good;

/**
 * Interface GoodsRepositoryContract
 * @package App\Repositories\Backend\Good
 */
interface GoodsRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getGoodsPaginated($per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getLookGoodsPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param $input
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getSearchGoodsPaginated($input, $per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param $input
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function export($input, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $input
     * @return mixed
     */
    public function doDown($input);

    /**
     * @param $input
     * @return mixed
     */
    public function store($input);

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function lookOk($id,$status);

    /**
     * @param $input
     * @return mixed
     */
    public function lookNo($input);
}
