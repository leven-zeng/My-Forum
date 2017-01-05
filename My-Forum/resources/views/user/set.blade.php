@extends('layouts.head')

<?php $user=Auth::user()  ?>

@section('content')

    <div class="main layui-clear" style="min-height: 600px;">

  <h2 class="page-title">帐号设置</h2>

  <div class="fly-tab user-tab">
    <span id="LAY-mine">
      <a href="javascript:;" class="tab-this" hash="info">我的资料</a>
      <a href="javascript:;" hash="avatar">头像</a>
      <a href="javascript:;" hash="pass">密码</a>
      {{--<a href="javascript:;" hash="bind">帐号绑定</a>--}}
    </span>
  </div>
  
  <div class="user-mine">
    <div class="layui-form layui-form-pane mine-view" style="display: block;">
      <form method="post">
        {{ csrf_field() }}
        <div class="layui-form-item">
          <label for="L_email" class="layui-form-label">邮箱</label>
          <div class="layui-input-inline">
            <input type="text" id="L_email" name="email" required="" lay-verify="email" autocomplete="off" value="{{$user->email}}" class="layui-input">
          </div>
          <div class="layui-form-mid layui-word-aux">如果您在邮箱已激活的情况下，变更了邮箱，需<a href="activate.html" style="font-size: 12px; color: #4f99cf;">重新验证邮箱</a>。</div>
        </div>
        <div class="layui-form-item">
          <label for="L_username" class="layui-form-label">昵称</label>
          <div class="layui-input-inline">
            <input type="text" id="L_username" name="name" required="" lay-verify="required" autocomplete="off" value="{{$user->name}}" class="layui-input">
          </div>
          <div class="layui-inline">            
            <div class="layui-input-inline">              
              <input type="radio" name="gender" value="1" {{$user->gender=='1'?"checked='checked'":""}} title="男"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>男</span></div>
              <input type="radio" name="gender" value="0" {{$user->gender=='0'?"checked='checked'":""}} title="女"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
            </div>          
          </div>
        </div>
        <div class="layui-form-item">
          <label for="L_city" class="layui-form-label">城市</label>
          <div class="layui-input-inline">
            <input type="text" id="L_city" name="city" autocomplete="off"  value="{{$user->city}}" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item layui-form-text">
          <label for="L_sign" class="layui-form-label">签名</label>
          <div class="layui-input-block">
            <textarea placeholder="随便写些什么刷下存在感" id="L_sign" name="description" autocomplete="off" class="layui-textarea" style="height: 80px;">{{$user->description}}</textarea>
          </div>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn" key="set-mine" lay-filter="*" lay-submit="">确认修改</button>
        </div>
      </form></div>
      
      <div class="layui-form layui-form-pane mine-view" style="display: none;">
        <div class="layui-form-item">
          <div class="avatar-add">
            <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过30KB</p>
            {!! csrf_field() !!}
            <div class="upload-img">
              <div class="layui-box layui-upload-button"><form target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data" action="/user/upload/"><input type="file" name="file" id="LAY-file" lay-title="上传头像"></form><span class="layui-upload-icon"><i class="layui-icon"></i>上传头像</span></div>
            </div>
            <img src="{{\App\Service\Help::getImgSrc($user->profile_image)}}">
            <span class="loading"></span>
          </div>
        </div>
      </div>

      <div class="layui-form layui-form-pane mine-view" style="display: none;">
        {!! csrf_field() !!}
          <div class="layui-form-item">
            <label for="L_nowpass" class="layui-form-label">当前密码</label>
            <div class="layui-input-inline">
              <input type="password" id="L_nowpass" name="nowpass" required="" lay-verify="required" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">新密码</label>
            <div class="layui-input-inline">
              <input type="password" id="L_pass" name="pass" required="" lay-verify="required" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">6到16个字符</div>
          </div>
          <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">确认密码</label>
            <div class="layui-input-inline">
              <input type="password" id="L_repass" name="repass" required="" lay-verify="required" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <button class="layui-btn" key="set-mine" lay-filter="*" lay-submit="">确认修改</button>
          </div>
        
      </div>
      
      <div class="layui-form layui-form-pane mine-view" style="display: none;">
        <ul class="app-bind">
          <li class="fly-msg">
            <i class="iconfont icon-qq"></i>
            <span>已成功绑定，您可以使用QQ帐号直接登录Fly社区，当然，您也可以</span>
            <a href="javascript:;" class="acc-unbind" type="qq_id">解除绑定</a>

            <!-- <a href="" onclick="layer.msg('正在绑定微博QQ', {icon:16, shade: 0.1, time:0})" class="acc-bind" type="qq_id">立即绑定</a>
            <span>，即可使用QQ帐号登录Fly社区</span> -->
          </li>
          <li class="fly-msg">
            <i class="iconfont icon-weibo"></i>
            <!-- <span>已成功绑定，您可以使用微博直接登录Fly社区，当然，您也可以</span>
            <a href="javascript:;" class="acc-unbind" type="weibo_id">解除绑定</a> -->

            <a href="" class="acc-weibo" type="weibo_id" onclick="layer.msg('正在绑定微博', {icon:16, shade: 0.1, time:0})">立即绑定</a>
            <span>，即可使用微博帐号登录Fly社区</span>
          </li>
        </ul>
      </div>

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
