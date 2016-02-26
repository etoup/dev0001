<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;

class UsersAddress extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_address';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
