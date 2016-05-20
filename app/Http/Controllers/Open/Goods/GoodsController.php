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
    public function index(){

        $list = $this->goods->getGoods(Input::get('page'));

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->goods->getGoodsCount();
            $data = [
                'status' => false,
                'count' => intval($count),
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelFollows(){
        $back = $this->goods->cancelFollows(Input::get('id'));
        if($back){
            $data = [
                'status' => true
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '操作失败'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function follows(){
        $back = $this->goods->follows(Input::get('goods_id'),Input::get('uid'));
        if($back){
            $data = [
                'status' => true
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '操作失败'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function images(){
        $id = Input::get('id')?intval(Input::get('id')):0;
        $list = $this->goods->getImages($id);
        $map = [];
        if($pages = count($list)){
            $index = 0;
            foreach($list as $k => $v){
                $map['index'] = $index;
                $map['values'][] = $v->path;
            }
            $map['pages'] = $pages;
            $data = [
                'status' => true,
                'info' => $map
            ];
        }else{
            $data = [
                'status' => false
            ];
        }
        return response()->json($data);
    }
}
