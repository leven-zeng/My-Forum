<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2017/1/6
 * Time: 14:30
 */
namespace App\Service;


use App\Model\oAuthUserInfos;
use App\User;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;

trait oAuth{


    //绑定各种第三方账户
    public function bind()
    {
        $email=Input::get('email');

        $password=Input::get('password');
        $user=User::where('email','=',$email)
            ->first();

        //这里其实返回的参数是uid，name是token
        $info=oAuthUserInfos::where('uid','=',Input::get('token'))->first();

        //不存在此邮箱的用户，创建一个新的用户
        if($user==null)
        {
            $info->email=$email;
            $info->password=$password;
            $createuser=  $this->profileSave($info);

            $info->userID=$createuser->id;
            $info->update([]);
            Auth::login($createuser);
        }
        else//存在此用户，直接将用户id更新到表中建立关联
        {
            //$info->userID=$user->id;
            oAuthUserInfos::where('token','=',Input::get('token'))->update(['userID'=>$user->id]);
            Auth::login($user);

            $user->password=bcrypt($password);
            $user->save();
        }
        //$info->save();
        $jsonstr= JsonString::create([
            'status'=>7
            ,'msg'=>'绑定成功！'
            ,'url'=>route('user.index')
        ]);
        return  $jsonstr->getJsonString($jsonstr);
    }

    //保存oAuth数据
    public function oAuthSave($oauthUser,$driver)
    {
        $oAuth=new oAuthUserInfos();
        switch($driver)
        {
            case 'weibo':
                $oAuth->token=$oauthUser->token;
                $oAuth->location=$oauthUser->user['location'];
                $oAuth->description=$oauthUser->user['description'];
                $oAuth->gender=$oauthUser->user['gender'];
                $oAuth->expires_in=$oauthUser->expiresIn;
                break;
        }

        $oAuth->uid=$oauthUser->getId();
        $oAuth->nickName=$oauthUser->getNickname();
        $oAuth->avatar=$oauthUser->getAvatar();
        $oAuth->email=$oauthUser->getEmail();
        $oAuth->type=$driver;
        $oAuth->save();
    }

    //写入用户数据
    public function profileSave($info)
    {
        $createuser=User::create([
            'name'=>$info->nickName
            , 'gender'=>$info->gender=='m'?'1':'0'
            ,'email'=>$info->email
            ,'city'=>$info->location
            ,'password'=>bcrypt($info->password)
            ,'register_from'=>'sina'
            ,'profile_image'=>$info->avatar
            ,'description'=>$info->description
        ]);

        return $createuser;
    }
}