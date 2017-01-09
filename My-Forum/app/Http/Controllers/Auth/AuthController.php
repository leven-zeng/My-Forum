<?php

namespace App\Http\Controllers\Auth;

use App\Model\JsonString;
use App\Model\oAuthUserInfos;
use App\Service\oAuth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use oAuth;

    protected $oauthDrivers=['weibo'=>'weibo','qq'=>'qq'];

    public function oauth($driver) {
        return Socialite::with($driver)->redirect();
        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }



    public function callback($driver) {
        $oauthUser = Socialite::with($this->oauthDrivers[$driver])->user();
//        var_dump($oauthUser->getId());
//        var_dump($oauthUser->getNickname());
//        var_dump($oauthUser->getName());
//        var_dump($oauthUser->getEmail());
//        var_dump($oauthUser->getAvatar());

       //判断是否存在当前第三方uid
        $oinfo=  oAuthUserInfos::where('uid','=',$oauthUser->getId())
            ->first();

        if($oinfo!=null)
        {
            if($oinfo->userID>0)
            {
                //查找此用户，使其为登录状态
                $user=  User::find($oinfo->userID);
                Auth::login($user);
                return Redirect::route('user.index');
            }

            //存在时，更新access_token信息
            $this->oAuthUpdate($oinfo,$oauthUser,$driver);
        }
        else
        {
            //保存oAuth信息
            $this->oAuthSave($oauthUser,$this->oauthDrivers[$driver]);
        }
        $array=[];
        array_set($array,'uid',$oauthUser->getId());
        array_set($array,'nickName',$oauthUser->getNickname());
        return Redirect::route('auth.bindAccount', array('token' => $array));
    }

    //第三方登录进行绑定（微博）
    public function bindAccount(Request $request)
    {
        return view('auth.bindaccount',['token'=>$request->get('token')]);
    }

    //提交绑定
    public function postBind()
    {
        $input=Input::all();
        $v=Validator::make($input,[
            'email'=>'required|email',
            'password'=>'required|min:6|max:16'
            ,'token'=>'required'
        ],[],[
            'email'=>'邮箱',
            'password'=>'密码'
        ]);
        if($v->fails())
        {
            $jsonstr= JsonString::create([
                'status'=>500
                ,'msg'=>$v->errors()->first()
            ]);
            return  $jsonstr->getJsonString($jsonstr);
        }

     return   $this->bind();
    }
}
