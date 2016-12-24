<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Articles extends Model
{
    protected $primaryKey = 'aid';

    protected $fillable = [
        'userid', 'title', 'content','reward','status','isgood','tagid'
    ];
    //
    public function getprofile_image()
    {
        if($this->profile_image<>null) {
            return '/images/userimages/'.$this->profile_image;
        }else{
            return '';
        }
    }

    //获取日期文字版
    public function getdiffForHumans()
    {
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

    //判断登录是否当前用户
    public function isCurrUser()
    {
        if(Auth::check())
        {
        $user=Auth::user();
        if($this->userid==$user->id)
        {
            return true;
        }
        }
        return false;
    }

    //根据userID获取文章
    public static function getArticle($userID){
        //return Articles::where('userID','=',$userID)->get();
        return    DB::table('articles')
            ->select(DB::raw('count(comments.articleID) as comment_count,articles.*,users.name,users.profile_image'))
            ->leftjoin('users', 'articles.userid', '=', 'users.id')
            ->leftjoin('comments','comments.articleID','=','articles.aid')
            ->groupBy('comments.articleID', 'users.name','users.profile_image','articles.userID','articles.content','articles.reward','articles.status','articles.isdel'
                ,'articles.tagid','articles.type','articles.updated_at','articles.aid','articles.title','articles.topNum','articles.isgood','articles.created_at','articles.clicknum')
            ->orderBy('articles.created_at','desc')
            ->where('articles.userID','=',$userID)
            ->get();
    }
}
