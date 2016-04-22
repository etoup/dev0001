<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('access.users_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.users_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.users_table') . ' CASCADE');
        }

        //Add the master administrator, user id of 1
        $users = [
            [
                'name'              => 'admin',
                'email'             => 'admin@admin.com',
                'mobile'            => '18088889990',
                'token'             => Crypt::encrypt('00000'),
                'im_token'          => 'OnAj14mj+KyT2MdrBmn8VKyyMrwDXa64MWV3iah+6ur4uV9niaU05gJQ9XgX7mSFv8sMVErIoSS+bwbSG1TNJw==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 10,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user1',
                'email'             => 'user1@user.com',
                'mobile'            => '18088889991',
                'token'             => Crypt::encrypt('00001'),
                'im_token'          => 'pEQo7r95MIU7icC7S51kqqyyMrwDXa64MWV3iah+6ur4uV9niaU05r2QdtTHmFtkncEXGoyEYEi+bwbSG1TNJw==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 10,
                'business_id'       => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user2',
                'email'             => 'user2@user.com',
                'mobile'            => '18088889992',
                'token'             => Crypt::encrypt('00002'),
                'im_token'          => 'rYt0VWdSUn5ivZkp2JHq0vvqbh7SGufJG+8M5S5YFJLDgn3iGDZGzfYkWcT5SVdLSqyM1bBilfzEQ7zULdkZqA==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 0,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user3',
                'email'             => 'user3@user.com',
                'mobile'            => '18088889993',
                'token'             => Crypt::encrypt('00003'),
                'im_token'          => 'ltarjh6qcf4El9zQlUf8Kvvqbh7SGufJG+8M5S5YFJLDgn3iGDZGzUXi0c7vtseIe745U566ZtHEQ7zULdkZqA==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 0,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user4',
                'email'             => 'user4@user.com',
                'mobile'            => '18088889994',
                'token'             => Crypt::encrypt('00004'),
                'im_token'          => '0wgei7sPHvdrqPFo26XaPQoDrFOJwk/zSR6u2VdP5E5zR4ZvMnWSNV/6of73wsUP5UGlRWVmyUQ=',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 0,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user5',
                'email'             => 'user5@user.com',
                'mobile'            => '18088889995',
                'token'             => Crypt::encrypt('00005'),
                'im_token'          => 'unVaLETZwfZlwoFR1pnJLfvqbh7SGufJG+8M5S5YFJLDgn3iGDZGzS0aikL8Z5zrp3LZkO4RvWvEQ7zULdkZqA==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 0,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user6',
                'email'             => 'user6@user.com',
                'mobile'            => '18088889996',
                'token'             => Crypt::encrypt('00006'),
                'im_token'          => 'dDXwfj85BrWGJA3NaNjAQqyyMrwDXa64MWV3iah+6ur4uV9niaU05kIV7zlT2de3qGjJE196ewC+bwbSG1TNJw==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 0,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'user7',
                'email'             => 'user7@user.com',
                'mobile'            => '18088889997',
                'token'             => Crypt::encrypt('00007'),
                'im_token'          => 'GadbhCRcy6WNhoypxzBVZ6yyMrwDXa64MWV3iah+6ur4uV9niaU05iATCgkpKQAcSLYFysOCVMe+bwbSG1TNJw==',
                'password'          => bcrypt('1234'),
                'headimgurl'        => 'http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'loop_roles'        => 0,
                'business_id'       => 0,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('access.users_table'))->insert($users);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}