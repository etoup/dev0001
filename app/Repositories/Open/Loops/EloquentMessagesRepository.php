<?php

namespace App\Repositories\Open\Loops;


use App\Models\Access\User\User;
use App\Models\Goods\Goods;
use App\Models\Goods\GoodsLoops;
use App\Models\Loop\LoopsDiaries;
use App\Models\Loop\LoopsDiariesMessages;
use App\Models\Loop\LoopsFollows;
use App\Models\Loop\LoopsMessages;
use App\Models\Pictures\PicturesFollows;
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
            default:
                $id = 0;
        }

        return $id;
    }

    /**
     * @param $loops_id
     * @param $uid
     * @param int $page
     * @param int $take
     * @return mixed
     */
    public function getMessages($loops_id,$uid,$page,$take = 10){
        $skip = $page * $take;
        $messages = LoopsMessages::where(['loops_id'=>$loops_id])
            ->whereIn('loops_authority_id',[4,5,6,8])
            ->select('loops_messages.id','loops_messages.users_id','loops_messages.goods_id','loops_messages.pictures_id','loops_messages.contents','loops_messages.created_at','loops_authority.tags','users.nickname','users.headimgurl')
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
                switch($v->tags){
                    case 'my-img':
                    case 'my-photo':
                        $messages[$k]['pictures_follows'] = $this->getPicturesFollowsCount($v->pictures_id);
                        $messages[$k]['followed'] = $this->picturesFollowed($uid,$v->pictures_id);
                        break;
                    case 'my-share':
                        $info = $this->getGoodsById($v->goods_id);
                        $messages[$k]['price'] = $info->price;
                        break;
                }


            }
        }
        return $messages;
    }

    /**
     * @param $uid
     * @param $loops_id
     * @param $page
     * @param int $take
     * @return mixed
     */
    public function getDiaries($uid,$loops_id,$page,$take = 10){
        $skip = $page * $take;
        $diaries =LoopsDiaries::with(['loops_diaries_messages'=>function($query){
                $query->select('loops_diaries_messages.loops_diaries_id','loops_messages.users_id','loops_messages.users_id','loops_messages.contents','loops_messages.created_at','loops_authority.tags','users.nickname','users.headimgurl')
                    ->leftJoin('loops_messages','loops_diaries_messages.loops_messages_id','=','loops_messages.id')
                    ->leftJoin('loops_authority','loops_messages.loops_authority_id','=','loops_authority.id')
                    ->leftJoin('users','loops_messages.users_id','=','users.id')
                    ->orderBy('loops_messages_id','desc');
            }])->where(['loops_diaries.users_id'=>$uid,'loops_diaries.loops_id'=>$loops_id])
            ->select('loops_diaries.id','loops_diaries.title','loops_diaries.created_at')
            ->skip($skip)
            ->take($take)
            ->get();
        return $diaries;
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsById($goods_id){
        return Goods::find($goods_id);
    }

    /**
     * @param $loops_id
     * @return mixed
     */
    public function getMessagesCount($loops_id){
        return LoopsMessages::where('loops_id',$loops_id)->count();
    }

    /**
     * @param $uid
     * @param $loops_id
     * @return mixed
     */
    public function getDiariesCount($uid,$loops_id){
        return LoopsDiaries::where(['users_id'=>$uid,'loops_id'=>$loops_id])->count();
    }

    /**
     * @param $uid
     * @param $pictures_id
     * @return bool
     */
    public function picturesFollowed($uid,$pictures_id){
        $info = PicturesFollows::where(['users_id'=>$uid,'pictures_id'=>$pictures_id])->first();
        return count($info)?true:false;
    }

    /**
     * @param $pictures_id
     * @return mixed
     */
    public function getPicturesFollowsCount($pictures_id){
        return PicturesFollows::where('pictures_id',$pictures_id)->count();
    }

    /**
     * @param $uid
     * @param $pictures_id
     * @return array
     */
    public function picturesFollows($uid,$pictures_id){
        $info = PicturesFollows::where(['users_id'=>$uid,'pictures_id'=>$pictures_id])->first();
        if($info){
            PicturesFollows::where(['id'=>$info->id])->delete();
            $count = $this->getPicturesFollowsCount($pictures_id);
            return ['status'=>'delete','count'=>$count];
        }else{
            PicturesFollows::insert([
                'users_id' => $uid,
                'pictures_id' => $pictures_id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            $count = $this->getPicturesFollowsCount($pictures_id);
            return ['status'=>'insert','count'=>$count];
        }
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
     * @param $ids
     * @return mixed
     */
    public function getGoods($ids){
        $goods = Goods::whereIn('goods.id',$ids)
            ->select('goods.id','goods.title','goods.pictures_id','goods.price','pictures.path')
            ->leftJoin('pictures','goods.pictures_id','=','pictures.id')
            ->get();

        return $goods;
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

    /**
     * @param $messages_id
     * @return mixed
     */
    public function getImages($messages_id){
        $info = LoopsMessages::find($messages_id);
        $list = LoopsMessages::where('loops_id',$info->loops_id)
            ->whereIn('loops_authority_id', [5, 6])
            ->select('loops_messages.id','pictures.path')
            ->leftJoin('pictures','loops_messages.pictures_id','=','pictures.id')
            ->orderBy('loops_messages.id')
            ->get();
        return $list;
    }

    /**
     * @param $uid
     * @param $loops_id
     * @param $title
     * @param $loops_messages_ids
     * @return bool
     */
    public function createDiary($uid,$loops_id,$title,$loops_messages_ids){
        $loops_diaries_id = LoopsDiaries::insertGetId([
            'users_id' => $uid,
            'loops_id' => $loops_id,
            'title' => $title,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        if($loops_diaries_id){
            if(count($loops_messages_ids)){
                foreach($loops_messages_ids as $v){
                    $map[] = [
                        'loops_diaries_id' => $loops_diaries_id,
                        'loops_messages_id' => $v,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ];
                }
                LoopsDiariesMessages::insert($map);
                return true;
            }
        }

        return false;
    }

    /**
     * @param $goods_id
     * @param $loops_id
     * @param $uid
     * @return bool
     */
    public function goodsLoops($goods_id,$loops_id,$uid){
        $map = ['goods_id'=>$goods_id,'loops_id'=>$loops_id,'users_id'=>$uid];
        $info = GoodsLoops::where($map)->first();
        if(!$info){
            GoodsLoops::insert($map);
            return true;
        }
        return false;
    }
}
