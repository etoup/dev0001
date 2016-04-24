<?php

namespace App\Repositories\Open\Ods;
use App\Models\Access\User\Business;
use App\Models\Access\User\UsersAddress;
use App\Models\Goods\Goods;
use App\Models\Ods\Orders;
use App\Exceptions\GeneralException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


/**
 * Class EloquentOrdersRepository
 * @package App\Repositories\Open\Ods
 */
class EloquentOrdersRepository implements OrdersRepositoryContract
{
    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrdersOrThrowException($id, $withRoles = false){
        if(!is_null(Orders::find($id))){
            return Orders::find($id);
        }
        throw new GeneralException('没有对应数据');
    }

    /**
     * @param $orders_number
     * @return mixed
     */
    public function findOrdersByNum($orders_number){
        return Orders::where('orders_numbers',$orders_number)->first();
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findGoodsOrThrowException($id, $withRoles = false){
        if($withRoles){
            $goods = Goods::with('pictures')->withTrashed()->find($id);
        }else{
            $goods = Goods::withTrashed()->find($id);
        }

        if(!is_null($goods)){
            return $goods;
        }
        throw new GeneralException('没有对应数据');
    }

    /**
     * @param $uid
     * @param $goods_id
     * @return mixed
     * @throws GeneralException
     */
    public function createOrders($uid,$goods_id){
        //商品信息
        $goods = $this->findGoodsOrThrowException($goods_id,true);
        //卖家信息
        if($goods->users_id){
            $business = Business::where('users_id',$goods->users_id)->first();
        }
        $orders_numbers = $this->getOrdersNumbers();
        $id = Orders::insertGetId(
            [
                'orders_numbers' => $orders_numbers,
                'users_id' => $uid,
                'goods_id' => $goods_id,
                'price'    => $goods->price,
                'business_id'=>$business?$business->id:0,
                'owner_id' => $goods->users_id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        $data = [];
        if($id){
            $data = [
                'path' => $goods->pictures->path,
                'price'=> $goods->price,
                'orders_numbers' => $orders_numbers
            ];
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getOrdersNumbers(){
        $orders_numbers = date('YmdHis').mt_rand(100000, 999999);
        $orders = Orders::where('orders_numbers',$orders_numbers)->first();
        if(!empty($orders)){
            $this->getOrdersNumbers();
        }
        return $orders_numbers;
    }

    /**
     * @param $uid
     * @param $name
     * @param $mobile
     * @param $address
     * @param $remark
     * @param $orders_numbers
     * @return bool
     */
    public function buyer($uid,$name,$mobile,$address,$remark,$orders_numbers){
        $id = UsersAddress::insertGetId(
            [
                'users_id'=>$uid,
                'real_name' => $name,
                'mobile' => $mobile,
                'address' => $address,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        if($id){
            if($remark){
                $data = ['users_address_id'=>$id,'remark'=>$remark];
            }else{
                $data = ['users_address_id'=>$id];
            }
            Orders::where('orders_numbers',$orders_numbers)->update($data);

            return true;
        }
        return false;
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function bought($goods_id){
        return Orders::where('goods.id','!=',$goods_id)
            ->leftJoin('goods', 'Orders.goods_id', '=', 'goods.id')
            ->leftJoin('pictures', 'goods.pictures_id', '=', 'pictures.id')
            ->groupBy('orders.goods_id')
            ->take(4)
            ->get();
    }
}
