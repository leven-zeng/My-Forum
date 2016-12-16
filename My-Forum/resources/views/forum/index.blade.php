@extends('layouts.head')

@section('content')
<div class="main layui-clear">
    <div class="wrap">
        <div class="content" style="margin-right:0">
            <div class="fly-tab">
        <span>
          <a href="" class="tab-this">全部</a>
          <a href="">未结帖</a>
          <a href="">已采纳</a>
          <a href="">精帖</a>
          <a href="../user/index.html">我的帖</a>
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
                    <a href="user/home.html" class="fly-list-avatar">
                        <img src="images/userimages/{{$article->profile_image}}" alt="">
                    </a>
                    <h2 class="fly-tip">
                        <a href="forum/detail?aid={{$article->aid}}">{{$article->title}}</a>
                        <span class="fly-tip-stick">置顶</span>
                        <span class="fly-tip-jing">精帖</span>
                    </h2>
                    <p>
                        <span><a href="user/home.html">{{$article->name}}</a></span>
                        <span>{{\Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</span>
                        <span>layui框架综合</span>
            <span class="fly-list-hint"> 
              <i class="iconfont" title="回答"></i> 317
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