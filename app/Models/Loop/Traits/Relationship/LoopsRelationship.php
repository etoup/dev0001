<?php

namespace App\Models\Loop\Traits\Relationship;
use Illuminate\Support\Facades\App;

/**
 * Class LoopsRelationship
 * @package App\Models\Loop\Traits\Relationship
 */
trait LoopsRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * @return mixed
     */
    public function loops_tags()
    {
        return $this->belongsTo(config('loop.loops_tags'));
    }

    /**
     * @return mixed
     */
    public function pictures(){
        return $this->belongsTo(config('pictures.pictures'));
    }
}