<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    //
    public function test(){
    $res=Mail::raw('暗示法撒发送邮件',function($message){
            $message->subject('哈哈小子');
            $message->to('18320003455@163.com');
            $message->to('613767154@qq.com');
        });

        dd($res);
    }
}
