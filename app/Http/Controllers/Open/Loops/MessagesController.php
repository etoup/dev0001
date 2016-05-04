<?php

namespace App\Http\Controllers\Open\Loops;


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
            $data = [
                'status' => true,
                'info' => [
                    'types' => 'text',
                    'msg' => Input::get('contents'),
                    'headimgurl' => $users->headimgurl,
                    'nickname' => $users->nickname
                ]
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
            $previewPath = $disk->imagePreviewUrl($name,'imageView2/0/w/100/h/200');
            $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,5,$id);
            $data = [
                'status' => true,
                'info' => [
                    'types' => 'img',
                    'msg' => $previewPath,
                    'headimgurl' => $users->headimgurl,
                    'nickname' => $users->nickname
                ]
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
            $previewPath = $disk->imagePreviewUrl($name,'imageView2/0/w/100/h/200');
            $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,6,$id);
            $data = [
                'status' => true,
                'info' => [
                    'types' => 'photo',
                    'msg' => $previewPath,
                    'headimgurl' => $users->headimgurl,
                    'nickname' => $users->nickname
                ]
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
        $goods_id = $this->messages->saveGoods($uid,Input::get('loops_id'),0,Input::get('title'),Input::get('profiles'),Input::get('price'),Input::get('numbers'));
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
                    $previewPath = $disk->imagePreviewUrl($name,'imageView2/0/w/100/h/200');
                    $this->messages->saveMessages(Input::get('uid'),Input::get('loops_id'),$previewPath,7,$pictures_id,$goods_id);
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
                'status' => true,
                'info' => $previewPath
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
}
