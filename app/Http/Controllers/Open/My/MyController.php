<?php

namespace App\Http\Controllers\Open\My;

use App\Http\Controllers\Controller;
use App\Repositories\Open\My\MyRepositoryContract;
use Illuminate\Support\Facades\Input;


class MyController extends Controller
{
    protected $my;

    public function __construct(MyRepositoryContract $my){
        $this->my = $my;
    }

    public function loops(){
        $data = $this->my->loops(Input::get('uid'),Input::get('page'));
        return response()->json($data);
    }

    public function getLoops($uid,$page){
        $data = $this->my->loops($uid,$page);
        return response()->json($data);
    }
}
