<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="z-love.com专业的追女生指导交流社区，集聊天指南、穿衣指南、形象指南、案例分享、经验闲谈与一体，给想要或者正在追求女神、男神的你最好的攻略！" />
    <meta name="Keywords" content="网上社区,交流,追女生,追女神,追男神,追男生,聊天指南,穿衣指南,形象指南,案例分享,经验闲谈,攻略,泡妞攻略" />
    <meta name="baidu-site-verification" content="xsXMNjV70Q" />
    <link rel="shortcut icon" type="image/x-icon" href="http://www.z-love.com/images/favicon.ico" media="screen" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or config('app.name', '追爱吧')  }}</title>
    <!-- Styles -->
    {{--<link href="/css/app.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="/res/layui/css/layui.css">
    <link rel="stylesheet" href="/res/css/global.css">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?6612603b80d49e0c5e49d2488d688651";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <meta property="wb:webmaster" content="af85052732a074c2" />
</head>
<body>
<div class="header">
    <div class="main">
        <a class="logo" href="/" title="Fly">zlove社区</a>
        <div class="nav">
            <a class="nav-this" href="{{route('forum.index')}}">
                <i class="iconfont icon-wenda"></i>问答
            </a>
            {{--<a href="http://www.layui.com/" target="_blank">
                <i class="iconfont icon-ui"></i>案例
            </a>--}}
        </div>

        @if(Auth::guest())
        <div class="nav-user">
            <!-- 未登入状态 -->
            <a title="登入" class="unlogin" href="{{url('/login')}}"><i class="iconfont icon-touxiang"></i></a>
            <span><a href="{{url('/login')}}" title="登入">登入</a><a href="{{url('register')}}"  title="注册">注册</a></span>
            {{--<p class="out-login">
                <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
                <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
            </p>--}}

            <!-- 登入后的状态 -->
            <!--
            <a class="avatar" href="user/index.html">
              <img src="http://tp4.sinaimg.cn/1345566427/180/5730976522/0">
              <cite>贤心</cite>
              <i>VIP2</i>
            </a>
            <div class="nav">
              <a href="/user/set/"><i class="iconfont icon-shezhi"></i>设置</a>
              <a href="/user/logout/"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退了</a>
            </div> -->

        </div>
        @else<div class="nav-user">
            <!-- 登入后的状态 -->
            <a class="avatar" href="{{route('user.index')}}">
                <img src="{{\App\Service\Help::getImgSrc(Auth::user()->profile_image)}}">
                <cite>{{\Illuminate\Support\Facades\Auth::user()->name}}</cite>
                <i>{{""}}</i>{{--这里输出加粗字体--}}
            </a>
            <div class="nav">
                <a href="{{route('user.set')}}"><i class="iconfont icon-shezhi"></i>设置</a>
                <a href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退了</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@yield('content')

</body>
</html>
