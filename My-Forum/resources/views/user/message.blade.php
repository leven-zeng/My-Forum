<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2016/12/23
 * Time: 16:11
 */?>
@extends('layouts.head')
@section('content')

<div class="main layui-clear">
    <h2 class="page-title">
        我的消息{{--（由Ajax读取，见mods/user.js）--}}
        <button class="layui-btn layui-btn-small layui-hide" id="LAY_delallmsg" style="position: absolute; right: 0;">清空全部消息</button>
    </h2>
    <div id="LAY_minemsg"></div>
    {!! csrf_field() !!}
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