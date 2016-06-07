<?php

namespace App\Repositories\Backend\Od;

use App\Models\Goods\GoodsPictures;
use Carbon\Carbon;
use App\Models\Access\User\UsersAddress;
use App\Exceptions\GeneralException;
use App\Models\Ods\Orders;
use Maatwebsite\Excel\Facades\Excel;


/**
 * Class EloquentOrdersRepository
 * @package App\Repositories\Backend\Od
 */
class EloquentOrdersRepository implements OrdersRepositoryContract
{

    protected $fields_search = [
        'orders_numbers' => [
            'label' => '订单号',
            'tags' => "orders_numbers like CONCAT('%', ?, '%')"
        ],
        'goods_id'  => [
            'label' => '商品ID',
            'tags'  => "goods_id = ?"
        ],
        'status'  => [
            'label' => '订单状态',
            'tags'  => "status = ?"
        ],
        'date'  => [
            'label' => '发布时间',
            'tags'  => "created_at between ? and ?"
        ]
    ];

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return Orders::find($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getInfo($id){
        $info = Orders::with('users','goods','business','users_address')->find($id);
        if($info){
            $info['pictures'] = GoodsPictures::where('goods_id',$info->goods_id)
                ->leftJoin('pictures','goods_pictures.pictures_id','=','pictures.id')
                ->get();
        }
        return $info;
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getOrdersPaginated($per_page, $order_by = 'id', $sort = 'desc')
    {
        $list = Orders::with('users','goods','business','users_address')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);

        return $list;
    }

    /**
     * @param $input
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getSearchOrdersPaginated($input, $per_page, $order_by = 'id', $sort = 'desc')
    {
        $builder = Orders::with('users','goods','business','users_address')
            ->orderBy($order_by, $sort);

        if(count($input)){
            foreach($input as $field => $value){
                if (empty($value)) {
                    continue;
                }
                if (!isset($this->fields_search[$field])) {
                    continue;
                }

                switch($field){
                    case 'date':
                        $date = explode('-',$value);
                        $value = [date('Y-m-d h:i:s',strtotime($date[0])),date('Y-m-d h:i:s',strtotime($date[1]))];
                        break;
                    default:
                        $value = [$value];
                }

                $search = $this->fields_search[$field];
                $builder->whereRaw($search['tags'], $value);
            }
        }

        $list = $builder->paginate($per_page);

        return $list;
    }

    /**
     * @param $input
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function export($input, $order_by = 'id', $sort = 'desc'){
        $builder = Orders::with('users','goods','business','users_address')
            ->orderBy($order_by, $sort);

        if(count($input)){
            foreach($input as $field => $value){
                if (empty($value)) {
                    continue;
                }
                if (!isset($this->fields_search[$field])) {
                    continue;
                }

                switch($field){
                    case 'date':
                        $date = explode('-',$value);
                        $value = [date('Y-m-d h:i:s',strtotime($date[0])),date('Y-m-d h:i:s',strtotime($date[1]))];
                        break;
                    default:
                        $value = [$value];
                }

                $search = $this->fields_search[$field];
                $builder->whereRaw($search['tags'], $value);
            }
        }

        $list = $builder->get();

        $cellData = collect($list)->toArray();
        if(count($cellData)){
            foreach($cellData as $k => $v){
                $cellData[$k] = [
                    '订单ID' => $v['id'],
                    '订单号' => $v['orders_numbers'],
                    '商品名称' => $v['goods']['title'],
                    '金额' => $v['price']?$v['price']:0.00,
                    '买家' => $v['users']['name']?$v['users']['name']:'NULL',
                    '买家手机' => $v['users']['mobile']?$v['users']['mobile']:'NULL',
                    '收货地址' => $v['users_address']['address']?$v['users_address']['address']:'NULL',
                    '邮编' => $v['users_address']['code']?$v['users_address']['code']:'NULL',
                    '状态' => config('orders.orders_status')[$v['status']],
                    '卖家' => $v['business']['business_name']?$v['business']['business_name']:'NULL',
                    '卖家手机' => $v['business']['business_mobile']?$v['business']['business_mobile']:'NULL',
                    '卖家卡号' => $v['business']['business_card']?$v['business']['business_card']:'NULL',
                    '支行' => $v['business']['business_card_bank']?$v['business']['business_card_bank']:'NULL',
                    '创建时间' => $v['created_at']
                ];
            }
        }

        $file_name = 'Orders-'.Carbon::now();

        Excel::create($file_name,function($excel) use ($cellData){
            $excel->sheet('订单列表', function($sheet) use ($cellData){
                $sheet->fromArray($cellData);
            });
        })->store('xls')->export('xls');
    }

    /**
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getOrdersStatusPaginated($per_page, $status = 0, $order_by = 'id', $sort = 'asc'){
        $list = Orders::with('users')
            ->where('status',$status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
//        dd($list);
        return $list;
    }

    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function store($input){
        $orders = $this->find($input['id']);
        if (isset($input['status'])) {
            $orders->status = $input['status'];
            if(isset($input['price'])){
                $orders->price = $input['price'];
            }
            $orders->save();
            if(isset($input['address']) and isset($input['code'])){
                $user_address = UsersAddress::find($orders->users_address_id);
                $user_address->address = $input['address'];
                $user_address->code = $input['code'];
                $user_address->save();
            }
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.orders.store-error'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $orders = $this->find($id);
        if ($orders->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.orders.destroy-error'));
    }
}
