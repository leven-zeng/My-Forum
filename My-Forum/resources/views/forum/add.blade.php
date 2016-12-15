<?php
/**
 * Created by PhpStorm.
 * User: Leven
 * Date: 2016/12/11
 * Time: 20:52
 */

        ?>

@extends('layouts.head')

@section('content')
    <div class="main layui-clear">
        <h2 class="page-title">发表问题</h2>

        <!-- <div class="fly-none">并无权限</div> -->

        <div class="layui-form layui-form-pane">
            <form action="{{route('forum.add')}}" method="post">
                {!! csrf_field() !!}
            <div class="layui-form-item">
                <label for="L_title" class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" id="L_title" name="title" required="" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <input type="hidden" name="content" id="content">
                    <textarea class="layui-textarea" id="LAY_demo1" style="display: none"></textarea>
                </div>
                <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">所在类别</label>
                    <div class="layui-input-block">
                        <select lay-verify="required" name="tagid">
                            <option></option>
                            <option value="1">layui框架综合</option>
                            <option value="2">layui.mobile模块</option>
                            <option value="3">layer弹出层</option>
                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><ul class="layui-anim layui-anim-upbit"><li lay-value="1">layui框架综合</li><li lay-value="2">layui.mobile模块</li><li lay-value="3">layer弹出层</li></ul></div>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">悬赏飞吻</label>
                    <div class="layui-input-block">
                        <select name="reward">
                            <option value="5" selected="">5</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="5" value="5" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><ul class="layui-anim layui-anim-upbit"><li lay-value="5" class="layui-this">5</li><li lay-value="20">20</li><li lay-value="50">50</li><li lay-value="100">100</li></ul></div>
                    </div>
                </div>
            </div>
            {{--<div class="layui-form-item">
                <label for="L_vercode" class="layui-form-label">人类验证</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_vercode" name="vercode" required="" lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">
                    <span style="color: #c00;">1+1=?</span>
                </div>
            </div>--}}

            <div class="layui-form-item">

            </div>
            </form>
            <button class="layui-btn" lay-filter="*" lay-submit="" onclick="return getcontent()">立即发布</button>
        </div>
    </div>

    @include('layouts.foot')
    <script src="../../res/layui/layui.js"></script>
    <script>
        var layedit;
        var index;
        layui.use('layedit', function(){
            layedit = layui.layedit
                    ,$ = layui.jquery;

            //构建一个默认的编辑器
             index = layedit.build('LAY_demo1',{
                uploadImage: {
                    url: '{{route('forum.upload')}}?_token='+$("input[name='_token']").val() //接口url
                    ,type: 'post' //默认post
                }
            });


            //编辑器外部操作
            var active = {
                content: function(){
                    alert(layedit.getContent(index)); //获取编辑器内容
                }
                ,text: function(){
                    alert(layedit.getText(index)); //获取编辑器纯文本内容
                }
                ,selection: function(){
                    alert(layedit.getSelection(index));
                }
            };

//            $('.site-demo-layedit').on('click', function(){
//                var type = $(this).data('type');
//                active[type] ? active[type].call(this) : '';
//            });

            /*//自定义工具栏
            layedit.build('LAY_demo2', {
                tool: ['face', 'link', 'unlink', '|', 'left', 'center', 'right']
                ,height: 100
            })*/
        });

        function getcontent(){

            layer.load();
            var content= layedit.getContent(index);
            $('#content').val(content);

            var data=$('form').serialize();
            $.ajax({
                type: 'post',
                dataType:  'json',
                data: data,
                url: "{{route('forum.add')}}",
                success: function(res){
                    layer.closeAll('loading');
                    if(res.status === "0") {
                        layer.msg(res.msg, {shift: 6},function(){
                            window.location="{{route('forum.detail')}}?aid="+res.data.title;
                        });

                    } else {
                        console.log(res);
                        layer.msg(res.msg, {shift: 6});
                    }
                }, error: function(e){
                    layer.closeAll('loading');
                    options.error || layer.msg('请求异常，请重试', {shift: 6});
                }
            });
        }
    </script>
    @endsection


