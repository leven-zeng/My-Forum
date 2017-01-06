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


    //�󶨸��ֵ������˻�
    public function bind()
    {
        $email=Input::get('email');

        $password=Input::get('password');
        $user=User::where('email','=',$email)
            ->first();

        //������ʵ���صĲ�����uid��name��token
        $info=oAuthUserInfos::where('uid','=',Input::get('token'))->first();

        //�����ڴ�������û�������һ���µ��û�
        if($user==null)
        {
            $info->email=$email;
            $info->password=$password;
            $createuser=  $this->profileSave($info);

            $info->userID=$createuser->id;
            $info->update([]);
            Auth::login($createuser);
        }
        else//���ڴ��û���ֱ�ӽ��û�id���µ����н�������
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
            ,'msg'=>'�󶨳ɹ���'
            ,'url'=>route('user.index')
        ]);
        return  $jsonstr->getJsonString($jsonstr);
    }

    //����oAuth����
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

    //д���û�����
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