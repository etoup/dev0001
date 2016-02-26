<?php

return [



    /*
     * Loops model used by Loop to create correct relations.
     * Update the loop if it is in a different namespace.
     */
    'loops' => App\Models\Loop\Loops::class,
    'loops_tags' => App\Models\Loop\LoopsTags::class,
    'loops_authority' => App\Models\Loop\LoopsAuthority::class,

    /*
     * Loops table used by Loop to save loops to the database.
     */
    'loops_table' => 'loops',
    'loops_tags_table' => 'loops_tags',
    'loops_authority_table' => 'loops_authority',

    'loops_authorith_types' => ['目录','功能'],

    'expires' => 5,
];