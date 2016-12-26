@extends('layouts.head')

<?php $user=Auth::user()  ?>

@section('content')

    <div class="main layui-clear">

        <h2 class="page-title">用心中心</h2>

        <div class="wrap">
            <div class="content">

                <div class="fly-msg">
                    @if(Auth::user()->isValiDataEmail==0)
                        您的邮箱尚未验证，这比较影响您的帐号安全，<a href="/user/activate/">立即去激活？</a>
                    @endif
                </div>

                <div class="fly-tab user-tab">
        <span id="LAY-mine">
          <a href="javascript:;" class="tab-this" type="mine-jie">我的求解（<cite>0</cite>）</a>
          <a href="{{route('user.message')}}">我的消息</a>
          <a href="{{route('user.home',['userID'=>Auth::user()->id])}}">我的主页</a>
            {!! csrf_field() !!}
        </span>
                </div>
                <div class="user-mine">
                    <ul class="mine-view jie-row" style="display: block;">
                        {{--<li class="fly-none"><a>此处消息由Ajax读取，见mods/user.js</a></li>--}}
                    </ul>
                </div>
                <div id="LAY-page"></div>
            </div>
        </div>

        <div class="edge">
            <div class="user-about">
                <a href="{{url('user/set#avatar')}}" title="修改头像">
                    <img class="user-avatar" src="images/userimages/{{Auth::user()->profile_image}}">
                </a>
                <p>
                    <span style="color:#333">{{Auth::user()->name}}</span>
                    <span style="color:#c00;">超级管理员</span>
                    <!-- <span style="color:#5FB878;">管理员</span> -->
                </p>
                <p>
                    <span>加入时间：{{date('Y-m-d',strtotime( Auth::user()->created_at))}}</span>
                    {{--<span>
                      飞吻：<em style="color:#FF7200">5200</em>
                    </span>--}}
                </p>
                <p>
                    <span>城市：{{$user->city==''?'未知':$user->city}}</span>
                    <span>性别：
                        @if($user->gender==1)
                            <span>男</span>
                        @elseif($user->gender==2)
                            <span>女</span>
                        @else
                            <span>未知</span>
                        @endif</span>

                </p>

                <div class="user-looklog" style="padding-bottom:200px;">
                    <h3>最近访客</h3>
                    <span>
                        @foreach($lookusers as $lookuser)
                            <a href="{{route('user.home',['userID'=>$lookuser->id])}}">
                                <img src="{{\App\Service\Help::getImgSrc($lookuser->profile_image)}}">
                                <cite>{{$lookuser->name}}</cite>
                                <i>{{\App\Service\Help::getdiffForHumans($lookuser->updated_at)}}</i>
                            </a>
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.foot')
    <script src="../../res/layui/layui.js"></script>
    <script>
        layui.cache.page = 'user';
        layui.cache.user = {
            username: '{{$user->name}}}'
            ,uid: {{$user->id}}
            ,avatar: 'images/userimages/{{Auth::user()->profile_image}}'
            //,experience: 83
            ,sex: '{{$user->gender==1?"男":$user->gender==2?"女":"未知"}}'
        };
        layui.config({
            version: "1.0.0"
            ,base: '../../res/mods/'
        }).extend({
            fly: 'index'
        }).use('fly');
    </script>

@endsection