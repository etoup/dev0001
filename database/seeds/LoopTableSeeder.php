<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoopTableSeeder extends Seeder
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

        $this->call(LoopsTagsTableSeeder::class);
        $this->call(LoopsTableSeeder::class);
        $this->call(LoopsAuthorityTableSeeder::class);
        $this->call(LoopsMessagesTableSeeder::class);
        $this->call(LoopsDiariesTableSeeder::class);
        $this->call(LoopsFollowsTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
