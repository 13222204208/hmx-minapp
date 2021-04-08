<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content")->nullable()->comment("消息内容");
            $table->tinyInteger("msg_type")->default(1)->comment("1活动通知 ，2 订单通知， 3系统通知");
            $table->unsignedBigInteger("user_id")->default(0)->comment("0 默认为通知所有用户");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
