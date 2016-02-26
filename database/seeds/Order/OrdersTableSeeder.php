<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('orders.orders_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('orders.orders_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('orders.orders_table') . ' CASCADE');
        }

        //添加订单
        $map = [
            [
                'orders_numbers'    => 201602080808999990,
                'users_id'          => 3,
                'goods_id'          => 1,
                'users_address_id'  => 1,
                'price'             => 100.00,
                'status'            => 0,
                'business_id'       => 1,
                'remark'            => '请安全包装好1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'orders_numbers'    => 201602080808999991,
                'users_id'          => 4,
                'goods_id'          => 1,
                'users_address_id'  => 2,
                'price'             => 100.00,
                'status'            => 10,
                'business_id'       => 1,
                'remark'            => '请安全包装好2',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'orders_numbers'    => 201602080808999992,
                'users_id'          => 5,
                'goods_id'          => 1,
                'users_address_id'  => 3,
                'price'             => 100.00,
                'status'            => 20,
                'business_id'       => 1,
                'remark'            => '请安全包装好3',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'orders_numbers'    => 201602080808999993,
                'users_id'          => 6,
                'goods_id'          => 1,
                'users_address_id'  => 4,
                'price'             => 100.00,
                'status'            => 80,
                'business_id'       => 1,
                'remark'            => '请安全包装好4',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('orders.orders_table'))->insert($map);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}