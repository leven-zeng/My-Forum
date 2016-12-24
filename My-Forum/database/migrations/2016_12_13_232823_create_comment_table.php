<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("comments",function(Blueprint $table){
            $table->increments('ID')->comment('ID');
            $table->integer('articleID')->comment('所评论的文章ID');
            $table->integer('userID')->comment('评论用户ID');
            $table->string('content')->comment('评论的内容');
            $table->integer('forUserID')->default(0)->comment('回复某用户的评论 形式如 @某人');
            $table->integer('isaccept')->default(0)->after('likeNum')->comment('0未被采纳 1已被采纳 解答是否被采纳');
            $table->timestamp('acceptTime')->after('isaccept')->comment('被采纳时间');
            $table->integer('isread')->default(0)->after('likeNum')->comment('0未读 1已读 是否已读');
            $table->integer('status')->default('0')->comment('状态 0正常 1删除');
            $table->integer('likeNum')->default(0)->comment('点赞数');

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
        //
    }
}
