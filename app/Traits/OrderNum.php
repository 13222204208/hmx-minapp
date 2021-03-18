<?php

namespace App\Traits;

trait OrderNum
{
    /**
     * @param $num
     * @param $title
     */
    public static function createOrderNum($num, $title)
    {
        $num = $num+1;
        $number= sprintf ( "%02d",$num);//不足两位带前导0

        $orderNum= $title.date("YmdHis",time()).$number;
        return $orderNum;
    }

}
