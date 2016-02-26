<?php

return [



    /*
     * Pictures model used by Pictures to create correct relations.
     * Update the Pictures if it is in a different namespace.
     */
    'pictures' => App\Models\Pictures\Pictures::class,

    /*
     * Pictures table used by Loop to save pictures to the database.
     */
    'pictures_table' => 'pictures',

    'qiniu_host'     => 'http://7u2i5s.com1.z0.glb.clouddn.com',
];