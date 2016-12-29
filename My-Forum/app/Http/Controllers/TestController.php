<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    //
    public function test(){
    $res=Mail::raw('这是来自火星的邮件'.date('y-M-d h:m:s'),function($message){
            $message->subject('哈哈小子');
            $message->to('m18707022909@163.com');
            $message->to('1321101613@qq.com');
        });

        dd($res);
    }
}
