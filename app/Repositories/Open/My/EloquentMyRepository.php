<?php

namespace App\Repositories\Open\My;

use App\Models\Loop\Loops;

/**
 * Class EloquentMyRepository
 * @package App\Repositories\Open\My
 */
class EloquentMyRepository implements MyRepositoryContract
{

    public function loops($uid,$page,$take = 10){
        $skip = $page * $take;
        $loops = Loops::with('pictures','users')->where('users_id',$uid)->orderBy('id')->skip($skip)->take($take)->get();
        return $loops;
    }


}
