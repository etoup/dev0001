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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){

        $list = $this->loops->getLoops(Input::get('tags_id'),Input::get('page'));

        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['follows'] = $this->loops->getFollows($v->loops_id);
            }
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->loops->getLoopsCount(Input::get('tags_id'));
            $data = [
                'status' => false,
                'count' => intval($count),
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
    public function hot(){

        $list = $this->loops->getLoops(Input::get('tags_id'),Input::get('page'));

        if(count($list)){
            foreach($list as $k => $v){
                $list[$k]['follows'] = $this->loops->getFollows($v->loops_id);
            }
            $data = [
                'status' => true,
                'info' => $list
            ];

        }else{
            $count = $this->loops->getLoopsCount(Input::get('tags_id'));
            $data = [
                'status' => false,
                'count' => intval($count),
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
    public function follows(){
        if(!Input::get('uid')){
            $data = [
                'status' => false,
                'info' => [
                    'msg' => '请先登录'
                ]
            ];
        }else{
            $list = $this->loops->getFollowsLoops(Input::get('uid'),Input::get('page'));

            if(count($list)){
                $map = [];
                foreach($list as $k => $v){
                    $map[$k] = $this->loops->getLoopById($v->loops_id);
                }
                $data = [
                    'status' => true,
                    'info' => $map
                ];

            }else{
                $count = $this->loops->getLoopsCountByUid(Input::get('uid'));
                $data = [
                    'status' => false,
                    'count' => intval($count),
                    'info' => [
                        'msg' => '已全部加载'
                    ]
                ];
            }
        }

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDoingTags(){
        $map = [];
        $index = Input::get('index');
        $data = $this->loops->getSets(Input::get('uid'),Input::get('loops_id'),Input::get('types'));
        if(count($data)){
            foreach($data as $k => $v){
                $map[] = $v['tags'];
            }
        }
        if($map[$index]){
            $info = [
                'status' => true,
                'info' => $map[$index]
            ];
        }else{
            $info = [
                'status' => false,
                'info' => [
                    'msg' => '无效参数'
                ]
            ];
        }
        return response()->json($info);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function goods(){

        $list = $this->loops->getGoods(Input::get('loops_id'),Input::get('page'));

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
    public function users(){

        $list = $this->loops->getUsers(Input::get('loops_id'),Input::get('page'));

        if(count($list)){
            $data = [
                'status' => true,
                'info' => $list
            ];
        }else{
            $count = $this->loops->getUsersCount(Input::get('loops_id'));
            $data = [
                'status' => false,
                'count' => intval($count),
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function hasFollows(){
        $own = $this->loops->getLoopsOwn(Input::get('uid'));
        if($own){
            $data = [
                'status' => false
            ];
        }else{
            $info = $this->loops->hasFollows(Input::get('uid'),Input::get('loops_id'));
            if($info){
                $data = [
                    'status' => false
                ];
            }else{
                $data = [
                    'status' => true
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function join(){
        $own = $this->loops->getLoopsOwn(Input::get('uid'));
        if($own){
            $data = [
                'status' => false,
                'msg' => '圈主不需要加入'
            ];
        }else{
            $info = $this->loops->hasFollows(Input::get('uid'),Input::get('loops_id'));
            if($info){
                $data = [
                    'status' => false,
                    'msg' => '请不要重复加入'
                ];
            }else{
                $id = $this->loops->join(Input::get('uid'),Input::get('loops_id'));
                if($id){
                    $data = [
                        'status' => true
                    ];
                }else{
                    $data = [
                        'status' => false,
                        'msg'=>'加入失败'
                    ];
                }
            }
        }


        return response()->json($data);
    }
}
