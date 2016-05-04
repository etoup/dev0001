<?php

namespace App\Repositories\Open\Loops;


use App\Models\Access\User\User;
use App\Models\Goods\Goods;
use App\Models\Loop\LoopsMessages;
use Carbon\Carbon;

/**
 * Class EloquentMessagesRepository
 * @package App\Repositories\Open\Loops
 */
class EloquentMessagesRepository implements MessagesRepositoryContract
{
    /**
     * @param $users_id
     * @param $loops_id
     * @param $contents
     * @param $loops_authority_id
     * @param int $pictures_id
     * @param int $goods_id
     * @return int
     */
    public function saveMessages($users_id,$loops_id,$contents,$loops_authority_id,$pictures_id = 0,$goods_id = 0){
        switch(intval($loops_authority_id)){
            case 4://文字
                $id = LoopsMessages::insertGetId([
                    'users_id' => $users_id,
                    'loops_id' => $loops_id,
                    'contents' => $contents,
                    'loops_authority_id' => $loops_authority_id,
                    'date_node' => Carbon::now()->toDateString()
                ]);
                break;
            case 5://图片
                $id = LoopsMessages::insertGetId([
                    'users_id' => $users_id,
                    'loops_id' => $loops_id,
                    'contents' => $contents,
                    'pictures_id' => $pictures_id,
                    'loops_authority_id' => $loops_authority_id,
                    'date_node' => Carbon::now()->toDateString()
                ]);
                break;
            case 6://拍照
                $id = LoopsMessages::insertGetId([
                    'users_id' => $users_id,
                    'loops_id' => $loops_id,
                    'contents' => $contents,
                    'pictures_id' => $pictures_id,
                    'loops_authority_id' => $loops_authority_id,
                    'date_node' => Carbon::now()->toDateString()
                ]);
                break;
            case 7://商品
                $id = LoopsMessages::insertGetId([
                    'users_id' => $users_id,
                    'loops_id' => $loops_id,
                    'contents' => $contents,
                    'pictures_id' => $pictures_id,
                    'goods_id' => $goods_id,
                    'loops_authority_id' => $loops_authority_id,
                    'date_node' => Carbon::now()->toDateString()
                ]);
                break;
            case 8://分享商品
                break;
            default:
                $id = 0;
        }

        return $id;
    }

    /**
     * @param $users_id
     * @param $loops_id
     * @param $pictures_id
     * @param $title
     * @param $profiles
     * @param $price
     * @param $stocks
     * @return mixed
     */
    public function saveGoods($users_id,$loops_id,$pictures_id,$title,$profiles,$price,$stocks){
        $id = Goods::insertGetId([
            'users_id' => $users_id,
            'loops_id' => $loops_id,
            'pictures_id'=>$pictures_id,
            'title' => $title,
            'profiles' => $profiles,
            'price' => $price,
            'numbers'=>$stocks,
            'stocks'=>$stocks
        ]);

        return $id;
    }

    /**
     * @param $users_id
     * @return mixed
     */
    public function getUsers($users_id){
        $users = User::select('name','nickname','headimgurl')->find($users_id);
        return $users;
    }
}
