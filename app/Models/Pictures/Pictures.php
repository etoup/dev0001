<?php

namespace App\Models\Pictures;

use Illuminate\Database\Eloquent\Model;


class Pictures extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pictures';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
