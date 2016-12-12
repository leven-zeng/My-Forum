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
            $table->increments('aid')->comment('ID');
            $table->integer('userid')->comment('发布者用户ID');
            $table->string('title',50)->comment('标题');
            $table->text('content')->comment('内容');
            $table->integer('reward')->comment('悬赏数');
            $table->integer('status')->default(0)->comment('状态 0正常 1已采纳（完结） ');
            $table->integer('isgood')->default(0)->comment('是否加精状态 0正常 1加精 ');
            $table->integer('topNum')->default(0)->comment('置顶序号，值越大越靠前 ');
            $table->integer('isdel')->default(0)->comment('删除状态 0正常 1删除');
            $table->integer('tagid')->default(0)->comment('标签id');
            $table->integer('type')->default(0)->comment('类型 0默认');
            $table->integer('clicknum')->default(0)->comment('点击次数');
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