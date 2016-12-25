
@extends('layouts.head',['title'=>$user->name.'的炫酷主页_追爱吧'])
<style>
    body{
        margin-top: 65px !important;
    }
</style>
@section('content')
    <div class="fly-home" style="background-image: url();">
        <img src="/images/userimages/{{$user->profile_image}}" alt="{{$user->name}}" />
        <h1> {{$user->name}} <i class="iconfont         "></i> </h1>
        <p class="fly-home-info"> <i class="iconfont icon-zuichun" title="飞吻"></i><span style="color: #FF7200;">95飞吻</span> <i class="iconfont icon-shijian"></i><span>{{date('Y-m-d',strtotime($user->created_at))}} 加入</span> <i class="iconfont icon-chengshi"></i><span>{{$user->city==''?'未知城市':'来自'.$user->city}}</span> </p>
        <p class="fly-home-sign">{{$user->description==''?"（这个人懒得留下签名）":'('.$user->description.')'}}</p>
    </div>
    <div class="main fly-home-main">
        <div class="layui-inline fly-home-jie">
            <h2 class="page-title">{{$user->name}} 最近的提问</h2>
            <ul class="jie-row">

                @if($articles->count()<=0)
                    <li class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></li>
                    @else
                @foreach($articles as $article)
                <li> <a href="{{route('forum.detail',['aid'=>$article->aid])}}" class="jie-title">{{$article->title}}</a> <i>{{ \App\Service\Help::getdiffForHumans($article->created_at)}}</i> <em>{{$article->clicknum}}阅/{{$article->comment_count}}答</em> </li>

                    @endforeach
                    @endif
            </ul>
        </div>
        <div class="layui-inline fly-home-da">
            <h2 class="page-title">{{$user->name}} 最近的回答</h2>
            <ul class="home-jieda">

                @if($comments->count()<=0)
                    <li class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何回答</i></li>
                @else
                    @foreach($comments as $comment)
                        <li> <p> <span>{{\App\Service\Help::getdiffForHumans($comment->created_at)}}</span> 在<a href="{{route('forum.detail',['aid'=>$comment->aid]).'#dataid-'.$comment->ID}}" target="_blank">{{$comment->title}}</a>中回答： </p>
                            <div class="home-dacontent">
                                <p data-id="{{$comment->forUserID}}">
                                    {!! $comment->content !!}</p>
                            </div> </li>
                    @endforeach
                @endif

            </ul>
        </div>
    </div>

    @include('layouts.foot')
    <script src="../../res/layui/layui.js"></script>
    <script>
        layui.cache.page = 'user';
        layui.cache.user = {
            username: '游客'
            ,uid: -1
            ,avatar: '../../res/images/avatar/00.jpg'
            ,experience: 83
            ,sex: '男'
        };
        layui.config({
            version: "1.0.0"
            ,base: '../../res/mods/'
        }).extend({
            fly: 'index'
        }).use('fly');
    </script>

@endsection
