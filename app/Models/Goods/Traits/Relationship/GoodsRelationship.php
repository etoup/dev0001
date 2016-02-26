<?php

namespace App\Models\Goods\Traits\Relationship;

/**
 * Class GoodsRelationship
 * @package App\Models\Loop\Traits\Relationship
 */
trait GoodsRelationship
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
    public function pictures(){
        return $this->belongsTo(config('goods.goods_pictures'));
    }
}