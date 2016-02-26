<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoopsSetsTable extends Migration
{
    const TBL_NAME = 'loops_sets';//圈子操作设置表
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
            $table->integer('loops_authority_id')->unsigned();//操作ID
            $table->tinyInteger('types',false,true)->default(0);//类型 0=目录；1=功能
            $table->tinyInteger('loop_roles',false,true)->default(0);//角色 0=用户；10=圈主
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//创建时间
            $table->timestamp('updated_at')->default('0000-00-00 00:00');//更新时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TBL_NAME);
    }
}
