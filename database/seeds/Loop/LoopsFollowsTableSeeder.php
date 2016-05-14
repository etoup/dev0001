<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class LoopsFollowsTableSeeder extends Seeder
{

    public function run()
    {
        $table = 'loops_follows';

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
                'types'        => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 3,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 4,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 5,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 6,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 7,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 8,
                'loops_id'     => 1,
                'types'        => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 2,
                'types'        => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 3,
                'types'        => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'users_id'     => 2,
                'loops_id'     => 4,
                'types'        => 1,
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