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
            $table->integer('type')->comment('第三方类型 1:新浪微博');
            $table->integer('userID')->comment('本网站用户ID');
            $table->string('nickName')->comment('第三方昵称');
            $table->string('avatar')->comment('第三方用户头像');
            $table->string('email')->comment('第三方用户邮箱');
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
