<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class LoopsMessagesTableSeeder extends Seeder
{

    public function run()
    {
        $table = 'loops_messages';

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table($table)->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . $table);
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . $table . ' CASCADE');
        }


        $map = [
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 4,
                'contents'     => '消息测试内容1',
                'date_node'    => '2016-02-07',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 5,
                'contents'     => '消息测试内容2',
                'date_node'    => '2016-02-07',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 6,
                'contents'     => '消息测试内容3',
                'date_node'    => '2016-02-08',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 7,
                'contents'     => '消息测试内容4',
                'date_node'    => '2016-02-08',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 8,
                'contents'     => '消息测试内容5',
                'date_node'    => '2016-02-09',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 9,
                'contents'     => '消息测试内容6',
                'date_node'    => '2016-02-09',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 4,
                'contents'     => '消息测试内容7',
                'date_node'    => Carbon::createFromDate(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 5,
                'contents'     => '消息测试内容8',
                'date_node'    => Carbon::createFromDate(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 6,
                'contents'     => '消息测试内容9',
                'date_node'    => Carbon::createFromDate(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 7,
                'contents'     => '消息测试内容10',
                'date_node'    => Carbon::createFromDate(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 8,
                'contents'     => '消息测试内容11',
                'date_node'    => Carbon::createFromDate(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'loops_authority_id' => 9,
                'contents'     => '消息测试内容12',
                'date_node'    => Carbon::createFromDate(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]
        ];

        DB::table($table)->insert($map);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}