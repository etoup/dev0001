<?php

namespace App\Repositories\Open\Loops;

/**
 * Interface LoopsRepositoryContract
 * @package App\Repositories\Open\Loops
 */
interface LoopsRepositoryContract
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getTags($limit = 0);

    /**
     * @param $id
     * @return mixed
     */
    public function getLoopById($id);

    /**
     * @param $tags_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getLoops($tags_id,$page,$take = 0);

    /**
     * @param $tags_id
     * @return mixed
     */
    public function getLoopsCount($tags_id);

    /**
     * @param $uid
     * @return mixed
     */
    public function getLoopsCountByUid($uid);

    /**
     * @param $tags_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getHotLoops($tags_id,$page,$take = 0);

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getFollowsLoops($uid,$page,$take = 0);

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getFollows($loops_id);

    /**
     * @param $uid
     * @param $loops_id
     * @param $types
     * @return mixed
     */
    public function getSets($uid,$loops_id,$types);

    /**
     * @param $loops_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getGoods($loops_id,$page,$take = 0);

    /**
     * @param $loops_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getUsers($loops_id,$page,$take = 0);

    /**
     * @param $ids
     * @return mixed
     */
    public function delUsers($ids);

}
