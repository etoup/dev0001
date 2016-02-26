<?php

namespace App\Http\Controllers\Backend\Loop;


use App\Repositories\Backend\Loop\Authority\LoopAuthorityRepositoryContract;
use App\Http\Requests\Backend\Loop\Authority\StoreLoopAuthorityRequest;
use App\Http\Requests\Backend\Loop\Authority\EditLoopAuthorityRequest;
use App\Http\Requests\Backend\Loop\Authority\UpdateLoopAuthorityRequest;
use App\Http\Requests\Backend\Loop\Authority\DeleteLoopAuthorityRequest;
use App\Http\Controllers\Controller;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend\Loop
 */
class LoopAuthorityController extends Controller
{

    /**
     * @var LoopAuthorityRepositoryContract
     */
    protected $authority;

    /**
     * @param LoopAuthorityRepositoryContract $authority
     */
    public function __construct(LoopAuthorityRepositoryContract $authority)
    {
        $this->authority = $authority;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.loop.authority.index')->withAuthorities($this->authority->getTagsPaginated(20,'sort'));
    }

    public function create(){
        return view('backend.loop.authority.create');
    }

    /**
     * @param  StoreLoopAuthorityRequest $request
     * @return mixed
     */
    public function store(StoreLoopAuthorityRequest $request)
    {
        $this->authority->store($request->all());
        return redirect()->route('admin.loop.authority.index')->withFlashSuccess(trans('alerts.backend.loop.authority.created'));
    }

    /**
     * @param  $id
     * @param  EditLoopAuthorityRequest $request
     * @return mixed
     */
    public function edit($id,EditLoopAuthorityRequest $request){
        return view('backend.loop.authority.edit')->withAuth($this->authority->find($id));
    }

    /**
     * @param $id
     * @param UpdateLoopAuthorityRequest $request
     * @return mixed
     */

    public function update($id,UpdateLoopAuthorityRequest $request){
        $this->authority->update($id,$request->all());
        return redirect()->route('admin.loop.authority.index')->withFlashSuccess(trans('alerts.backend.loop.authority.updated'));
    }

    /**
     * @param  $id
     * @param  DeleteLoopAuthorityRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteLoopAuthorityRequest $request)
    {
        $this->authority->destroy($id);
        return redirect()->route('admin.loop.authority.index')->withFlashSuccess(trans('alerts.backend.loop.authority.destroy'));
    }


}