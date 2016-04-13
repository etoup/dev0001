<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoopsTagsTable extends Migration
{
    const TBL_NAME = 'loops_tags';//圈子标签表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->string('title',20)->unique();//标签名称
            $table->tinyInteger('types',false,true)->default(0);//类型 0＝常规；10＝热门；20＝关注
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
