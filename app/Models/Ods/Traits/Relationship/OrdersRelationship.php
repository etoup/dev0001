<?php

namespace App\Models\Ods\Traits\Relationship;

/**
 * Class OrdersRelationship
 * @package App\Models\Ods\Traits\Relationship
 */
trait OrdersRelationship
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
    public function goods(){
        return $this->belongsTo(config('goods.goods'));
    }

    /**
     * @return mixed
     */
    public function business(){
        return $this->belongsTo(config('access.business'));
    }

    /**
     * @return mixed
     */
    public function users_address(){
        return $this->belongsTo(config('access.users_address'));
    }
}