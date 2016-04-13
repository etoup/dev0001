<?php

namespace App\Http\Controllers\Open\Uc;

use App\Http\Controllers\Controller;
use App\Repositories\Open\Uc\UcRepositoryContract;
use Illuminate\Support\Facades\Input;


class UcController extends Controller
{
    protected $uc;

    public function __construct(UcRepositoryContract $uc){
        $this->uc = $uc;
    }

    public function getInfo(){
        $info = $this->uc->getInfo(md5(Input::get('openId')));
        if(count($info)){
            $data = [
                'status' => true,
                'info' => [
                    'uid' => $info['id'],
                    'nickname' => $info['nickname'],
                    'token' =>$info['token']
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
                    'id' => $id,
                    'nickname'=>Input::get('nickname'),
                    'headimgurl'=>Input::get('headimgurl'),
                    'token'=>md5(Input::get('openid'))
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
}
