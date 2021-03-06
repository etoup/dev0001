<?php

return [



    /*
     * Loops model used by Loop to create correct relations.
     * Update the loop if it is in a different namespace.
     */
    'goods' => App\Models\Goods\Goods::class,
    'pictures' => App\Models\Pictures\Pictures::class,
    'goods_pictures' => App\Models\Goods\GoodsPictures::class,


    /*
     * Loops table used by Loop to save loops to the database.
     */
    'goods_table' => 'goods',

    'goods_follows_table' => 'goods_follows',

    'goods_pictures_table' => 'goods_pictures',

    'goods_loops_table' => 'goods_loops',

    'goods_status' => [
        -2 => '未通过',
        -1 => '下架',
        1  => '待审',
        10  => '上架',
    ]
];