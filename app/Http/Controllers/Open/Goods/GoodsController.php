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
                    'msg' => '没有数据'
                ]
            ];
        }

        return response()->json($data);
    }


}
