<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsPicturesTable extends Migration
{
    const TBL_NAME = 'goods_pictures';//商品图片表
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
            $table->integer('pictures_id')->unsigned();//图片ID
            $table->tinyInteger('status')->default(1);//状态 －1=回收；1=正常
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
