<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table->string('children_name')->comment('少儿姓名');
            $table->string('phone')->comment('联系方式');
            $table->string('enroll_name')->comment('报名人姓名');
            $table->integer('activity_id')->comment('活动ID');
            $table->tinyInteger('status')->default(0)->comment('0 未处理 1已处理');
            $table->timestamps();

            $table->comment="报名表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolls');
    }
}
