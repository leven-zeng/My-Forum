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
          <a href="message.html">我的消息</a>
          <a href="home.html">我的主页</a>
        </span>
                </div>
                <div class="user-mine">
                    <ul class="mine-view jie-row" style="display: block;">
                        <li class="fly-none"><a>此处消息由Ajax读取，见mods/user.js</a></li>
                    </ul>
                </div>
                <div id="LAY-page"></div>
            </div>
        </div>

        <div class="edge">
            <div class="user-about">
                <a href="set.html#avatar" title="修改头像">
                    <img class="user-avatar" src="images/{{Auth::user()->profile_image}}">
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
                    <span>城市：未知</span>
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
          <a href="/u/168">
              <img src="http://fly.layui.com/avatar/168.jpg">
              <cite>贤心</cite>
              <i>刚刚</i>
          </a>
          <a href="/u/336">
              <img src="http://res.layui.com/images/fly/avatar/00.jpg">
              <cite>Fly官方</cite>
              <i>5分钟前</i>
          </a>
          <a href="/u/26880">
              <img src="http://res.layui.com/images/fly/avatar/5.jpg">
              <cite>小付</cite>
              <i>1小时前</i>
          </a>
          <a href="/u/11928">
              <img src="http://fly.layui.com/avatar/11928.jpg">
              <cite>第一把菜刀</cite>
              <i>3天前</i>
          </a>
        </span>
                </div>
            </div>
        </div>
    </div>

@include('layouts.foot')
@endsection
