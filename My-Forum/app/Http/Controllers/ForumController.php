<?php

namespace App\Http\Controllers;


use App\Model\Articles;
use App\Model\Comments;
use App\Model\JsonString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
//DB::connection()->enableQueryLog(); // 开启查询日志
//$queries = DB::getQueryLog(); // 获取查询日志
//dd($queries);
    //
    public function index()
    {
        //$articles=Articles::paginate(15)->leftjoin('users','aid','=','aid');

        $articles = DB::table('articles')
            ->leftjoin('users', 'articles.userid', '=', 'users.id')
            ->select('articles.*','users.name','users.profile_image')
            ->orderBy('articles.created_at','desc')
            ->paginate(15);


        //dd($articles);
        return view('forum.index',['articles'=>$articles]);
    }

    public function detail(Request $request)
    {
        $article=  Articles::where('articles.aid',$request->get('aid'))
            ->leftjoin('users','articles.userid','=','users.id')
            ->select('articles.*','users.profile_image','users.name')
            ->first();


        $article->clicknum++;
        $article->save();

        //读取评论
        $comments = DB::table('comments')
            ->leftjoin('articles as a', 'comments.articleID', '=', 'a.aid')
            ->leftjoin('users','a.userID','=','users.id')
            ->leftjoin('users as user2','comments.forUserID','=','user2.ID')
            ->select('comments.*','users.name','users.profile_image','user2.name as replyusername','user2.ID as replyuserID')
            ->where("a.aid",$request->get('aid'))
            ->orderBy('comments.id')
            ->paginate(15);

        $hotclicks=Articles::where('articles.status',0)
            ->select('articles.*')
            ->orderBy('clickNum','desc')
            ->limit(10)
            ->get();



        return view('forum.detail',['article'=>$article,'comments'=>$comments,'hotclicks'=>$hotclicks]);
    }

    public function add()
    {
        return view('forum.add');
    }

    ///发布新的文字
    public function postadd(Request $request)
    {
        $input=Input::all();
        $v=Validator::make($input,
        [
            'title'=>'required|max:30',
            'content'=>'required'
        ],[],[
                'title'=>'标题',
                'content'=>'内容',
            ]);

        if ($v->fails())
        {
            return    $this->getJsonString('500',$v->errors()->first(),'','');
        }

         $article=    Articles::create([
            'userid'=>Auth::user()->id,
            'title'=>$request->get('title'),
            'content'=>$request->get('content'),
            'reward'=>$request->get('reward'),
            'tagid'=>$request->get('tagid')
        ]);

        return    $this->getJsonString('0','保存成功,即将为你跳转','',$article->aid);

    }

    //上传图片
    public function upload(Request $request)
    {
        if($request->hasFile('file'))
        {
            $images=$request->file('file'); //使用laravel 自带的request类来获取一下文件.
            $imgsize=    $images->getClientSize();
            if($imgsize>150*1024)
            {
                return response()->json(['code'=>'500','msg'=>'图片不能大于150KB','data'=>'','title'=>'']);
            }

            $extension=$images->getClientOriginalExtension();//获取扩展名
            $newImageName=md5(time().random_int(5,5)).'.'.$extension;
            $images->move('images/userimages/',$newImageName);

            $src='/images/userimages/'.$newImageName;
            return response()->json(['code'=>'0','msg'=>'','data'=>['src'=>$src,'title'=>$newImageName]]);

        }

        return response()->json(['code'=>'500','msg'=>'','data'=>['src'=>'/images/userimages/','title'=>'']]);
    }

    //添加评论
    public  function postcomment(Request $request)
    {
        if(Auth::check()==false)
        {
            return $this->getJsonString('500','请先登录','','');
        }

        $input=Input::all();
        $v=Validator::make($input,
            [
                'articleID'=>'required',
                'content'=>'required'
            ],[],[
                'content'=>'内容',
            ]);

        if ($v->fails())
        {
            return    $this->getJsonString('500',$v->errors()->first(),'','');
        }

        $comment=    Comments::create([
            'userid'=>Auth::user()->id,
            'articleID'=>$request->get('articleID'),
            'content'=>$request->get('content'),
            'forUserID'=>$request->get('replyuserID')
        ]);

        //return  $this->getJsonString('0','提交回答已完成','',$comment->id);
        $jsonstr= JsonString::create([
            'status'=>'0',
            'msg'=>'提交回答已完成',
            'id'=>$comment->id
        ]);
        return $jsonstr->getJsonString($jsonstr);
    }

    public function addlike(Request $request){
       $comment= Comments::where('ID',$request->get('id'))->first();
        $comment->likeNum++;
        DB::connection()->enableQueryLog(); // 开启查询日志
         $res= $comment->save();
        if($res){
           $jsonstr= JsonString::create([
               'status'=>'0'
           ]);
       }else{
           $jsonstr= JsonString::create([
               'status'=>'500'
           ]);
       }
        return $jsonstr->getJsonString($jsonstr);
    }
}
