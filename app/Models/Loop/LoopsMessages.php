<?php

namespace App\Models\Loop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loop\Traits\Relationship\LoopsMessagesRelationship;

class LoopsMessages extends Model
{
    use SoftDeletes,LoopsMessagesRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loops_messages';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
}
