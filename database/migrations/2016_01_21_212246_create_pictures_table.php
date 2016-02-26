<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    const TBL_NAME = 'pictures';//图片信息表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->integer('foreign_id')->unsigned();//外键ID
            $table->string('path',80);//地址
            $table->string('key',80);//图片名称
            $table->tinyInteger('types',false,true)->default(1);//类型 1=消息；2=商品；3=圈子
            $table->tinyInteger('status')->default(1);//状态 －1=回收；1=正常
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
