<?php
/**
 * Created by PhpStorm.
 * User: Leven
 * Date: 2016/12/24
 * Time: 15:41
 */
namespace App\Service;

class Help {
    //获取日期文字版
    public static function getdiffForHumans($dateTime)
    {
        return \Carbon\Carbon::parse($dateTime)->diffForHumans();
    }

    public static function getImgSrc($imgName){
        return '/images/userimages/'.$imgName;
    }

    public static function getTagNameByID($tagid){

        $tagname='';
        switch($tagid){
            case 1:
                $tagname= '案例分享';
                break;
            case 2:
                    $tagname= '经验闲谈';
                break;
            case 3:
                $tagname= '聊天指南';
                break;
            case 4:
                $tagname= '约会指南';
                break;
            case 5:
                $tagname= '形象指南';
                break;
        }

        return $tagname;
    }
}

?>