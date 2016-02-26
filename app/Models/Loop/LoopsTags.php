<?php

namespace App\Models\Loop;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loop\Traits\Attribute\LoopsTagsAttribute;

class LoopsTags extends Model
{
    use LoopsTagsAttribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loops_tags';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
