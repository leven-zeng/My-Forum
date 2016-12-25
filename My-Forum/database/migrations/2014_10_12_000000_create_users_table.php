<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('gender')->comment('0女 1男 ')->nullable();
            $table->string('email')->unique();
            $table->integer('isValiDataEmail')->default(0)->comment('是否验证邮箱 0未验证 1已验证');
            $table->string('city',20)->nullable(true)->comment('城市');
            $table->string('password');
            $table->string('register_from')->default('web_form')->index()->comment('注册来源');
            $table->string('profile_image')->nullable(true)->default('default.jpg')->comment('头像');
            $table->string('description')->nullable(true)->comment('一句简短的说明性文字，个性签名');
            $table->integer('wealth')->default(100)->comment('财富值 用户注册后默认有100 用户发布问答时奖励被采纳人');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
