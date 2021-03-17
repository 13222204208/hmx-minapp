<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('cover')->nullable()->comment('封面图');
            $table->text('content')->comment('简介');
            $table->string('start_time')->nullable();
            $table->string('stop_time')->nullable();
            $table->decimal('price',9,2)->nullable();
            $table->tinyInteger('is_recommend')->default(0)->comment('是否推荐首页，0否 1,推荐');
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->timestamps();

            $table->comment="活动表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
