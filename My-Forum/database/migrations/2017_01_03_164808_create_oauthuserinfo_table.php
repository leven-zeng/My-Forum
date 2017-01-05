<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthuserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_auth_user_infos', function (Blueprint $table) {
            $table->increments('ID')->comment('ID');
            $table->string('uid')->comment('第三方uid');
            $table->string('token')->comment('第三方token');
            $table->string('location')->nullable(true)->comment('第三方获取地址信息');
            $table->string('description')->nullable(true)->comment('第三方获取用户描述信息');
            $table->string('gender')->comment('第三方获取用户gender m:男 f:女');
            $table->string('nickName')->nullable(true)->comment('第三方昵称');
            $table->string('avatar')->nullable(true)->comment('第三方用户头像');
            $table->string('email')->nullable(true)->comment('第三方用户邮箱');
            $table->integer('type')->comment('第三方类型 1:新浪微博');
            $table->integer('userID')->nullable(true)->comment('本网站用户ID');
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
        Schema::drop('o_auth_user_infos');
    }
}
