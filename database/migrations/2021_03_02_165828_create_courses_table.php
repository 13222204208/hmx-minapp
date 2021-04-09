<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default('课程名称');
            $table->text('content')->comment('课程简介');
            $table->string('cover')->nullable()->comment('封面图');
            $table->string('schedule')->nullable()->comment('上课时间表');
            $table->decimal('price',9,2)->nullable();
            $table->integer('sort')->default(1)->comment('排序');
            $table->integer('course_type_id')->default(1)->comment('课程分类名称id');
            $table->tinyInteger('is_recommend')->default(0)->comment('是否推荐，0否 1,推荐');
            $table->tinyInteger('status')->default(1)->comment('1正常，0禁用');
            $table->timestamps();

            $table->comment="课程表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
