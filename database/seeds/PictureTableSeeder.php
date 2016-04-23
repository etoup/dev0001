<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PictureTableSeeder extends Seeder
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

        $this->call(PicturesTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}