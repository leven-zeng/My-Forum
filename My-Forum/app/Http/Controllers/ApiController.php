<?php

namespace App\Http\Controllers;

use App\Model\Articles;
use App\Model\Comments;
use App\Model\JsonString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

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

    //获取消息数
    public function getMsgCount(){
        $count=    Comments::where('forUserID','=',Auth::user()->id)
            ->where('isread','0')
            ->count();

        $jsonstr=    JsonString::create([
            'status'=>0,
            'count'=>$count
        ]);
        return $jsonstr->getJsonString($jsonstr);
    }

    //获取消息 根据用户ID，可传递userID或者登陆用户的ID
    public function getMessage(Request $request){
        $userID=Auth::user()->id;
        if($request->has('userID')){
            $userID=$request->get('userID');
        }

        $messages=DB::table('comments')
            ->leftjoin('articles','articles.aid','=','comments.articleID')
            ->leftjoin('users','users.id','=','comments.userID')
            ->where('comments.forUserID','=',$userID)
            ->where('comments.status','=',0)
            ->select('articles.title','users.name','comments.created_at','comments.ID','articles.aid','comments.isread')
            ->get();

        $arraymessage=[];
        foreach ($messages as $message) {
            $array=[];
            $content='<i>'.$message->name.'</i>在求解<a target="_blank" href="/forum/detail?aid='.$message->aid.'#dataid-'.$message->ID.'"><cite>'.$message->title.'</cite></a>中回复了你';
            $href=route('forum.detail',['aid'=>$message->aid]);
            array_set($array,'content',$content);
            array_set($array,'href',$href);
            array_set($array,'id',$message->ID);
            array_set($array,'read',$message->isread);
            array_set($array,'time',$message->created_at);
            array_push($arraymessage,$array);
        }

        return  response()->json(['status'=>0,'rows'=>$arraymessage]);
    }

    //消息设为已读
    public function msgread(){
        $res= Comments::where('forUserID','=',Auth::user()->id)
            ->where('isread','0')
            ->update(['isread'=>1]);

        $jsonstr=    JsonString::create([
            'status'=>0
        ]);
        return  $jsonstr->getJsonString($jsonstr);
    }

    //删除阅读后的消息
    public function msgdel(Request $request){
         $re= Comments::where('forUserID','=',Auth::user()->id)
             ->where(function($query) use($request){
                 if($request->has('type') && $request->get('type')=='all'){

                 }
             })
             ->where(function($query) use($request){
                 if($request->has('id') && $request->get('id')!=null){
                      $query->where('ID','=',$request->get('id'));
                 }
             })
            ->update(['status'=>1]);

        $jsonstr=    JsonString::create([
            'status'=>0
        ]);
        return  $jsonstr->getJsonString($jsonstr);
    }

}
