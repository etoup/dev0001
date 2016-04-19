<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRoleSeeder
 */
class UserAddressSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('access.users_address_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.users_address_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.users_address_table') . ' CASCADE');
        }

        $map = [
            [
                'users_id'          => 3,
                'real_name'         => '姓名3',
                'mobile'            => '18677788893',
                'address'           => '湖北省武汉市武昌区楚河汉街1',
                'code'              => '123456',
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 4,
                'real_name'         => '姓名4',
                'mobile'            => '18677788894',
                'address'           => '湖北省武汉市武昌区楚河汉街2',
                'code'              => '123456',
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 5,
                'real_name'         => '姓名5',
                'mobile'            => '18677788895',
                'address'           => '湖北省武汉市武昌区楚河汉街3',
                'code'              => '123456',
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'users_id'          => 6,
                'real_name'         => '姓名6',
                'mobile'            => '18677788896',
                'address'           => '湖北省武汉市武昌区楚河汉街4',
                'code'              => '123456',
                'types'             => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('access.users_address_table'))->insert($map);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}