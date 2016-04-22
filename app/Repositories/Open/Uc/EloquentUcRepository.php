<?php

namespace App\Repositories\Open\Uc;

use App\Models\Access\User\User;
use App\Models\Loop\LoopsFollows;
use Aobo\RongCloud\Facades\RongCloud;

/**
 * Class EloquentLoopTagsRepository
 * @package App\Repositories\Backend\Loop
 */
class EloquentUcRepository implements UcRepositoryContract
{

    /**
     * @param $token
     * @return mixed
     */
    public function getInfo($token){
        return User::select('id','nickname','token','headimgurl','loop_roles','name')->where('token',$token)->first();
    }

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
    public function addInfo($nickname,$sex,$openid,$headimgurl,$country,$province,$city){
        $id = User::insertGetId([
            'name'=>$nickname,
            'nickname'=>$nickname,
            'sex'=>$sex,
            'token'=>md5($openid),
            'headimgurl'=>$headimgurl,
            'country'=>$country,
            'province'=>$province,
            'city'=>$city,
            'source'=>1,
            'confirmed'=>1,
        ]);

        if($id){
            //关注
            $follows = new LoopsFollows;
            $follows->users_id = $id;
            $follows->loops_id = 1;
            $follows->save();

            //更新imToken
            $imTokenJson = RongCloud::getToken($id,$nickname,$headimgurl);
            $imTokenObj = json_decode($imTokenJson);
            User::where('id',$id)->update(['im_token'=>$imTokenObj->token]);

            return $id;
        }


        return 0;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getUser($uid){
        return User::find($uid);
    }

}
