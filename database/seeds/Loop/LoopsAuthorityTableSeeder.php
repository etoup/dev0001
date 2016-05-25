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
                'icon'         => 'xec11',
                'normal_img'   => '',
                'active_img'   => '',
                'tags'         => 'cate-goods',
                'path'         => 'admin/path',
                'types'        => 0,
                'sort'         => 0,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '圈子成员',
                'icon'         => 'xea38',
                'normal_img'   => '',
                'active_img'   => '',
                'tags'         => 'cate-users',
                'path'         => 'admin/path',
                'types'        => 0,
                'sort'         => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '圈主日记',
                'icon'         => 'xec81',
                'normal_img'   => '',
                'active_img'   => '',
                'tags'         => 'cate-diary',
                'path'         => 'admin/path',
                'types'        => 0,
                'sort'         => 2,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '文字',
                'icon'         => 'xed59',
                'normal_img'   => 'widget://image/album1.png',
                'active_img'   => 'widget://image/album2.png',
                'tags'         => 'my-text',
                'path'         => 'admin/path',
                'types'        => 2,
                'sort'         => 3,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '图片',
                'icon'         => 'xeb04',
                'normal_img'   => 'widget://image/function/photo.png',
                'active_img'   => 'widget://image/function/photo.png',
                'tags'         => 'my-img',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 4,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '照片',
                'icon'         => 'xec44',
                'normal_img'   => 'widget://image/function/camera.png',
                'active_img'   => 'widget://image/function/camera.png',
                'tags'         => 'my-photo',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 5,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '发布商品',
                'icon'         => 'xeca0',
                'normal_img'   => 'widget://image/function/ware.png',
                'active_img'   => 'widget://image/function/ware.png',
                'tags'         => 'my-goods',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 6,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '分享商品',
                'icon'         => 'xebe4',
                'normal_img'   => 'widget://image/function/share.png',
                'active_img'   => 'widget://image/function/share.png',
                'tags'         => 'my-share',
                'path'         => 'admin/path',
                'types'        => 1,
                'sort'         => 7,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'title'        => '添加日记',
                'icon'         => 'xeb28',
                'normal_img'   => 'widget://image/function/diary.png',
                'active_img'   => 'widget://image/function/diary.png',
                'tags'         => 'my-diary',
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