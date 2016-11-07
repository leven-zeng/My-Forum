<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test(){
        $test="123";
        dd(phpinfo());
        return view("test");
    }
}
