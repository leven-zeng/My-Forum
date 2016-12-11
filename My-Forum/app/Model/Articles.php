<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Articles extends Model
{
    //
    public function getprofile_image()
    {
        if($this->profile_image<>null) {
            return '/images/userimages/'.$this->profile_image;
        }else{
            return '';
        }
    }

    public function getdiffForHumans()
    {
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

    public function isCurrUser()
    {
        $user=Auth::user();
        if($this->userid==$user->id)
        {
            return true;
        }
        return false;
    }
}
