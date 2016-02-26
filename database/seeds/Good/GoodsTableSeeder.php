<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class GoodsTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('goods.goods_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('goods.goods_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('goods.goods_table') . ' CASCADE');
        }

        //添加圈子商品
        $map = [
            [
                'users_id'          => 2,
                'loops_id'          => 2,
                'pictures_id'       => 1,
                'title'             => '商品名称1',
                'profiles'          => '商品介绍1',
                'price'             => 100.00,
                'numbers'           => 100,
                'stocks'            => 100,
                'status'            => 1,//上架
                'name'              => 'admin',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'loops_id'          => 2,
                'pictures_id'       => 1,
                'title'             => '商品名称2',
                'profiles'          => '商品介绍2',
                'price'             => 50.00,
                'numbers'           => 10,
                'stocks'            => 10,
                'status'            => 0,//待审
                'name'              => 'admin',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'loops_id'          => 2,
                'pictures_id'       => 1,
                'title'             => '商品名称3',
                'profiles'          => '商品介绍3',
                'price'             => 55.00,
                'numbers'           => 20,
                'stocks'            => 20,
                'status'            => -1,//下架
                'name'              => 'admin',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 2,
                'loops_id'          => 2,
                'pictures_id'       => 1,
                'title'             => '商品名称4',
                'profiles'          => '商品介绍4',
                'price'             => 80.00,
                'numbers'           => 15,
                'stocks'            => 15,
                'status'            => -2,//未通过
                'name'              => 'admin',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('goods.goods_table'))->insert($map);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}