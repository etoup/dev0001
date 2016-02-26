<?php

namespace App\Models\Ods;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ods\Traits\Attribute\OrdersAttribute;
use App\Models\Ods\Traits\Relationship\OrdersRelationship;

class Orders extends Model
{
    use SoftDeletes,OrdersAttribute,OrdersRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
