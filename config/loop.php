<?php

return [



    /*
     * Loops model used by Loop to create correct relations.
     * Update the loop if it is in a different namespace.
     */
    'loops' => App\Models\Loop\Loops::class,
    'loops_tags' => App\Models\Loop\LoopsTags::class,
    'loops_users' => App\Models\Loop\LoopsUsers::class,
    'loops_follows' => App\Models\Loop\LoopsFollows::class,
    'loops_authority' => App\Models\Loop\LoopsAuthority::class,
    'loops_diaries_messages' => App\Models\Loop\LoopsDiariesMessages::class,

    /*
     * Loops table used by Loop to save loops to the database.
     */
    'loops_table' => 'loops',
    'loops_tags_table' => 'loops_tags',
    'loops_authority_table' => 'loops_authority',

    'loops_authority_types' => ['目录','功能','默认'],

    'expires' => 5,

    /*
     * fields
     */
    'fields_search_msg' => [
        'loops_authority_id'  => [
            'label' => '状态',
            'tags'  => "loops_authority_id = ?"
        ],
        'date'  => [
            'label' => '消息时间',
            'tags'  => "created_at between ? and ?"
        ]
    ],
];