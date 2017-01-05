<?php
/**
 * Created by PhpStorm.
 * User: Leven
 * Date: 2016/12/11
 * Time: 18:15
**/
$article=$article;


 ?>

@extends('layouts.head',['title'=>$article->title.'_追爱吧'])

@section('content')
<div class="main layui-clear">
    <div class="wrap">
        <div class="content detail">
            <h1>{{$article->title}}</h1>
            <div class="fly-tip fly-detail-hint" data-id="">

                @if($article->topNum>0)
                    <span class="fly-tip-stick">置顶帖</span>
                @endif
                @if($article->isgood==1)
                        <span class="fly-tip-jing">精帖</span>
                @endif
                    @if($article->status==0)
                        <span>未结贴</span>
                    @elseif($article->status==1)
                        <span class="fly-tip-jie">已采纳</span>
                        @endif

                <!-- <span class="jie-admin" type="del" style="margin-left: 20px;">删除</span>
                <span class="jie-admin" type="set" field="stick" rank="1">置顶</span>
                <span class="jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span>
                <span class="jie-admin" type="set" field="status" rank="1">加精</span>
                <span class="jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->

                <div class="fly-list-hint">
                    <i class="iconfont" title="回答"></i> {{$comments->total()}}
                    <i class="iconfont" title="人气"></i> {{$article->clicknum}}
                </div>
            </div>
            <div class="detail-about">
                <a class="jie-user" href="{{route('user.home',['userID'=>$article->userid])}}">
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
                    @if($article->isCurrUser() && $article->status==0)
                    <span class="jie-admin" type="edit"><a href="{{route('forum.edit',['aid'=>$article->aid])}}">编辑此贴</a></span>
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
                <li data-id="{{$comment->ID}}" class="jieda-daan">
                    <a name="dataid-{{$comment->ID}}"></a>
                    <div class="detail-about detail-about-reply">
                        <a class="jie-user" href="{{route('user.home',['userID'=>$comment->userID])}}">
                            <img src="{{\App\Service\Help::getImgSrc($comment->profile_image)}}" alt="" layer-index="1">
                            <cite>
                                <i>{{$comment->name}}</i>
                                @if($comment->userID==$article->userid)
                                <em>(楼主)</em>
                                @endif
                                        <!--
                                <em style="color:#5FB878">(管理员)</em>
                                <em style="color:#FF9E3F">（活雷锋）</em>
                                <em style="color:#999">（该号已被封）</em> -->
                            </cite>
                        </a>
                        <div class="detail-hits">
                            <span>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                        </div>
                        @if($comment->isaccept==1)
                        <i class="iconfont icon-caina" title="最佳答案"></i>
                            @endif
                    </div>
                    <div class="detail-body jieda-body">
                        <p data-id="{{$comment->replyuserID}}">
                            {!! $comment->content !!}</p>
                    </div>
                    <div class="jieda-reply">
                        <span class="jieda-zan " type="zan"><i class="iconfont icon-zan" onclick="addlike(this);" data-id="{{$comment->ID}}"></i><em>{{$comment->likeNum}}</em></span>
                        <span type="reply" class="reply-comment" onclick="reply(this)" data-username="{{$comment->name}}" data-userid="{{$comment->userID}}"><i class="iconfont icon-svgmoban53"></i>回复</span>
                        <!-- <div class="jieda-admin">
                          <span type="edit">编辑</span>
                          <span type="del">删除</span>
                          <span class="jieda-accept" type="accept">采纳</span>
                        </div> -->
                     <div class="jieda-admin">
                         @if($article->isCurrUser() && $article->status==0 && $comment->userID!=$article->userid)
                             <span class="jieda-accept" type="accept">采纳</span>
                         @endif

                        </div>
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
                              {{--<span type="edit">编辑</span>--}}
                              {{--<span type="del">删除</span>--}}
                            </div>
                        </div>
                    </li>

            </ul>
            {!! $comments->appends(['aid'=>$article->aid])->render() !!}
            {{--<div class="layui-form layui-form-pane"  id="replyform">
                <form>
                    {!! csrf_field() !!}
                    <div class="layui-form-item layui-form-text">
                        <div class="layui-input-block">
                            --}}{{--<textarea id="L_content" name="content" required="" lay-verify="required" placeholder="我要回答'" class="layui-textarea fly-editor" style="height: 150px;"></textarea>--}}{{--
                            --}}{{--<textarea class="layui-textarea" id="LAY_demo1" ></textarea>--}}{{--
                            <div class="layui-form-item layui-form-text">
                                <div class="layui-input-block">
                                    <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
                                </div>
                                <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
                            </div>
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
            </div>--}}

            <div class="layui-form layui-form-pane">
                <form {{--action="{{route('forum.postcomment')}}" method="post"--}}>
                    {!! csrf_field() !!}
                    <div class="layui-form-item layui-form-text">
                        <div class="layui-input-block">
                            <textarea id="L_content" {{--name="content"--}} required lay-verify="required" placeholder="我要回答'"  class="layui-textarea fly-editor" style="height: 150px;"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="hidden" id="content" value="" name="content">
                        <input type="hidden" id="articleID" name="articleID" value="{{$article->aid}}">
                        <input type="hidden" id="replyuserID" name="replyuserID" value="0">

                    </div>
                </form>
                <button class="layui-btn" lay-filter="r" onclick="return postcomment()">提交回答</button>
            </div>

        </div>
    </div>
    <div class="edge">

        <h3 class="page-title">最近热帖</h3>
        <ol class="fly-list-one">
            @foreach($hotclicks as $hotclick)
            <li>
                <a href="{{route('forum.detail',['aid'=>$hotclick->aid])}}">{{$hotclick->title}}</a>
                <span><i class="iconfont"></i> {{$hotclick->clicknum}}</span>
            </li>
                @endforeach
        </ol>
        <h3 class="page-title">近期热议</h3>
        <ol class="fly-list-one">
            @foreach($hotreplys as $hotreply)
                <li>
                    <a href="{{route('forum.detail',['aid'=>$hotreply->articleID])}}">{{$hotreply->title}}</a>
                    <span><i class="iconfont"></i> {{$hotreply->replyNum}}</span>
                </li>
                @endforeach
        </ol>

    </div>
</div>
    @include('layouts.foot')
@include('layouts.jscode')

<script>
    var $;
    layui.config({
        version: "1.0.2"
        ,base: '../../res/mods/'
    }).extend({
        fly: 'index'
    }).use(['fly','jie'],function(){
        $ = layui.jquery;
    });

    /*var layedit;
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
    });*/

    function postcomment(){
        var content= layui.fly.content($("#L_content").val());
        //var $jqcontent =$(content);
        if(! content.indexOf('fly-aite')>0) {
           // $('#replyuserID').val( jqcontent.find('#hiddenusername').attr('data-userid'));
            //content=   content.replace($jqcontent.find('.fly-aite')[0],'');
           // var s=$jqcontent.find('.fly-aite').get(0);
            $('#replyuserID').val(0);
        }

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
                    //layedit.setContent(index,'');
                    layer.msg(res.msg, {shift: 6},function(){
                        var comment_li=$("#temp_li_comment").clone();
                        comment_li.find('.jieda-body p').html(content);
                        comment_li.attr('id','').css('display','block');
                        comment_li.find('.jie-user img').attr('src',$('.avatar img').attr('src'));
                        comment_li.find('cite i').text($('.avatar cite').text());
                        comment_li.find('.icon-zan').attr('data-id',res.title);
                        $('#jieda').append(comment_li);
                        $("#L_content").val('')
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
        $('html, body').animate({
            scrollTop: $("#L_content").offset().top-300
        }, 1000);

        var name=$(t).attr('data-username');
        var userid=$(t).attr('data-userID');
//        layedit.setContent(index,'<span><input type="button" data-userid="'+userid+'" style="border: none;background-color: transparent;" id="hiddenusername" value="@'+name+'&nbsp;&nbsp;" ></span>');
//        layedit.setContent(index,'');
        $('#replyuserID').val(userid);

    }
</script>
    @endsection

