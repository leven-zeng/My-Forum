@extends('layouts.head')

@section('content')

    <div class="main layui-clear">
        <h2 class="page-title">登入</h2>
        <div class="layui-form layui-form-pane">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="layui-form-item has-error">
                    <label for="L_email" class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="email" id="L_email" name="email" required="" lay-verify="required" value="{{ old('email') }}" required autofocus autocomplete="off" class="layui-input">
                        @if ($errors->has('email'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="password" required="" lay-verify="required" autocomplete="off" class="layui-input" required>
                        @if ($errors->has('password'))
                            <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="layui-form-item">
                    <button type="submit" class="layui-btn">立即登录</button>
        <span style="padding-left:20px;">
          <a href="{{ url('/password/reset') }}">忘记密码？</a>
        </span>
                </div>
                <div class="layui-form-item fly-form-app">
                    <span>或者使用社交账号登入</span>
                    {{--<a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>--}}
                    <a href="{{route('auth.oauth')}}"   onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
                </div>
            </form>
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
