<?php

namespace App\Models\Loop\Traits\Relationship;


/**
 * Class LoopsDiariesRelationship
 * @package App\Models\Loop\Traits\Relationship
 */
trait LoopsDiariesRelationship
{

    /**
     * @return mixed
     */
    public function loops_diaries_messages(){
        return $this->hasMany(config('loop.loops_diaries_messages'));
    }
}