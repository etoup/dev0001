<?php

namespace App\Models\Loop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loop\Traits\Relationship\LoopsRelationship;
use App\Models\Loop\Traits\Attribute\LoopsAttribute;

class Loops extends Model
{
    use SoftDeletes,LoopsRelationship,LoopsAttribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loops';

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
