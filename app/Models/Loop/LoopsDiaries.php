<?php

namespace App\Models\Loop;

use Illuminate\Database\Eloquent\Model;

class LoopsDiaries extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loops_diaries';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
