<?php

namespace App\Http\Controllers\Backend\Loop;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Loop\LoopsRepositoryContract;
use App\Http\Requests\Backend\Loop\StoreLoopRequest;
use App\Http\Requests\Backend\Loop\UpdateLoopRequest;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend\Loop
 */
class LoopController extends Controller
{
    protected $loop;

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
            ->withTags(collect($this->loop->getTagsArray())->prepend('全部')->toArray());
    }

    /**
     * @return mixed
     */
    public function search()
    {
//        dd(collect($this->loop->getTagsArray())->prepend('全部')->toArray());
        return view('backend.loop.index')
            ->withLiveness($this->loop->cacheLiveness(config('loop.expires')))
            ->withLoops($this->loop->getLoopsPaginated(20))
            ->withTags(collect($this->loop->getTagsArray())->prepend('全部')->toArray());
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
     * @param $id
     * @return mixed
     */
    public function msgList($id){
        $this->loop->getMsgsPaginated($id,20);
        return view('backend.loop.msg-list')->withInfo($this->loop->getInfo($id))->withMsgs($this->loop->getMsgsPaginated($id,20));
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