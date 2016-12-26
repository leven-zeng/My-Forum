
@extends('layouts.head')
@section('content')
    <div class="main layui-clear">
        <h2 class="page-title">找回密码</h2>

        <div class="layui-form layui-form-pane">

            @if (session('status'))
                <div class="alert alert-success">
                {{ session('status') }}
                </div>
            @endif
            <form method="post" action="{{ url('/password/email') }}" >
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="email" required="" lay-verify="required" autocomplete="off" class="layui-input">

                        @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn" alert="1" lay-filter="*" type="submit" lay-submit="">提交</button>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.foot')
@endsection