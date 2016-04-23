<?php

namespace App\Http\Controllers\Open\Goods;


use App\Http\Controllers\Controller;
use App\Repositories\Open\Goods\GoodsRepositoryContract;
use Illuminate\Support\Facades\Input;

class GoodsController extends Controller
{
    protected $goods;

    /**
     * @param GoodsRepositoryContract $goods
     */
    public function __construct(GoodsRepositoryContract $goods){
        $this->goods = $goods;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($page){

        $list = $this->goods->getGoods($page);

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @param $id
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo($id,$uid){
        $list = $this->goods->getGoodsInfo($id,$uid);

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(){
        $list = $this->goods->getGoodsInfo(Input::get('goods_id'),Input::get('uid'));

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodsInfo(){
        $info = $this->goods->getInfoById(Input::get('id'));
        if($info){
            $data = [
                'status' => true,
                'info' => $info
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '无效商品'
                ]
            ];
        }

        return response()->json($data);
    }
}
