<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $primaryKey = 'ID';
    //
    protected $fillable = [
        'userid', 'content','articleID','ID','forUserID'
    ];
}
