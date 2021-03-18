<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('频道名称');
            $table->text('content')->nullable()->comment('频道简介');
            $table->string('cover')->nullable()->comment('封面图');
            $table->integer('sort')->default(1)->comment('排序');
            $table->tinyInteger('is_recommend')->default(0)->comment('是否推荐首页，0否 1,推荐');
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->timestamps();

            $table->comment="频道表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
