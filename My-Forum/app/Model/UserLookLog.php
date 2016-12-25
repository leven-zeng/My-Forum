<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLookLog extends Model
{
    protected $primaryKey = 'ID';
//
    protected $fillable = [
        'lookUserID', 'lookForUserID'
    ];
}
