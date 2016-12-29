@extends('layouts.head',['title'=>'追爱吧'])

@section('content')
<div class="main layui-clear">
    <div class="wrap">
        <div class="content" style="margin-right:0">
            <div class="fly-tab">
        <span>
          <a href="{{route('forum.index')}}" class="{{$current==0?"tab-this":""}}">全部</a>
          <a href="{{route('forum.index',['status'=>0])}}"  class="{{$current==1?"tab-this":""}}">未结帖</a>
          <a href="{{route('forum.index',['status'=>1])}}"  class="{{$current==2?"tab-this":""}}">已采纳</a>
          <a href="{{route('forum.index',['isgood'=>1])}}"  class="{{$current==3?"tab-this":""}}">精帖</a>
          <a href="{{route('user.index')}}">我的帖</a>
        </span>
                <form action="http://cn.bing.com/search" class="fly-search">
                    <i class="iconfont icon-sousuo"></i>
                    <input class="layui-input" autocomplete="off" placeholder="搜索内容，回车跳转" type="text" name="q">
                </form>
                <a href="{{route('forum.add')}}" class="layui-btn jie-add">发布问题</a>
            </div>

            <ul class="fly-list">
                @foreach($articles as $article)
                <li class="fly-list-li">
                    <a href="{{route('user.home',['userID'=>$article->userid])}}" class="fly-list-avatar">
                        <img src="{{\App\Service\Help::getImgSrc($article->profile_image)}}" alt="">
                    </a>
                    <h2 class="fly-tip">
                        <a href="forum/detail?aid={{$article->aid}}">{{$article->title}}</a>
                        @if($article->topNum>0)
                        <span class="fly-tip-stick">置顶</span>
                        @endif
                        @if($article->isgood==1)
                        <span class="fly-tip-jing">精帖</span>
                        @endif
                    </h2>
                    <p>
                        <span><a href="user/home.html">{{$article->name}}</a></span>
                        <span>{{\Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</span>
                        <span>
                            {{\App\Service\Help::getTagNameByID($article->tagid)}}
                        </span>
            <span class="fly-list-hint"> 
              <i class="iconfont" title="回答"></i> {{$article->comment_count}}
              <i class="iconfont" title="人气"></i> {{$article->clicknum}}
            </span>
                    </p>
                </li>

                    @endforeach
            </ul>

            <!-- <div class="fly-none">并无相关数据</div> -->
            {!! $articles->render() !!}
            {{--<div style="text-align: center">
                <div class="laypage-main"><span class="laypage-curr">1</span><a href="/jie/page/2/">2</a><a href="/jie/page/3/">3</a><a href="/jie/page/4/">4</a><a href="/jie/page/5/">5</a><span>…</span><a href="/jie/page/148/" class="laypage-last" title="尾页">尾页</a><a href="/jie/page/2/" class="laypage-next">下一页</a></div>
            </div>--}}


        </div>
    </div>
</div>
@include('layouts.foot')
@endsection
