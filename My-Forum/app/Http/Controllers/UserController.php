<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;


class UserController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function set(){
        return view('user.set');
    }

    public function postset(Request $request){
        //dd(Input::all());
        $input=Input::all();
        $v = Validator::make($input, [
            'name'=>'required|min:3',
            'email'=>'required|email',
            'city'=>'required|max:20',
            'gender'=>'required'
        ],[],[
            'name'=>'昵称',
            'email'=>'邮箱',
            'city'=>'城市',
            'gender'=>'性别'
        ]);

        if ($v->fails())
        {
//            return response()->json(['status' => '500', 'msg' =>$v->errors()->first()]);
        return    $this->getJsonString('500',$v->errors()->first());
        }

/*        $this->validate($request, ['name'=>'required|min:3',
            'email'=>'required|email',
            'city'=>'required',
            'gender'=>'required']);*/



            $user=User::find(Auth::user()->id);
            $user->name=Input::get('name');
            $user->gender=Input::get('gender');
            $user->city=Input::get('city');
            $user->description=Input::get('description');

            if($user->email<>Input::get('email')){
                $user->email=Input::get('email');
                $user->isValiDataEmail=0;
            }


        if($user->save()){
//            return "success";
        return    $this->getJsonString('0','保存成功');
        }else{
//            return "error";
        return    $this->getJsonString('500',$v->errors()->first());
        }
    }
}
