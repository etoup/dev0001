<?php

namespace App\Http\Controllers\Backend\Loop;

use App\Repositories\Backend\Loop\Tags\LoopTagsRepositoryContract;
use App\Http\Requests\Backend\Loop\Tags\StoreLoopTagsRequest;
use App\Http\Requests\Backend\Loop\Tags\EditLoopTagsRequest;
use App\Http\Requests\Backend\Loop\Tags\UpdateLoopTagsRequest;
use App\Http\Requests\Backend\Loop\Tags\DeleteLoopTagsRequest;
use App\Http\Controllers\Controller;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend\Loop
 */
class LoopTagsController extends Controller
{

    /**
     * @var LoopTagsRepositoryContract
     */
    protected $tags;

    /**
     * @param LoopTagsRepositoryContract $tags
     */
    public function __construct(LoopTagsRepositoryContract $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.loop.tags.index')->withTags($this->tags->getTagsPaginated(20,'sort'));
    }

    public function create(){
        return view('backend.loop.tags.create');
    }

    /**
     * @param  StoreLoopTagsRequest $request
     * @return mixed
     */
    public function store(StoreLoopTagsRequest $request)
    {
        $this->tags->store($request->all());
        return redirect()->route('admin.loop.tags.index')->withFlashSuccess(trans('alerts.backend.loop.tags.created'));
    }

    /**
     * @param  $id
     * @param  EditLooptagsRequest $request
     * @return mixed
     */
    public function edit($id,EditLoopTagsRequest $request){
        return view('backend.loop.tags.edit')->withTag($this->tags->find($id));
    }

    /**
     * @param $id
     * @param UpdateLoopTagsRequest $request
     * @return mixed
     */

    public function update($id,UpdateLoopTagsRequest $request){
        $this->tags->update($id,$request->all());
        return redirect()->route('admin.loop.tags.index')->withFlashSuccess(trans('alerts.backend.loop.tags.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteLoopTagsRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteLoopTagsRequest $request)
    {
        $this->tags->destroy($id);
        return redirect()->route('admin.loop.tags.index')->withFlashSuccess(trans('alerts.backend.loop.tags.destroy'));
    }
}