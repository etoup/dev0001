<?php

namespace App\Repositories\Open\My;

/**
 * Interface MyRepositoryContract
 * @package App\Repositories\Open\My
 */
interface MyRepositoryContract
{


    /**
     * @param $uid
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function loops($uid,$page,$take = 0);

}
