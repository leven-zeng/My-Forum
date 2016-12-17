<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JsonString extends Model
{
    private $status;
    private $msg;
    private $src;
    private $title;
    private $id;

    public function __construct(){
    }

//    public function __construct($status=0,$msg='',$src='',$title='',$id=0){
//        $this->status=$status;
//        $this->msg=$msg;
//        $this->src=$src;
//        $this->title=$title;
//        $this->id=$id;
//    }

    public function getJsonString(JsonString $jsonString){
        return response()->json(
            ['status'=>$jsonString->status,
            'msg'=>$jsonString->msg,
            'data'=>[
                'src'=>$jsonString->src,
                'title'=>$jsonString->title],
                'id'=>$jsonString->id
        ]);
    }

    public static function create(array $attributes = []){
        $json=new JsonString();
        $json->status=$attributes['status'];


        if(array_key_exists('msg',$attributes)){
            $json->msg=$attributes['msg'];
        }
        if(array_key_exists('src',$attributes)){
            $json->src=$attributes['src'];
        }
        if(array_key_exists('title',$attributes)){
            $json->title=$attributes['title'];
        }
        if(array_key_exists('id',$attributes)){
            $json->id=$attributes['id'];
        }

        return $json;
    }
}
