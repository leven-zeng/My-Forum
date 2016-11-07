<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="../res/layui/css/layui.css">
    <link rel="stylesheet" href="../res/css/global.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="header">
    <div class="main">
        <a class="logo" href="/" title="Fly">zlove社区</a>
        <div class="nav">
            <a class="nav-this" href="index.html">
                <i class="iconfont icon-wenda"></i>问答
            </a>
            <a href="http://www.layui.com/" target="_blank">
                <i class="iconfont icon-ui"></i>案例
            </a>
        </div>

        @if(Auth::guest())
        <div class="nav-user">
            <!-- 未登入状态 -->
            <a title="登入" class="unlogin" href="{{url('/login')}}"><i class="iconfont icon-touxiang"></i></a>
            <span><a href="{{url('/login')}}" title="登入">登入</a><a href="{{url('register')}}"  title="注册">注册</a></span>
            <p class="out-login">
                <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
                <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
            </p>

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
            <a class="avatar" href="../user/index.html">
                <img src="http://tp4.sinaimg.cn/1345566427/180/5730976522/0">
                <cite>贤心</cite>
                <i>VIP2</i>
            </a>
            <div class="nav">
                <a href="../user/set.html"><i class="iconfont icon-shezhi"></i>设置</a>
                <a href=""><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退了</a>
            </div>
        </div>
        @endif
    </div>
</div>
@yield('content')
<!-- Scripts -->

</body>
</html>
