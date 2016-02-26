<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionDependencyTableSeeder
 */
class LoopsAuthorityTableSeeder extends Seeder
{

    public function run()
    {
        $table = config('loop.loops_authority_table');

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

        //添加圈子权限
        $map = [
            [
                'title'        => '圈子商品',
                'icon'         => 'fa-cart-plus',
                'path'         => 'admin/path',
                'types'        => 0,
                'sort'         => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '圈子成员',
                'icon'         => 'fa-users',
                'path'         => 'admin/path',
                'types'        => 0,
                'sort'         => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '圈主日记',
                'icon'         => 'fa-comments',
                'path'         => 'admin/path',
                'types'        => 0,
                'sort'         => 2,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '文字',
                'icon'         => 'fa-pencil-square',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 3,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '照片',
                'icon'         => 'fa-camera',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 4,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '语音',
                'icon'         => 'fa-commenting',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 5,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '视频',
                'icon'         => 'fa-video-camera',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 6,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '商品',
                'icon'         => 'fa-shopping-cart',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 7,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '分享',
                'icon'         => 'fa-share-alt-square',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 8,
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