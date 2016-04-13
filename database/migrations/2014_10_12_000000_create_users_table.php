<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('token')->unique();//md5(微信的openId)
            $table->string('im_token');//即时通讯token
            $table->char('mobile',11);
            $table->string('password', 60)->nullable();
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true);
            $table->rememberToken();
            $table->tinyInteger('source',false,true)->default(0);//来源 0=默认；1=微信
            $table->string('nickname');//昵称
            $table->string('headimgurl');//用户头像
            $table->string('country', 20);//国家
            $table->string('province', 40);//省份
            $table->string('city', 40);//城市
            $table->tinyInteger('sex',false,true)->default(0);//性别 0=默认；1=男；2=女
            $table->tinyInteger('loop_roles',false,true)->default(0);//角色 0=用户；10=圈主
            $table->integer('business_id',false,true)->default(0);//商家信息ID
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default('0000-00-00 00:00');
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
        Schema::drop('users');
    }
}
