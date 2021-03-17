<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name')->default('超级管理员');
            $table->string('roles')->nullable();
            $table->string('email')->nullable();
            $table->string('introduction')->nullable()->comment('自我介绍');
            $table->string('avatar')->default('https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif')->comment('头像');
            $table->string('phone')->nullable();
            $table->tinyInteger('status')->default(1)->comment('状态 ，1 正常，0,禁用');
            $table->timestamps();

            $table->comment="后台登陆帐号";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
