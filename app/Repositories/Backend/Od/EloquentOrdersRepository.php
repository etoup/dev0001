<?php

namespace App\Repositories\Backend\Od;

use App\Models\Access\User\UsersAddress;
use App\Exceptions\GeneralException;
use App\Models\Ods\Orders;


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

    public function getInfo($id){
        $info = Orders::with('users','goods','business','users_address')->find($id);
//        dd($info);
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
