<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Model\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{

    public function test(Request $request){
        dd($request->url());

    $res=Mail::raw('这是来自火星的邮件'.date('y-M-d h:m:s'),function($message){
            $message->subject('哈哈小子');
            $message->to('m18707022909@163.com');
            $message->to('1321101613@qq.com');
        });


        //$article= Articles::find(1);

        //Mail::to('1321101613@qq.com')->send(new OrderShipped($article));

//        Mail::queue('emails.test',  ['article' => $article], function ($message) {
//            $message->subject('这是一封测试邮件');
//            $message->to('m18707022909@163.com');
//            $message->to('1321101613@qq.com');
//        });
    }
}
