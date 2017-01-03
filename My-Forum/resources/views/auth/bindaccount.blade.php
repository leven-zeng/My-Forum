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
        <h2 class="page-title">���ã�{{$oauthUser->getNickname()}}����δ��⵽�����˺ţ�����д������Ϣ���а󶨻�ע�ᣡ</h2>
        <div class="layui-form layui-form-pane">
            <form class="form-horizontal" role="form" method="POST" action="">
                <input type="hidden" name="_token" value="ojwEVlROmdCBAzeuV28HO2cTlZMP6aiS2igRpXbm">
                <div class="layui-form-item has-error">
                    <label for="L_email" class="layui-form-label">����</label>
                    <div class="layui-input-inline">
                        <input type="email" id="L_email" name="email" required="" lay-verify="required" value="" autofocus="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">����</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="password" required="" lay-verify="required" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <button type="submit" class="layui-btn" lay-filter="*" lay-submit="">ȷ��</button>
                </div>
                <input type="hidden" name="uid" value="{{$oauthUser->getId()}}">
                <input type="hidden" name="nickName" value="{{$oauthUser->getNickname()}}">
                <input type="hidden" name="avatar" value="{{$oauthUser->getAvatar()}}">
                <input type="hidden" name="email" value="{{$oauthUser->getEmail()}}">
            </form>
        </div>
    </div>

    @include('layouts.foot')

    @endsection