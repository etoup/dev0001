<?php

namespace App\Models\Loop;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loop\Traits\Attribute\LoopsAuthorityAttribute;

class LoopsSets extends Model
{
    /**
     * The database table loops_authority by the model.
     *
     * @var string
     */
    protected $table = 'loops_sets';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
