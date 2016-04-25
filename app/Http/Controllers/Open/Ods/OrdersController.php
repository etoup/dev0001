<?php

namespace App\Http\Controllers\Open\Ods;


use App\Http\Controllers\Controller;
use App\Repositories\Open\Ods\OrdersRepositoryContract;
use Illuminate\Support\Facades\Input;

use EasyWeChat\Foundation\Application;

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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function bought(){
        $list = $this->orders->bought(Input::get('goods_id'));
        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '没有数据'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Core\Exceptions\FaultException
     */
    public function pay(){
        $options = [

            'app_id' => config('wechat.app_id'),
            'secret' => config('wechat.secret'),

            'payment' => [
                'merchant_id'        => config('wechat.payment.merchant_id'),
                'key'                => config('wechat.payment.key')
            ],
        ];
        $app = new Application($options);

        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "商户订单号" 获取订单
            $order = $this->orders->findOrdersByNum($notify->out_trade_no);

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status == 10) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                $order->status = 10; // 更新支付状态
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;
    }

}
