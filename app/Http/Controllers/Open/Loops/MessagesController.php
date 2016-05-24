<?php

namespace App\Http\Controllers\Open\Loops;


use Aobo\RongCloud\Facades\RongCloud;
use App\Http\Controllers\Controller;
use App\Models\Goods\Goods;
use App\Models\Goods\GoodsFollows;
use App\Models\Goods\GoodsPictures;
use App\Models\Pictures\Pictures;
use App\Repositories\Open\Loops\MessagesRepositoryContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use zgldh\QiniuStorage\QiniuStorage;

class MessagesController extends Controller
{
    protected $messages;

    /**
     * @param MessagesRepositoryContract $messages
     */
    public function __construct(MessagesRepositoryContract $messages){
        $this->messages = $messages;
    }

    /**
     * @param $id
     */
    public function index($id){
        echo $id;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function text(){
        $id = $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),Input::get('contents'),4);
        $users = $this->messages->getUsers(Input::get('uid'));
        if($id){
            $info = [
                'tags' => 'my-text',
                'time' => Carbon::now()->toTimeString(),
                'contents' => Input::get('contents'),
                'headimgurl' => $users->headimgurl,
                'nickname' => $users->nickname
            ];
            //加入群组
            RongCloud::groupJoin(Input::get('uid'),Input::get('loops_id'),Input::get('title'));
            //发送消息
            $content = json_encode([
                'content'=>'my-text',
                'extra'=>$info
            ]);
            RongCloud::messageGroupPublish(Input::get('uid'),[Input::get('loops_id')],'RC:TxtMsg',$content);
            $data = [
                'status' => true,
                'info' => $info
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
    public function img(){
        $disk = QiniuStorage::disk('qiniu');
        $file = Input::file('file');
        $name = $file->getClientOriginalName();
        $back = $disk->put($name,file_get_contents($file->getRealPath()));
        if($back){
            $users = $this->messages->getUsers(Input::get('uid'));
            //保存图片信息
            $id = Pictures::insertGetId([
                'path' => config('pictures.qiniu_host').'/'.$name,
                'key' => $name,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
            //保存图片消息信息
            $previewPath = $disk->imagePreviewUrl($name,'imageView2/0/w/500/h/500');
            $messages_id = $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,5,$id);

            $info = [
                'id' => $messages_id,
                'tags' => 'my-img',
                'time' => Carbon::now()->toTimeString(),
                'contents' => $previewPath,
                'headimgurl' => $users->headimgurl,
                'nickname' => $users->nickname
            ];
            //加入群组
            RongCloud::groupJoin(Input::get('uid'),Input::get('loops_id'),Input::get('title'));
            //发送消息
            $content = json_encode([
                'content'=>'my-text',
                'extra'=>$info
            ]);
            RongCloud::messageGroupPublish(Input::get('uid'),[Input::get('loops_id')],'RC:TxtMsg',$content);
            $data = [
                'status' => true,
                'info' => $info
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
    public function photo(){
        $file = Input::file('file');
        $name = $file->getClientOriginalName();
        $disk = QiniuStorage::disk('qiniu');
        $back = $disk->put($name,file_get_contents($file->getRealPath()));
        if($back){
            $users = $this->messages->getUsers(Input::get('uid'));

            //保存图片信息
            $id = Pictures::insertGetId([
                'path' => config('pictures.qiniu_host').'/'.$name,
                'key' => $name,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
            //保存图片消息信息
            $previewPath = $disk->imagePreviewUrl($name,'imageView2/0/w/500/h/500');
            $messages_id = $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,6,$id);
            $info = [
                'id' => $messages_id,
                'tags' => 'my-photo',
                'time' => Carbon::now()->toTimeString(),
                'contents' => $previewPath,
                'headimgurl' => $users->headimgurl,
                'nickname' => $users->nickname
            ];
            //加入群组
            RongCloud::groupJoin(Input::get('uid'),Input::get('loops_id'),Input::get('title'));
            //发送消息
            $content = json_encode([
                'content'=>'my-text',
                'extra'=>$info
            ]);
            RongCloud::messageGroupPublish(Input::get('uid'),[Input::get('loops_id')],'RC:TxtMsg',$content);
            $data = [
                'status' => true,
                'info' => $info
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
    public function goods(){
        //保存商品信息
        $uid = Input::get('uid');
        $goods_id = $this->messages->saveGoods($uid,Input::get('loops_id'),0,Input::get('title'),nl2br(Input::get('profiles')),Input::get('price'),Input::get('numbers'));
        $disk = QiniuStorage::disk('qiniu');
        $files = Input::file('file');
        if(count($files)){
            foreach($files as $k => $file ){
                $name = $file->getClientOriginalName();
                $disk->put($name,file_get_contents($file->getRealPath()));
                //保存图片信息
                $pictures_id = Pictures::insertGetId([
                    'foreign_id' => $goods_id,
                    'path' => config('pictures.qiniu_host').'/'.$name,
                    'key' => $name,
                    'types' => 2,
                    'created_at' => Carbon::now()->toDateTimeString()
                ]);
                //保存商品图片信息
                GoodsPictures::insertGetId([
                    'goods_id' => $goods_id,
                    'pictures_id' => $pictures_id,
                    'created_at' => Carbon::now()->toDateTimeString()
                ]);
                if($k == 0){
                    //保存商品封面信息
                    Goods::where('id',$goods_id)->update(['pictures_id'=>$pictures_id]);
                    //保存图片消息信息
                    //$previewPath = $disk->imagePreviewUrl($name,'imageView2/0/w/500/h/500');
                    //$this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,7,$pictures_id,$goods_id);
                }
            }
            //保存商品收藏信息
            GoodsFollows::insertGetId([
                'users_id' => $uid,
                'goods_id' => $goods_id,
                'types' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
            $data = [
                'status' => true
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '没有选择图片'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(){
        $ids = explode('-',Input::get('ids'));
        $goods = $this->messages->getGoods($ids);
        if(count($goods)){
            $users = $this->messages->getUsers(Input::get('uid'));
            //加入群组
            RongCloud::groupJoin(Input::get('uid'),Input::get('loops_id'),Input::get('title'));
            foreach($goods as $k => $good){
                $previewPath = $good['path'].'?'.'imageView2/0/w/500/h/500';
                $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,8,$good['pictures_id'],$good['id']);
                $goods_info = $this->messages->getGoodsById($good['id']);
                $info = [
                    'goods_id' => $good['id'],
                    'tags' => 'my-share',
                    'time' => Carbon::now()->toTimeString(),
                    'contents' => $previewPath,
                    'price' => $goods_info['price'],
                    'headimgurl' => $users->headimgurl,
                    'nickname' => $users->nickname
                ];
                //圈子收藏商品
                $this->messages->goodsLoops($good['id'],Input::get('loops_id'),Input::get('uid'));
                //发送消息
                $content = json_encode([
                    'content'=>'my-text',
                    'extra'=>$info
                ]);
                RongCloud::messageGroupPublish(Input::get('uid'),[Input::get('loops_id')],'RC:TxtMsg',$content);
            }
            $data = [
                'status' => true
            ];
        }else{
            $data = [
                'status' => false
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages(){
        $messages = $this->messages->getMessages(Input::get('loops_id'),Input::get('uid'),Input::get('page'));
        if(count($messages)){
            $data = [
                'status' => true,
                'info' => [
                    'uid' => Input::get('uid'),
                    'list' => $messages
                ]
            ];
        }else{
            $count = $this->messages->getMessagesCount(Input::get('loops_id'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '全部加载完毕'
                ]
            ];
        }
        return response()->json($data);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDiaries(){
        $list = $this->messages->getDiaries(Input::get('uid'),Input::get('page'));
        if(count($list)){
            $data = [
                'status' => true,
                'info' => [
                    'uid' => Input::get('uid'),
                    'list' => $list
                ]
            ];
        }else{
            $count = $this->messages->getDiariesCount(Input::get('uid'));
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '全部加载完毕'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @param $id
     * @return array
     */
    public function getImages($id){
        $list = $this->messages->getImages($id);
        $map = [];
        if(count($list)){
            $index = 0;
            foreach($list as $k => $v){
                if($v->id == $id){
                    $index = $k;
                }
                $map['index'] = $index;
                $map['values'][] = $v->path;
            }
        }
        return $map;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function images(){
        $id = Input::get('id')?intval(Input::get('id')):0;
        $list = $this->messages->getImages($id);
        $map = [];
        if($pages = count($list)){
            $index = 0;
            foreach($list as $k => $v){
                if($v->id == $id){
                    $index = $k;
                }
                $map['index'] = $index;
                $map['values'][] = $v->path;
            }
            $map['pages'] = $pages;
            $data = [
                'status' => true,
                'info' => $map
            ];
        }else{
            $data = [
                'status' => false
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function picturesFollows(){
        $info = $this->messages->picturesFollows(Input::get('uid'),Input::get('pictures_id'));
        return response()->json($info);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDiary(){
        $ids = explode('-',Input::get('ids'));
        $back = $this->messages->createDiary(Input::get('uid'),Input::get('loops_id'),Input::get('title'),$ids);
        if($back){
            $data = [
                'status' => true
            ];
        }else{
            $data = [
                'status' => false
            ];
        }

        return response()->json($data);
    }


}
