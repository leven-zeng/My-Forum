<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('aid');
            $table->integer('userid');
            $table->string('title',50);
            $table->text('content');
            $table->integer('status')->default(0);#
            $table->integer('isdel')->default(0);
            $table->integer('tagid')->default(0);
            $table->integer('type')->default(0);
            $table->integer('clicknum')->default(0);
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
        Schema::drop('articles');
    }
}