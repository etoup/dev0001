<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    const TBL_NAME = 'goods';//商品表
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
            $table->integer('pictures_id')->unsigned();//封面图片ID
            $table->string('title',40);//标题
            $table->string('profiles');//简介
            $table->decimal('price',10,2);//价格
            $table->smallInteger('numbers')->unsigned();//数量
            $table->smallInteger('stocks')->unsigned();//库存
            $table->tinyInteger('status')->default(0);//状态 0=待审；－1=下架；1=上架；－2=未通过
            $table->string('name');//审批人用户名
            $table->string('remark');//备注
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
