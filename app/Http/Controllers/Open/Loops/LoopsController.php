<?php

namespace App\Http\Controllers\Open\Loops;


use App\Http\Controllers\Controller;
use App\Repositories\Open\Loops\LoopsRepositoryContract;
use Illuminate\Support\Facades\Input;

class LoopsController extends Controller
{
    protected $loops;

    /**
     * @param LoopsRepositoryContract $loops
     */
    public function __construct(LoopsRepositoryContract $loops){
        $this->loops = $loops;
    }

    /**
     * @param $tags_id
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($tags_id,$page){

        $list = $this->loops->getLoops($tags_id,$page);

        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['follows'] = $this->loops->getFollows($v->loops_id);
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->loops->getLoopsCount($tags_id);
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }

        sleep(1);
        return response()->json($data);
    }

    /**
     * @param $tags_id
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function hot($tags_id,$page){

        $list = $this->loops->getLoops($tags_id,$page);

        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['follows'] = $this->loops->getFollows($v->loops_id);
            }
            $data = [
                'status' => true,
                'info' => $list
            ];

        }else{
            $count = $this->loops->getLoopsCount($tags_id);
            $data = [
                'status' => false,
                'count' => intval($count),
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }
        sleep(1);

        return response()->json($data);
    }

    /**
     * @param $uid
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function follows($uid,$page){
        if(!$uid){
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '请先登录'
                ]
            ];
        }else{
            $list = $this->loops->getFollowsLoops($uid,$page);

            if(count($list)){
                foreach($list as $k => $v){
                    $map[$k] = $this->loops->getLoopById($v->loops_id);
                }
                $data = [
                    'status' => true,
                    'info' => $map
                ];

            }else{
                $count = $this->loops->getLoopsCountByUid($uid);
                $data = [
                    'status' => false,
                    'count' => intval($count),
                    'info' => [
                        'msg' => '已全部加载'
                    ]
                ];
            }
        }
        sleep(1);

        return response()->json($data);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function tags(){

        $tags = $this->loops->getTags(Input::get('limit'));
        if(count($tags)){
            $data = [
                'status' => true,
                'info' => $tags
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => 'test'
                ]
            ];
        }
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCate(){
        $data = $this->loops->getSets(Input::get('uid'),Input::get('loops_id'),Input::get('types'));
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDoing(){
        $map = [];
        $data = $this->loops->getSets(Input::get('uid'),Input::get('loops_id'),Input::get('types'));
        if(count($data)){
            foreach($data as $k => $v){
                $map[$k] = [
                    'title' => $v['title'],
                    'normalImg' => $v['normal_img'],
                    'activeImg' => $v['active_img']
                ];
            }
        }
        return response()->json($map);
    }

    /**
     * @param $loops_id
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function goods($loops_id,$page){

        $list = $this->loops->getGoods($loops_id,$page);

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @param $loops_id
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function users($loops_id,$page){

        $list = $this->loops->getUsers($loops_id,$page);

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '已全部加载'
                ]
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function delUsers(){
        $ids = explode('-',Input::get('ids'));
        $reback = $this->loops->delUsers($ids);
        if($reback){
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
