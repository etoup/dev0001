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
     * @param $loops_id
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getMessages($loops_id,$uid,$page,$take = 0);

    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getDiaries($uid,$page,$take = 0);

    /**
     * @param $uid
     * @return mixed
     */
    public function getDiariesCount($uid);

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getMessagesCount($loops_id);

    /**
     * @param $users_id
     * @param $loops_id
     * @return mixed
     */
    public function loopsFollows($users_id,$loops_id);

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

    /**
     * @param $messages_id
     * @return mixed
     */
    public function getImages($messages_id);

    /**
     * @param $pictures_id
     * @return mixed
     */
    public function getPicturesFollowsCount($pictures_id);

    /**
     * @param $uid
     * @param $pictures_id
     * @return mixed
     */
    public function picturesFollows($uid,$pictures_id);

    /**
     * @param $ids
     * @return mixed
     */
    public function getGoods($ids);

    /**
     * @param $id
     * @return mixed
     */
    public function getGoodsById($id);

    /**
     * @param $uid
     * @param $loops_id
     * @param $title
     * @param $loops_messages_ids
     * @return mixed
     */
    public function createDiary($uid,$loops_id,$title,$loops_messages_ids);

    /**
     * @param $goods_id
     * @param $loops_id
     * @param $uid
     * @return mixed
     */
    public function goodsLoops($goods_id,$loops_id,$uid);

}
