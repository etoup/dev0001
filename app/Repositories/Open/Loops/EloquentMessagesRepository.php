<?php

namespace App\Repositories\Open\Loops;


use App\Models\Access\User\User;
use App\Models\Goods\Goods;
use App\Models\Loop\LoopsFollows;
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
                $this->loopsFollows($users_id,$loops_id);
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
                $this->loopsFollows($users_id,$loops_id);
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
                $this->loopsFollows($users_id,$loops_id);
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
     * @param $loops_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getMessages($loops_id,$page,$take = 10){
        $skip = $page * $take;
        $messages = LoopsMessages::where('loops_id',$loops_id)
            ->select('loops_messages.id','loops_messages.users_id','loops_messages.contents','loops_messages.created_at','loops_authority.tags','users.nickname','users.headimgurl')
            ->leftJoin('loops_authority','loops_messages.loops_authority_id','=','loops_authority.id')
            ->leftJoin('users','loops_messages.users_id','=','users.id')
            ->orderBy('loops_messages.id','desc')
            ->skip($skip)
            ->take($take)
            ->get();
        if(count($messages)){
            foreach($messages as $k => $v){
                $diffInHours = $v->created_at->diffInHours();
                if($diffInHours >= 24){
                    $toTime = $v->created_at->toDateTimeString();
                }else{
                    $toTime = $v->created_at->toTimeString();
                }
                $messages[$k]['time'] = $toTime;
            }
        }
        return $messages;
    }

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getMessagesCount($loops_id){
        return LoopsMessages::where('loops_id',$loops_id)->count();
    }

    /**
     * @param $users_id
     * @param $loops_id
     * @return bool
     */
    public function loopsFollows($users_id,$loops_id){
        $info = LoopsFollows::where(['users_id'=>$users_id,'loops_id'=>$loops_id])->first();
        if(!count($info)){
            LoopsFollows::insert([
                'users_id' => $users_id,
                'loops_id' => $loops_id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        }
        return true;
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
