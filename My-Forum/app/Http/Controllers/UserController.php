<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $input=Input::all();
        if($request->has('name'))
        {
            return $this->updateUserInfo($input);
        }
        if($request->has('nowpass'))
        {
            return $this->updataUserPassWord($input);
        }
    }

    public function upload(Request $request)
    {

        if($request->hasFile('file'))
        {
            $images=$request->file('file'); //使用laravel 自带的request类来获取一下文件.
            $imgsize=    $images->getClientSize();
            if($imgsize>150*1024)
            {
                return response()->json(['code'=>'500','msg'=>'图片不能大于150KB','data'=>'','title'=>'']);
            }
            $extension=$images->getClientOriginalExtension();//获取扩展名
            $newImageName=md5(time().random_int(5,5)).'.'.$extension;
            $images->move('images/userimages/',$newImageName);
            Auth::user()->profile_image=$newImageName;
            if(Auth::user()->save())
            {
                return $this->getJsonString('0','头像上传完成','/images/userimages/'.$newImageName,$newImageName);
            }
        }
        return $this->getJsonString('500','头像不知道为什么丢了，再试一次吧','images/userimages/','');
    }


    //===============以下是逻辑代码======================
    public function updateUserInfo($input)
    {
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
            return    $this->getJsonString('500',$v->errors()->first(),'','');
        }

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
            return    $this->getJsonString('0','保存成功','','');
        }else{
            return    $this->getJsonString('500',$v->errors()->first(),'','');
        }
    }

    public function updataUserPassWord($input)
    {
        $v=Validator::make($input,[
            'nowpass'=>'required|min:6|max:16',
            'pass'=>'required|min:6|max:16',
            'repass'=>'required|min:6|max:16'
        ],[],[
            'nowpass'=>'当前密码',
            'pass'=>'新密码',
            'repass'=>'确认密码'
        ]);

        if($v->fails())
        {
            return $this->getJsonString('500',$v->errors()->first(),'','');
        }

        if(Input::get('pass')<>Input::get('repass'))
        {
            return $this->getJsonString('500','新密码必须一致','','');
        }
        $user=Auth::user();
        $nowPass=Input::get('nowpass');
        $newPass=Input::get('pass');
        if(!Hash::check($nowPass,$user->password))
        {
            return $this->getJsonString('500','当前密码错误','','');
        }
        $user->password=bcrypt($newPass);
        if($user->save())
        {
            return $this->getJsonString('0','密码已更新','','');
        }else
        {
            return $this->getJsonString('6','更新未完成','','');
        }
    }
}
