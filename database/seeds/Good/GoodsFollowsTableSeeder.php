<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class GoodsFollowsTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('goods.goods_follows_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('goods.goods_follows_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('goods.goods_follows_table') . ' CASCADE');
        }

        //添加关注商品
        $map = [
            [
                'users_id'          => 2,
                'goods_id'          => 1,
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'goods_id'          => 2,
                'types'             => 1,

                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'goods_id'          => 3,
                'types'             => 1,

                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'goods_id'          => 4,
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 3,
                'goods_id'          => 5,
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 3,
                'goods_id'          => 6,
                'types'             => 1,

                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 3,
                'goods_id'          => 7,
                'types'             => 1,

                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 3,
                'goods_id'          => 8,
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('goods.goods_follows_table'))->insert($map);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}