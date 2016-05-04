<?php

namespace App\Repositories\Open\Loops;

/**
 * Interface MessagesRepositoryContract
 * @package App\Repositories\Open\Loops
 */
interface MessagesRepositoryContract
{
    /**
     * @param $users_id
     * @param $loops_id
     * @param $contents
     * @param $loops_authority_id
     * @param int $pictures_id
     * @param $goods_id
     * @return mixed
     */
    public function saveMessages($users_id,$loops_id,$contents,$loops_authority_id,$pictures_id = 0,$goods_id = 0);

    /**
     * @param $users_id
     * @param $loops_id
     * @param $pictures_id
     * @param $title
     * @param $profiles
     * @param $price
     * @param $stocks
     * @return mixed
     */
    public function saveGoods($users_id,$loops_id,$pictures_id,$title,$profiles,$price,$stocks);

    /**
     * @param $users_id
     * @return mixed
     */
    public function getUsers($users_id);
}
