<?php
/**
 * Created by PhpStorm.
 * User: Leven
 * Date: 2016/12/24
 * Time: 15:41
 */
namespace App\Service;

class Help {
    //��ȡ�������ְ�
    public static function getdiffForHumans($dateTime)
    {
        return \Carbon\Carbon::parse($dateTime)->diffForHumans();
    }

    public static function getImgSrc($imgName){
        return '/images/userimages/'.$imgName;
    }
}

?>