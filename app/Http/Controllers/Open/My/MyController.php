<?php

namespace App\Http\Controllers\Open\My;

use App\Http\Controllers\Controller;
use App\Repositories\Open\My\MyRepositoryContract;
use Illuminate\Support\Facades\Input;


class MyController extends Controller
{
    protected $my;

    public function __construct(MyRepositoryContract $my){
        $this->my = $my;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function loops(){
        $list = $this->my->loops(Input::get('uid'),Input::get('page'));
        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->loopsCount(Input::get('uid'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteLoops(){
        $back = $this->my->deleteLoops(Input::get('id'),Input::get('uid'));

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
    public function out(){
        $back = $this->my->out(Input::get('id'));

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
     * @param $uid
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLoops($uid,$page){
        $data = $this->my->loops($uid,$page);
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function goods(){
        $data = $this->my->goods(Input::get('uid'));
        $collection = collect($data);
        $list = $collection->groupBy('status');

        return response()->json($list);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function pulled(){
        $back = $this->my->pulled(Input::get('id'));

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
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoods($uid){
        $data = $this->my->goods($uid);
        $collection = collect($data);
        $list = $collection->groupBy('status');

        return response()->json($list);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function sales(){
        $list = $this->my->sales(Input::get('uid'),Input::get('page'));
        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['status_txt'] = config('orders.orders_status')[$v->status];
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->salesCount(Input::get('uid'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function delivery(){
        $back = $this->my->delivery(Input::get('id'));

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
     * @param $uid
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSales($uid,$page){
        $data = $this->my->sales($uid,$page);
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function followsGoods(){
        $list = $this->my->followsGoods(Input::get('uid'),Input::get('page'));
        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->followsGoodsCount(Input::get('uid'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @param $uid
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowsGoods($uid,$page){
        $data = $this->my->followsGoods($uid,$page);
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function followsLoops(){
        $list = $this->my->followsLoops(Input::get('uid'),Input::get('page'));
        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->followsLoopsCount(Input::get('uid'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @param $uid
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowsLoops($uid,$page){
        $data = $this->my->followsLoops($uid,$page);
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ordersUnpaid(){
        $list = $this->my->orders(Input::get('uid'),Input::get('status'),Input::get('page'));
        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['status_txt'] = config('orders.orders_status')[$v->status];
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->ordersCount(Input::get('uid'),Input::get('status'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ordersPaid(){
        $list = $this->my->orders(Input::get('uid'),Input::get('status'),Input::get('page'));
        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['status_txt'] = config('orders.orders_status')[$v->status];
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->ordersCount(Input::get('uid'),Input::get('status'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ordersDelivery(){
        $list = $this->my->orders(Input::get('uid'),Input::get('status'),Input::get('page'));
        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['status_txt'] = config('orders.orders_status')[$v->status];
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->ordersCount(Input::get('uid'),Input::get('status'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ordersDeal(){
        $list = $this->my->orders(Input::get('uid'),Input::get('status'),Input::get('page'));
        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['status_txt'] = config('orders.orders_status')[$v->status];
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->my->ordersCount(Input::get('uid'),Input::get('status'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }
}
