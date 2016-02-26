<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoopsTable extends Migration
{
    const TBL_NAME = 'loops';//圈子表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->integer('users_id')->unsigned();//圈主ID
            $table->integer('pictures_id')->unsigned();//图片ID
            $table->integer('loops_tags_id')->unsigned()->nullable();//圈子分类
            $table->string('title',40)->unique();//圈子标题
            $table->string('profiles',40);//圈子简介
            $table->decimal('liveness')->default(0.00);//活跃度
            $table->tinyInteger('types',false,true)->default(1);//类型 0＝圈子助手
            $table->tinyInteger('sort',false,true)->default(1);//排序，0=置顶
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//创建时间
            $table->timestamp('updated_at')->default('0000-00-00 00:00');//更新时间
            $table->softDeletes();

            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('loops_tags_id')
                ->references('id')
                ->on(config('loop.loops_tags_table'))
                ->onDelete('SET NULL');
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
        Schema::table(self::TBL_NAME, function (Blueprint $table) {
            $table->dropForeign(self::TBL_NAME . '_loops_tags_id_foreign');
        });

        Schema::drop(self::TBL_NAME);
    }
}
