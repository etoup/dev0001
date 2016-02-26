<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    const TBL_NAME = 'business';//商家信息表
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
            $table->string('business_name');//商家姓名
            $table->char('business_mobile',11);//商家电话
            $table->string('business_card',32);//商家收款银行卡
            $table->string('business_card_bank',32);//支行地址
            $table->tinyInteger('status',false,true)->default(1);//状态 0=待审，1=正常
            $table->string('remark',80);//备注
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
