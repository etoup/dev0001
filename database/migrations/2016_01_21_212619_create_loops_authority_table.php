<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoopsAuthorityTable extends Migration
{
    const TBL_NAME = 'loops_authority';//圈子操作权限表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->string('title',20);//标题
            $table->string('icon',20);//图标
            $table->string('path',20);//Route
            $table->tinyInteger('types',false,true)->default(0);//类型 0=目录；1=功能
            $table->tinyInteger('status')->default(1);//状态 －1=禁用；1=正常
            $table->tinyInteger('sort',false,true)->default(0);//排序 asc
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
