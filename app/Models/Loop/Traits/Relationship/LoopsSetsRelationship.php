<?php

namespace App\Models\Loop\Traits\Relationship;


/**
 * Class LoopsSetsRelationship
 * @package App\Models\Loop\Traits\Relationship
 */
trait LoopsSetsRelationship
{

    /**
     * @return mixed
     */
    public function loops(){
        return $this->belongsTo(config('loop.loops'),'loops_id');
    }

    /**
     * @return mixed
     */
    public function loops_authority()
    {
        return $this->belongsTo(config('loop.loops_authority'),'loops_authority_id');
    }
}