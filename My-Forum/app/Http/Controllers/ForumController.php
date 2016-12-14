<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\PermissionFormRequest;
use App\Model\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment;

class ForumController extends Controller
{
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
        $article=  Articles::where('aid',$request->get('aid'))
            ->leftjoin('users','articles.userid','=','users.id')
            ->select('articles.*','users.profile_image','users.name')
            ->first();
        return view('forum.detail',['article'=>$article]);
    }

    public function add()
    {
        return view('forum.add');
    }

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

        return    $this->getJsonString('0','保存成功,即将为你跳转','',$article->id);

    }

    //上传图片
    public function upload(Request $request)
    {
        if($request->hasFile('file'))
        {
            $images=$request->file('file'); //使用laravel 自带的request类来获取一下文件.
            $extension=$images->getClientOriginalExtension();//获取扩展名
            $newImageName=md5(time().random_int(5,5)).'.'.$extension;
            $images->move('images/userimages/',$newImageName);
            return response()->json(['code'=>'0','msg'=>'','data'=>['src'=>'/images/userimages/'.$newImageName,'title'=>$newImageName]]);

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

        $comment=    \App\Model\Comments::create([
            'userid'=>Auth::user()->id,
            'articleID'=>$request->get('articleID'),
            'content'=>$request->get('content')
        ]);

        return  $this->getJsonString('0','保存成功,即将为你跳转','',$comment->id);
    }
}
