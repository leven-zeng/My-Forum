@extends('layouts.head')

@section('content')
    <div class="main layui-clear">
        <h2 class="page-title">重置密码</h2>
        <div class="fly-msg">
            请重置您的密码
        </div>
        <div class="layui-form layui-form-pane" style="margin-top: 30px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
                {{--<div class="layui-form-item">--}}
                    {{--<label for="L_pass" class="layui-form-label">邮箱</label>--}}
                    {{--<div class="layui-input-inline">--}}

                        {{--<input id="email" type="email"  class="layui-input" name="email"  value="{{ $email or old('email') }}" required autofocus>--}}

                        {{--@if ($errors->has('email'))--}}
                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="layui-form-mid layui-word-aux">--}}
                        {{--6到16个字符--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        {{--<input type="password" id="L_pass" name="pass" required="" lay-verify="required" autocomplete="off" class="layui-input" />--}}
                        <input id="password" type="password"  name="password" class="layui-input" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">确认密码</label>
                    <div class="layui-input-inline">
                        {{--<input type="password" id="L_repass" name="repass" required="" lay-verify="required" autocomplete="off" class="layui-input" />--}}
                        <input id="password-confirm" type="password" name="password_confirmation" class="layui-input" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="layui-form-item">
                    <input type="hidden" name="username" value="字恋狂" />
                    <input type="hidden" name="email" value="1321101613@qq.com" />
                    <button class="layui-btn" alert="1" lay-filter="*" lay-submit="">提交</button>
                </div>
            </form>
        </div>
    </div>

{{--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}

    @include('layouts.foot')
@endsection
