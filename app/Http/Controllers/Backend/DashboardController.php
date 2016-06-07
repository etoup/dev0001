<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\DashboardRepositoryContract;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller
{
    protected $dashboard;

    public function __construct(DashboardRepositoryContract $dashboard){
        $this->dashboard = $dashboard;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        dd($this->dashboard->getNewGoods());
        return view('backend.dashboard')
            ->withCounts($this->dashboard->getCountList())
            ->withNewGoods($this->dashboard->getNewGoods())
            ->withNewOrders($this->dashboard->getNewOrders())
            ->withNewMessages($this->dashboard->getNewMessages())
            ->withNewUsers($this->dashboard->getNewUsers());
    }
}