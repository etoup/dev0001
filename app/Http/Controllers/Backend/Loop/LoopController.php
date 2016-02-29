<?php

namespace App\Http\Controllers\Backend\Loop;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Loop\LoopsRepositoryContract;
use App\Http\Requests\Backend\Loop\StoreLoopRequest;
use App\Http\Requests\Backend\Loop\UpdateLoopRequest;
use App\Http\Requests\Backend\Loop\SearchLoopRequest;
use App\Http\Requests\Backend\Loop\ExportLoopRequest;
use App\Http\Requests\Backend\Loop\SearchMsgRequest;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend\Loop
 */
class LoopController extends Controller
{
    protected $loop;



    /**
     * @param LoopsRepositoryContract $loop
     */
    public function __construct(LoopsRepositoryContract $loop){
        $this->loop = $loop;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        dd(collect($this->loop->getTagsArray())->prepend('全部')->toArray());
        return view('backend.loop.index')
            ->withLiveness($this->loop->cacheLiveness(config('loop.expires')))
            ->withLoops($this->loop->getLoopsPaginated(20))
            ->withTags(collect($this->loop->getTagsArray())->toArray());
    }

    /**
     * @param SearchLoopRequest $request
     * @return mixed
     */
    public function search(SearchLoopRequest $request)
    {
//        dd(collect($this->loop->getTagsArray())->prepend('全部')->toArray());
        return view('backend.loop.search')
            ->withLiveness($this->loop->cacheLiveness(config('loop.expires')))
            ->withLoops($this->loop->getSearchLoopsPaginated($request->all(),20))
            ->withTags(collect($this->loop->getTagsArray())->toArray());
    }

    /**
     * @return mixed
     */
    public function create(){
        return view('backend.loop.create')
            ->withTags($this->loop->getTags())
            ->withCatas($this->loop->getAuthorityList(0))
            ->withFuns($this->loop->getAuthorityList(1));
    }

    /**
     * @param StoreLoopRequest $request
     * @return mixed
     */
    public function store(StoreLoopRequest $request){
        $this->loop->store($request->all());
        return redirect()->route('admin.loop')->withFlashSuccess(trans('alerts.backend.loop.created'));
    }

    /**
     * @param UpdateLoopRequest $request
     * @return mixed
     */
    public function storeClear(UpdateLoopRequest $request){
        $this->loop->update($request->all(),true);
        return redirect()->route('admin.loop')->withFlashSuccess(trans('alerts.backend.loop.update'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id){
        return view('backend.loop.edit')
            ->withInfo($this->loop->getInfo($id))
            ->withTags($this->loop->getTags())
            ->withCatasLoop($this->loop->getSetsList($id,0,10))
            ->withCatasUser($this->loop->getSetsList($id,0,0))
            ->withFunsLoop($this->loop->getSetsList($id,1,10))
            ->withFunsUser($this->loop->getSetsList($id,1,0));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $this->loop->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.loop.destroy-ok'));
    }

    /**
     * @param ExportLoopRequest $request
     */
    public function export(ExportLoopRequest $request){
        $this->loop->export($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function msgList($id){
        $list = collect($this->loop->getAuthorityList(1))->toArray();
        $authority = [];
        if(count($list)){
            foreach($list as $val){
                $authority[$val['id']] = $val['title'];
            }
        }

        return view('backend.loop.msg-list')
            ->withInfo($this->loop->getInfo($id))
            ->withMsgs($this->loop->getMsgsPaginated($id,20))
            ->withAuthority($authority);
    }

    /**
     * @param SearchMsgRequest $request
     * @return mixed
     */
    public function msgSearch(SearchMsgRequest $request){
        $list = collect($this->loop->getAuthorityList(1))->toArray();
        $authority = [];
        if(count($list)){
            foreach($list as $val){
                $authority[$val['id']] = $val['title'];
            }
        }

        return view('backend.loop.msg-search')
            ->withInfo($this->loop->getInfoByInput($request->all()))
            ->withMsgs($this->loop->getSearchMsgsPaginated($request->all(),20))
            ->withAuthority($authority);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function cancelTop($id){
        $this->loop->cancelTop($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.loop.cancel-top-ok'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function doTop($id){
        $this->loop->doTop($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.loop.do-top-ok'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function msgDestroy($id){
        $this->loop->msgDestroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.loop.msg-destroy-ok'));
    }
}