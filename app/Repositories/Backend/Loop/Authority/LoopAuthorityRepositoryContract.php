<?php

namespace App\Repositories\Backend\Loop\Authority;

/**
 * Interface LoopAuthorityRepositoryContract
 * @package App\Repositories\Backend\Loop\Authority
 */
interface LoopAuthorityRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param  $input
     * @return mixed
     */
    public function store($input);

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getTagsPaginated($per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);
}
