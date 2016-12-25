@extends('layouts.head')

@section('content')
    <div class="main layui-clear">
        <h2 class="page-title">找回密码</h2>

        <div class="layui-form layui-form-pane">
            <form method="post">
                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="email" required="" lay-verify="required" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_vercode" class="layui-form-label">人类验证</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_vercode" name="vercode" required="" lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid">
                        <span style="color: #c00;"></span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn" alert="1" lay-filter="*" lay-submit="">提交</button>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.foot')
    @endsection
{{--@extends('layouts.app')--}}

{{--<!-- Main Content -->--}}
{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Reset Password</div>--}}
                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Send Password Reset Link--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
