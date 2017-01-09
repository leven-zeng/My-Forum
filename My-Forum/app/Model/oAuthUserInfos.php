<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class oAuthUserInfos extends Model
{
    protected $primaryKey = 'ID';
    //
    protected $fillable = [
        'uid', 'token','location','description','gender','nickName','avatar','email','type','userID','refresh_token'
    ];
}
