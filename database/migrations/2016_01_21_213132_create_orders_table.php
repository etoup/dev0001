    <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    const TBL_NAME = 'orders';//订单表
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TBL_NAME,function(Blueprint $table){
            $table->increments('id');
            $table->char('orders_numbers',20);//订单号 Ymdhis.6位随机数
            $table->integer('users_id')->unsigned();//用户ID
            $table->integer('goods_id')->unsigned();//商品ID
            $table->integer('users_address_id')->unsigned();//收获地址ID
            $table->decimal('price',10,2);//价格
            $table->tinyInteger('status')->default(0);//状态 0=待付款；10=已付款待发货；20=已发货；80=已收货；88=已评价；90=申请提现；100=已支付货款
            $table->integer('business_id')->unsigned();//商家信息ID
            $table->tinyInteger('pay_types',false,true)->default(1);//付款方式 1=微信
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
