<?php

namespace App\Models\Loop\Traits\Relationship;



/**
 * Class LoopsRelationship
 * @package App\Models\Loop\Traits\Relationship
 */
trait LoopsMessagesRelationship
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
    public function loops_authority()
    {
        return $this->belongsTo(config('loop.loops_authority'));
    }
}