<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoopsFollowsTable extends Migration
{
    const TBL_NAME = 'loops_follows';//圈子关注表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->integer('loops_id')->unsigned();//圈子ID
            $table->integer('users_id')->unsigned();//用户ID
            $table->tinyInteger('types',false,true)->default(0);//类型 0=会员；1=圈主
            $table->tinyInteger('status')->default(1);//状态 －1=回收；1=正常
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//创建时间
            $table->timestamp('updated_at')->default('0000-00-00 00:00');//更新时间
            $table->softDeletes();

            /**
             * Add Foreign/Unique/Index
             */
//            $table->foreign('loops_id')
//                ->references('id')
//                ->on(config('loop.loops_table'))
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * Remove Foreign/Unique/Index
         */
//        Schema::table(self::TBL_NAME, function (Blueprint $table) {
//            $table->dropForeign(self::TBL_NAME . '_loops_id_foreign');
//        });

        Schema::drop(self::TBL_NAME);
    }
}
