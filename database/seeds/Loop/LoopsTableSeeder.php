<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class LoopsTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('loop.loops_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('loop.loops_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('loop.loops_table') . ' CASCADE');
        }

        //添加圈子助手
        $loops = [
            [
                'users_id'          => 1,
                'loops_tags_id'     => NULL,
                'title'             => '圈子助手',
                'profiles'          => '有问题找圈子助手',
                'types'             => 0,
                'sort'              => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'loops_tags_id'     => 1,
                'title'             => '精品手工',
                'profiles'          => '精品热门手工制品',
                'types'             => 1,
                'sort'              => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'loops_tags_id'     => 1,
                'title'             => '热门手工',
                'profiles'          => '热门手工制品',
                'types'             => 1,
                'sort'              => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'loops_tags_id'     => 2,
                'title'             => '木工手工',
                'profiles'          => '木工手工制品',
                'types'             => 1,
                'sort'              => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('loop.loops_table'))->insert($loops);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}