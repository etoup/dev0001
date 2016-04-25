<?php

namespace App\Http\Controllers\Open\Uc;

use App\Http\Controllers\Controller;
use App\Repositories\Open\Uc\UcRepositoryContract;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;


class UcController extends Controller
{
    protected $uc;

    public function __construct(UcRepositoryContract $uc){
        $this->uc = $uc;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(){
        $info = $this->uc->getInfo(Crypt::decrypt(Input::get('openId')));

        if(count($info)){
            $data = [
                'status' => true,
                'info' => [
                    'uid' => $info->id,
                    'nickname' => $info->nickname,
                    'token' =>$info->token
                ]
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '出错了'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addInfo(){

        $id = $this->uc->addInfo(
            Input::get('nickname'),
            Input::get('sex'),
            Input::get('openid'),
            Input::get('headimgurl'),
            Input::get('country'),
            Input::get('province'),
            Input::get('city')
        );

        if($id){
            $data = [
                'status' => true,
                'info' => [
                    'uid' => $id,
                    'nickname'=>Input::get('nickname'),
                    'token'=>Crypt::encrypt(Input::get('openid'))
                ]
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '出错了'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(){
        $info = $this->uc->getUser(intval(Input::get('uid')));
        if($info){
            $data = [
                'status' => true,
                'info' => $info
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '出错了'
                ]
            ];
        }

        return response()->json($data);

    }

    /**
     * @param $token
     * @return mixed
     */
    public function token($token){
        return Crypt::encrypt($token);
    }
}
