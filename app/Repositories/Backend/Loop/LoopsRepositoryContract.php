<?php

namespace App\Repositories\Backend\Loop;

/**
 * Interface LoopTagsRepositoryContract
 * @package App\Repositories\Backend\Loop
 */
interface LoopsRepositoryContract
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
     * @param $input
     * @return mixed
     */
    public function getInfoByInput($input);

    /**
     * @param $input
     * @return mixed
     */
    public function store($input);

    /**
     * @param $input
     * @return mixed
     */
    public function update($input);

    /**
     * @return mixed
     */
    public function getTags();

    /**
     * @return mixed
     */
    public function getTagsArray();

    /**
     * @param $types
     * @return mixed
     */
    public function getAuthorityList($types);

    /**
     * @param $id
     * @param $types
     * @param $role
     * @return mixed
     */
    public function getSetsList($id,$types,$role);

    /**
     * @param $per_page
     * @return mixed
     */
    public function getLoopsPaginated($per_page);

    /**
     * @param $input
     * @param $per_page
     * @return mixed
     */
    public function getSearchLoopsPaginated($input,$per_page);

    /**
     * @param $id
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getMsgsPaginated($id, $per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param $input
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getSearchMsgsPaginated($input, $per_page, $order_by = 'id', $sort = 'asc');

    /**
     * @param int $expires
     * @return mixed
     */
    public function cacheLiveness($expires = 1);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $input
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function export($input, $order_by = 'id', $sort = 'desc');

    /**
     * @param $id
     * @return mixed
     */
    public function cancelTop($id);

    /**
     * @param $id
     * @return mixed
     */
    public function doTop($id);

    /**
     * @param $id
     * @return mixed
     */
    public function msgDestroy($id);
}
