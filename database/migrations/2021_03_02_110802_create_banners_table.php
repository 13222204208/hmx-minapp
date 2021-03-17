<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('img_url')->comment('图片地址');
            $table->tinyInteger('sort')->default(1)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->string('skip_url')->nullable()->comment('跳转到外面链接');
            $table->timestamps();

            $table->comment="轮播图";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
