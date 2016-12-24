<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comments extends Model
{
    protected $primaryKey = 'ID';
    //
    protected $fillable = [
        'userid', 'content','articleID','ID','forUserID'
    ];


    //获取用户的回答数据
    public static function getCommentsByUserID($userID){
        $messages=DB::table('comments')
            ->leftjoin('articles','articles.aid','=','comments.articleID')
            ->leftjoin('users','users.id','=','comments.userID')
            ->where('comments.userID','=',$userID)
            ->select('articles.title','users.name','comments.created_at','comments.ID','articles.aid','comments.isread','comments.content','comments.forUserID')
            ->get();
        return $messages;
    }
}
