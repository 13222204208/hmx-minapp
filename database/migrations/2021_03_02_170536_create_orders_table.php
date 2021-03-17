<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num')->default('订单号');
            $table->string('username')->comment('用户名');
            $table->integer('course_id')->comment('购买的课程');
            $table->decimal('pay_price',9,2)->comment('支付金额');
            $table->string('pay_time')->comment('支付时间');
            $table->integer('pay_state')->default(0)->comment('0 未支付，1支付成功，2 支付失败');
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->timestamps();

            $table->comment="订单表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
