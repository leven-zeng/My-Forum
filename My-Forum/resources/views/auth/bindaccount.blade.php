<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2017/1/3
 * Time: 18:23
 */
?>

@extends('layouts.head')

@section('content')
    <div class="main layui-clear">
        <h2 class="page-title">您好，<span class="weight">{{$token['nickName']}}</span>，还未检测到您的账号，请填写以下信息进行绑定或注册！</h2>
        <div class="layui-form layui-form-pane">
            <form class="layui-form" role="form" method="POST" action="{{route('auth.postBind')}}">
                {!! csrf_field() !!}
                <div class="layui-form-item has-error">
                    <label for="L_email" class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="email" id="L_email" name="email" required="" lay-verify="required" value="" lay-verify="email" autofocus="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="password" required="" lay-verify="required" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn" lay-filter="*" lay-submit>确定</button>
                </div>
                <input type="hidden" name="token" value="{{$token['uid']}}">
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