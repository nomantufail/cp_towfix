<?php
/**
 * Created by PhpStorm.
 * user: JR Tech
 * Date: 4/14/2016
 * Time: 12:27 PM
 */

namespace App\Libs\Helpers;


use Carbon\Carbon;

class Helper
{
    public static function propertyToArray(array $objects, $property)
    {
        $array = [];
        foreach($objects as $object)
        {
            $array[] = $object->$property;
        }
        return $array;
    }
    public static function rands($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function towfixDateFormat($date)
    {
        $date = explode(' ',$date)[0];
        $months = config('constants.MONTHS');
        $day_symbol = config('constants.DAY_SYMBOL');
        $dateArray = explode('-', $date);
        $formattedDate = $dateArray[2]."<sup>".$day_symbol[$dateArray[2]]."</sup> ".ucfirst($months[$dateArray[1]-1])." ".$dateArray[0];
        return $formattedDate;
    }
}