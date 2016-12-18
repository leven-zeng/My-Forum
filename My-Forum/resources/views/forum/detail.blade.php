<?php
/**
 * Created by PhpStorm.
 * User: Leven
 * Date: 2016/12/11
 * Time: 18:15
**/
$article=$article;


 ?>

@extends('layouts.head')

@section('content')
<div class="main layui-clear">
    <div class="wrap">
        <div class="content detail">
            <h1>{{$article->title}}</h1>
            <div class="fly-tip fly-detail-hint" data-id="">
                <span class="fly-tip-stick">置顶帖</span>
                <span class="fly-tip-jing">精帖</span>

                <span>未结贴</span>
                <!-- <span class="fly-tip-jie">已采纳</span> -->

                <!-- <span class="jie-admin" type="del" style="margin-left: 20px;">删除</span>
                <span class="jie-admin" type="set" field="stick" rank="1">置顶</span>
                <span class="jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span>
                <span class="jie-admin" type="set" field="status" rank="1">加精</span>
                <span class="jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->

                <div class="fly-list-hint">
                    <i class="iconfont" title="回答"></i> 517
                    <i class="iconfont" title="人气"></i> {{$article->clicknum}}
                </div>
            </div>
            <div class="detail-about">
                <a class="jie-user" href="">
                    <img src="{{$article->getprofile_image()}}" alt="">
                    <cite>
                        {{$article->name}}
                        <em>{{$article->getdiffForHumans()}}发布</em>
                    </cite>
                </a>
                <div class="detail-hits" data-id="">

                   @if($article->reward>0)
                    <span style="color:#FF7200">悬赏：{{$article->reward}}飞吻</span>
                    @endif
                    @if($article->isCurrUser())
                    <span class="jie-admin" type="edit"><a href="/jie/edit/">编辑此贴</a></span>
                       @endif
                </div>
            </div>

            <div class="detail-body photos" style="margin-bottom: 20px;">
                {!! $article->content !!}
            </div>

            <a name="comment"></a>
            <h2 class="page-title">热门回答<span>（<em id="jiedaCount">{{$comments->total()}}</em>）</span></h2>

            <ul class="jieda photos" id="jieda">
                @if($comments->count()<=0)
                    <li class="fly-none">没有任何回答</li>
                @endif
                {{--==============评论============================--}}

                @foreach($comments as $comment)
                <li data-id="" class="jieda-daan">
                    <a name="item-121212121212"></a>
                    <div class="detail-about detail-about-reply">
                        <a class="jie-user" href="">
                            <img src="/images/userimages/{{$comment->profile_image}}" alt="" layer-index="1">
                            <cite>
                                <i>{{$comment->name}}</i>
                                <!-- <em>(楼主)</em>
                                <em style="color:#5FB878">(管理员)</em>
                                <em style="color:#FF9E3F">（活雷锋）</em>
                                <em style="color:#999">（该号已被封）</em> -->
                            </cite>
                        </a>
                        <div class="detail-hits">
                            <span>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                        </div>
                        {{--<i class="iconfont icon-caina" title="最佳答案"></i>--}}
                    </div>
                    <div class="detail-body jieda-body">
                        <p>{!! $comment->content !!}</p>
                    </div>
                    <div class="jieda-reply">
                        <span class="jieda-zan " type="zan"><i class="iconfont icon-zan" onclick="addlike(this);" data-id="{{$comment->ID}}"></i><em>{{$comment->likeNum}}</em></span>
                        <span type="reply" class="reply-comment" onclick="reply(this)" data-username="{{$comment->name}}" data-userid="{{$comment->userID}}"><i class="iconfont icon-svgmoban53"></i>回复</span>
                        <!-- <div class="jieda-admin">
                          <span type="edit">编辑</span>
                          <span type="del">删除</span>
                          <span class="jieda-accept" type="accept">采纳</span>
                        </div> -->
                    </div>
                </li>
                @endforeach
                {{--==============评论============================--}}

                    <li data-id="" id="temp_li_comment" class="jieda-daan" style="display: none">
                        <a name="item-121212121212"></a>
                        <div class="detail-about detail-about-reply">
                            <a class="jie-user" href="">
                                <img src="" alt="" layer-index="1">
                                <cite>
                                    <i>名字</i>
                                </cite>
                            </a>
                            <div class="detail-hits">
                                <span>刚刚</span>
                            </div>
                        </div>
                        <div class="detail-body jieda-body">
                            <p>评论的内容</p>
                        </div>
                        <div class="jieda-reply">
                            <span class="jieda-zan " type="zan"><i class="iconfont icon-zan"></i><em>0</em></span>
                            {{--<span type="reply"><i class="iconfont icon-svgmoban53"></i>回复</span>--}}
                            <div class="jieda-admin">
                              <span type="edit">编辑</span>
                              <span type="del">删除</span>
                            </div>
                        </div>
                    </li>

            </ul>
            {!! $comments->appends(['aid'=>$article->aid])->render() !!}
            <div class="layui-form layui-form-pane">
                <form>
                    {!! csrf_field() !!}
                    <div class="layui-form-item layui-form-text">
                        <div class="layui-input-block">
                            {{--<textarea id="L_content" name="content" required="" lay-verify="required" placeholder="我要回答'" class="layui-textarea fly-editor" style="height: 150px;"></textarea>--}}
                            <textarea class="layui-textarea" id="LAY_demo1" style="display: none"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="hidden" name="jid" value="">

                    </div>
                    <input type="hidden" id="content" value="" name="content">
                    <input type="hidden" id="articleID" name="articleID" value="{{$article->aid}}">
                    <input type="hidden" id="replyuserID" name="replyuserID">
                </form>
                <button class="layui-btn" lay-filter="*" lay-submit="" onclick="return postcomment();">提交回答</button>
            </div>

        </div>
    </div>
    <div class="edge">

        <h3 class="page-title">最近热帖</h3>
        <ol class="fly-list-one">
            <li>
                <a href=" ">Layui 官网 在线演示页面 全面增加 查看代码 功能</a>
                <span><i class="iconfont"></i> 6087</span>
            </li>
        </ol>
        <h3 class="page-title">近期热议</h3>
        <ol class="fly-list-one">
            <li>
                <a href=" ">盛赞！大赞狂赞！Layui完美兼容Vue.js</a>
                <span><i class="iconfont"></i> 96</span>
            </li>
        </ol>

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

        //自定义工具栏
        index= layedit.build('LAY_demo1', {
         tool: ['face','image', 'link', 'unlink', 'left', 'center', 'right']
             ,uploadImage: {
                 url: '{{route('forum.upload')}}?_token='+$("input[name='_token']").val() //接口url
                 ,type: 'post' //默认post
             }
         ,height: 200
         })
    });

    function postcomment(){
        var content= layedit.getContent(index);

        layer.load();
        if(content.length<=0){
            layer.msg('不允许空的回复', {shift: 6});
            return false;
        }
        $('#content').val(content);

        var data=$('form').serialize();
        $.ajax({
            type: 'post',
            dataType:  'json',
            data: data,
            url: "{{route('forum.postcomment')}}",
            success: function(res){
                layer.closeAll('loading');
                if(res.status === "0") {
                    layedit.setContent(index,'');
                    layer.msg(res.msg, {shift: 6},function(){
                        var comment_li=$("#temp_li_comment").clone();
                        comment_li.find('.jieda-body p').html(content);
                        comment_li.attr('id','').css('display','block');
                        comment_li.find('.jie-user img').attr('src',$('.avatar img').attr('src'));
                        comment_li.find('cite i').text($('.avatar cite').text());
                        comment_li.find('.icon-zan').attr('data-id',res.title);
                        $('#jieda').append(comment_li);
                    });

                } else {
                    console.log(res);
                    layer.msg(res.msg, {shift: 6});
                }
            }, error: function(e){
                layer.closeAll('loading');
                layer.msg('请求异常，请重试', {shift: 6});
            }
        });
    }
    function addlike(t){

        var id= $(t).attr('data-id');
        var data={id:id};
        $.ajax({
            type: 'post',
            dataType:  'json',
            data: data,
            url: "{{route('forum.addlike')}}?_token="+$("input[name='_token']").val(),
            success: function(res){
                if(res.status === "0") {
                    $(t).parent().addClass('zanok');
                    $(t).attr('onclick','');
                    $(t).parent().find('em').html(parseInt($(t).parent().find('em').html())+1);
                } else {

                }
            }, error: function(e){

            }
        });
    }
    function reply(t){
        var name=$(t).attr('data-username');
        layedit.setContent(index,'<span><span>@'+name+'&nbsp;&nbsp;</span></span>');
        $('#replyuserID').val($(t).attr('data-userID'));
    }
</script>
    @endsection

