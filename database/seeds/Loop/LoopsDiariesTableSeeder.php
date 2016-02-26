<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class LoopsDiariesTableSeeder extends Seeder
{

    public function run()
    {
        $table = 'loops_diaries';

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
                'users_id'     => 1,
                'loops_id'     => 1,
                'loops_messages_id'     => 1,
                'title' => '日记1',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 1,
                'loops_id'     => 1,
                'loops_messages_id'     => 2,
                'title' => '日记2',
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