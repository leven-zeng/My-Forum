<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


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

    public function postset(){
        //dd(Input::all());
        $rules=array(
            name=>'required|min:3',
            email=>'required',
            city=>'required',
            gender=>'required'
        );

        $iputs=Input::all();
        $validator=Validator::make($iputs,$rules);

        if($validator->passes()){
            $user=User::find(Auth::user()->id);
            $user->name=Input::get('name');
            $user->gender=Input::get('gender');
            $user->city=Input::get('city');
            $user->description=Input::get('description');

            if($user->email<>Input::get('email')){
                $user->email=Input::get('email');
                $user->isValiDataEmail=0;
            }
        }

        if($user->save()){

        }else{

        }
    }
}
