<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoopsMessagesTable extends Migration
{
    const TBL_NAME = 'loops_messages';//圈子消息表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->integer('users_id')->unsigned();//用户ID
            $table->integer('loops_id')->unsigned();//圈子ID
            $table->integer('goods_id')->unsigned();//商品ID
            $table->integer('loops_authority_id')->unsigned();//权限类型ID
            $table->string('contents');//内容
            $table->integer('pictures_id')->unsigned();//图片ID
            $table->tinyInteger('status')->default(1);//状态 －1=回收；1=正常
            $table->date('date_node');//日期节点
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
