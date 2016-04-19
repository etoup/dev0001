<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('pictures.pictures_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('pictures.pictures_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('pictures.pictures_table') . ' CASCADE');
        }

        $map = [
            [
                'foreign_id'        => 2,
                'path'              => 'http://7u2i5s.com1.z0.glb.clouddn.com/photo1.png',
                'key'               => 'photo2.png',
                'types'             => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'foreign_id'        => 3,
                'path'              => 'http://7u2i5s.com1.z0.glb.clouddn.com/photo2.png',
                'key'               => 'photo2.png',
                'types'             => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'foreign_id'        => 4,
                'path'              => 'http://7u2i5s.com1.z0.glb.clouddn.com/photo1.png',
                'key'               => 'photo2.png',
                'types'             => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'foreign_id'        => 5,
                'path'              => 'http://7u2i5s.com1.z0.glb.clouddn.com/photo2.png',
                'key'               => 'photo2.png',
                'types'             => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'foreign_id'        => 2,
                'path'              => 'http://7u2i5s.com1.z0.glb.clouddn.com/avatar.png',
                'key'               => 'avatar.png',
                'types'             => 4,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('pictures.pictures_table'))->insert($map);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
