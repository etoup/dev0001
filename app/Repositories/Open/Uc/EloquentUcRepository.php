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
        return User::select('id','nickname','token')->where('token',$token)->first();
    }

    public function addInfo($nickname,$sex,$openid,$headimgurl,$country,$province,$city){
        $user       = new User;
        $user->name = $nickname;
        $user->nickname = $nickname;
        $user->sex = $sex;
        $user->token = md5($openid);
        $user->headimgurl = $headimgurl;
        $user->country = $country;
        $user->province = $province;
        $user->city = $city;
        $user->source = 1;
        $user->confirmed = 1;
        $user->save();
        $id = $user->id;

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
        }


        return $id;
    }

}
