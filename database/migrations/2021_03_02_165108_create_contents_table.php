<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default('标题');
            $table->text('content')->comment('图文编辑');
            $table->integer('channel_id')->comment('选择频道');
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->timestamps();

            $table->comment="内容表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
