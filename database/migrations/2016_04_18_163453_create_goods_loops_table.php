<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsLoopsTable extends Migration
{
    const TBL_NAME = 'goods_loops';//商品圈子表

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->integer('goods_id')->unsigned();//商品ID
            $table->integer('loops_id')->unsigned();//圈子ID
            $table->integer('users_id')->unsigned();//用户ID
            $table->tinyInteger('types',false,true)->default(0);//发布者类型 0=分享者，1=创建者
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//创建时间
            $table->timestamp('updated_at')->default('0000-00-00 00:00');//更新时间
            $table->softDeletes();
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
