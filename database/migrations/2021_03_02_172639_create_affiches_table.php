<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiches', function (Blueprint $table) {
            $table->id();
            $table->string('content')->comment('公告内容');
            $table->string('start_time')->comment('公告开始时间');
            $table->string('stop_time')->comment('公告结束时间');
            $table->timestamps();

            $table->comment="公告表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiches');
    }
}
