<?php

namespace App\Http\Controllers\Auth;

use App\Model\oAuthUserInfos;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function weibo() {
        return  Socialite::with('weibo')->redirect();
        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }


    public function callback() {
       // $oauthUser = Socialite::with('weibo')->user();

//        var_dump($oauthUser->getId());
//        var_dump($oauthUser->getNickname());
//        var_dump($oauthUser->getName());
//        var_dump($oauthUser->getEmail());
//        var_dump($oauthUser->getAvatar());

       // $uid= $oauthUser->getId();
       //�ж��Ƿ���ڵ�ǰ������uid
        $uinfo=  oAuthUserInfos::where('uid','=',1)
            ->first();

        if($uinfo!=null)
        {
            //���Ҵ��û���ʹ��Ϊ��¼״̬
            $user=  User::find($uinfo->userID);
            Auth::login($user);

            $request=new Request();
            $target=$request->get('target');
            return redirect($target);
        }
            return redirect(route('user.bindAccount'));
    }
}
