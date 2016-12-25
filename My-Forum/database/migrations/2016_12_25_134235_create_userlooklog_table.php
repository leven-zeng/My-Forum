<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserlooklogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_look_logs', function (Blueprint $table) {
            $table->increments('ID')->comment('ID');
            $table->integer('lookUserID')->comment('发起查看的用户ID');
            $table->integer('lookForUserID')->comment('被查看的用户ID');
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
        Schema::drop('user_look_logs');
    }
}
