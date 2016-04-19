<?php

namespace App\Http\Controllers\Open\Ods;


use App\Http\Controllers\Controller;
use App\Repositories\Open\Ods\OrdersRepositoryContract;
use Illuminate\Support\Facades\Input;

class OrdersController extends Controller
{
    protected $orders;

    /**
     * @param OrdersRepositoryContract $orders
     */
    public function __construct(OrdersRepositoryContract $orders){
        $this->orders = $orders;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrders(){
        $list = $this->orders->createOrders(Input::get('uid'),Input::get('goods_id'));

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
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
    public function buyer(){
        $back = $this->orders->buyer(Input::get('uid'),Input::get('name'),Input::get('mobile'),Input::get('address'),Input::get('remark'),Input::get('orders_numbers'));
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
}
