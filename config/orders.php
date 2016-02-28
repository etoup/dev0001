<?php

return [



    /*
     * Orders model used by orders to create correct relations.
     * Update the orders if it is in a different namespace.
     */
    'orders' => App\Models\Orders\Orders::class,

    /*
     * Loops table used by Loop to save loops to the database.
     */
    'orders_table' => 'orders',
    'orders_status' => [
        1  => '待付款',
        10 => '已付款待发货',
        20 => '已发货',
        80 => '已收货',
        88 => '已评价',
        90 => '申请提现',
        100=> '已结算'
    ]
];