<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Goods\Traits\Attribute\GoodsAttribute;
use App\Models\Goods\Traits\Relationship\GoodsRelationship;

class Goods extends Model
{
    use SoftDeletes,GoodsAttribute,GoodsRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'goods';

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
