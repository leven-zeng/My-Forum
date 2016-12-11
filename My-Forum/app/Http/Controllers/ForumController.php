<?php

namespace App\Http\Controllers;

use App\Model\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
