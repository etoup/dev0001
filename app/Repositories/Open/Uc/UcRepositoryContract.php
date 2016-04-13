<?php

namespace App\Repositories\Open\Uc;

/**
 * Interface UcRepositoryContract
 * @package App\Repositories\Open\Uc
 */
interface UcRepositoryContract
{

    /**
     * @param $token
     * @return mixed
     */
    public function getInfo($token);

    /**
     * @param $nickname
     * @param $sex
     * @param $openid
     * @param $headimgurl
     * @param $country
     * @param $province
     * @param $city
     * @return mixed
     */
    public function addInfo($nickname,$sex,$openid,$headimgurl,$country,$province,$city);

}
