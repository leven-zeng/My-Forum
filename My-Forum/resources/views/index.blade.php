<?php
/**
 * Created by PhpStorm.
 * User: Leven
 * Date: 2017/1/2
 * Time: 22:45
 */?>
@extends('layouts.head')

@section('content')
<div class="main layui-clear">
    <div class="wrap">
        <div class="content">
            <div class="fly-tab">
                <span>
                    <a href="{{route('forum.index')}}" class="">全部</a>
                    <a href="{{route('forum.index',['status'=>0])}}"  class="">未结帖</a>
                    <a href="{{route('forum.index',['status'=>1])}}"  class="">已采纳</a>
                    <a href="{{route('forum.index',['isgood'=>1])}}"  class="">精帖</a><a href="{{route('user.index')}}">我的帖</a>
                </span>
                <form action="{{route('forum.index')}}" class="fly-search">
                    <i class="iconfont icon-sousuo"></i>
                    <input class="layui-input" autocomplete="off" placeholder="搜索内容，回车跳转" type="text" name="q">
                </form>
                <a href="{{route('forum.add')}}" class="layui-btn jie-add">发布问题</a>
            </div>
            <ul class="fly-list">
                @if($articles->count()>0)
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
                                    <span><a href="{{route('user.home',['userID'=>$article->userid])}}">{{$article->name}}</a></span>
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
                @else
                    <div class="fly-none">并无相关数据</div>
                @endif
            </ul>
            <div style="text-align: center">
                @if($articles->count()>20)
                <div class="laypage-main">
                    <a href="{{route('forum.index',['page'=>2])}}" class="laypage-next">更多求解</a>
                </div>
                    @endif
            </div>
        </div>
    </div>
    <div class="edge">
        <h3 class="page-title">最近一月回答榜 - TOP 12</h3>
        <div class="user-looklog leifeng-rank">
            <span>
                 @foreach($hotreplyusers as $hotreplyuser)
                    <a href="{{route('user.home',['userID'=>$hotreplyuser->userID])}}"> <img src="{{\App\Service\Help::getImgSrc($hotreplyuser->profile_image)}}" /> <cite>{{$hotreplyuser->name}}</cite> <i>{{$hotreplyuser->replyNum}}次回答</i> </a>
                @endforeach
                 </span>
        </div>
        <h3 class="page-title">最近热帖</h3>
        <ol class="fly-list-one">
            @foreach($hotclicks as $hotclick)
                <li>
                    <a href="{{route('forum.detail',['aid'=>$hotclick->aid])}}">{{$hotclick->title}}</a>
                    <span><i class="iconfont"></i> {{$hotclick->clicknum}}</span>
                </li>
            @endforeach
        </ol>
        <h3 class="page-title">近期热议</h3>
        <ol class="fly-list-one">
            @foreach($hotreplys as $hotreply)
                <li>
                    <a href="{{route('forum.detail',['aid'=>$hotreply->articleID])}}">{{$hotreply->title}}</a>
                    <span><i class="iconfont"></i> {{$hotreply->replyNum}}</span>
                </li>
            @endforeach
        </ol>
        {{--<div class="fly-link">
            <span>友情链接：</span>
            <a href="http://layim.layui.com/" target="_blank">LayIM</a>
            <a href="http://layer.layui.com/" target="_blank">layer</a>
            <a href="http://www.ttlutuan.com" target="_blank">天天撸团</a>
            <a href="http://www.hotcn.top/" target="_blank">国际热点</a>
            <a href="http://www.bejson.com/" target="_blank">JSON在线工具</a>
            <a href="http://www.smeoa.com/" target="_blank">小微OA</a>
            <a href="http://www.pmsun.me/" target="_blank">PHP博客</a>
            <a href="http://www.hibug.cn/" target="_blank">在线Bug管理</a>
        </div>--}}
    </div>
</div>
    @include('layouts.foot')
    @include('layouts.jscode')
    <script>
        layui.config({
            version: "1.0.2"
            ,base: '../../res/mods/'
        }).extend({
            fly: 'index'
        }).use(['fly'],function(){
            $ = layui.jquery;
        });
    </script>
@endsection