<?php

namespace App\Http\Controllers;

use App\Model\Articles;
use App\Model\JsonString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //获取用户自己的解答文章
    public function mine_jie(){

        $userID=Auth::user()->id;
        $article=$this->getArticle($userID);

    $jsonstr=    JsonString::create([
            'status'=>0,
            'rows'=>$article,
        'count'=>$article->count()
        ]);
        return $jsonstr->getJsonString($jsonstr);
    }

    public function getArticle($userID){
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
