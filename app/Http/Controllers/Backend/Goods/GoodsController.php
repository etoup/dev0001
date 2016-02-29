<?php

namespace App\Http\Controllers\Backend\Goods;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Good\DownGoodRequest;
use App\Http\Requests\Backend\Good\StoreGoodRequest;
use App\Http\Requests\Backend\Good\ExportGoodRequest;
use App\Http\Requests\Backend\Good\SearchGoodRequest;
use App\Http\Requests\Backend\Good\LookGoodRequest;
use App\Repositories\Backend\Good\GoodsRepositoryContract;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend\Goods
 */
class GoodsController extends Controller
{
    protected $goods;

    public function __construct(GoodsRepositoryContract $goods){
        $this->goods = $goods;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.goods.index')
            ->withGoods($this->goods->getGoodsPaginated(20))
            ->withStatus(collect(config('goods.goods_status'))->toArray());
    }

    /**
     * @param SearchGoodRequest $request
     * @return mixed
     */
    public function search(SearchGoodRequest $request){
//        dd($this->goods);
        return view('backend.goods.search')
            ->withGoods($this->goods->getSearchGoodsPaginated($request->all(),20))
            ->withStatus(collect(config('goods.goods_status'))->toArray());
    }

    /**
     * @return mixed
     */
    public function look(){
        return view('backend.goods.look')->withGoods($this->goods->getLookGoodsPaginated(20));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id){
        return view('backend.goods.edit')->withInfo($this->goods->find($id));
    }

    /**
     * @param StoreGoodRequest $request
     * @return mixed
     */
    public function store(StoreGoodRequest $request){
        $this->goods->store($request->all());
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.goods.store-ok'));
    }

    /**
     * @param ExportGoodRequest $request
     */
    public function export(ExportGoodRequest $request){
        $this->goods->export($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function down($id){
        return view('backend.goods.down')->withInfo($this->goods->find($id));
    }

    /**
     * @param DownGoodRequest $request
     * @return mixed
     */
    public function doDown(DownGoodRequest $request){
        $this->goods->doDown($request->all());
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.goods.do-down-ok'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function lookOk($id){
        $this->goods->lookOk($id,10);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.goods.look-ok'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function lookNo($id){
        return view('backend.goods.look-no')->withInfo($this->goods->find($id));
    }

    /**
     * @param LookGoodRequest $request
     * @return mixed
     */
    public function doLookNo(LookGoodRequest $request){
        $this->goods->lookNo($request->all());
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.goods.do-look-no'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $this->goods->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.goods.destroy-ok'));
    }
}