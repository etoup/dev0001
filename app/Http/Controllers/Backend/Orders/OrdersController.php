<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Od\StoreLoopRequest;
use App\Repositories\Backend\Od\OrdersRepositoryContract;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend\Orders
 */
class OrdersController extends Controller
{
    protected $orders;
    public function __construct(OrdersRepositoryContract $orders){
        $this->orders = $orders;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.orders.index')->withOrders($this->orders->getOrdersPaginated(20));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function see($id){
        return view('backend.orders.see')->withInfo($this->orders->getInfo($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id){
        return view('backend.orders.edit')->withInfo($this->orders->getInfo($id));
    }

    /**
     * @param StoreLoopRequest $request
     * @return mixed
     */
    public function store(StoreLoopRequest $request){
        $this->orders->store($request->all());
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.orders.store-ok'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        $this->orders->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.orders.destroy-ok'));
    }
}