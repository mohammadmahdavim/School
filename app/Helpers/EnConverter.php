<?php

namespace App\Helpers;

class EnConverter
{


    public static $bn = array("۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹", "۰");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

    public static $st_ar = array("ي", "ك");
    public static $st_fa = array("ی", "ک");

    public static function ar2fa($word)
    {
        return str_replace(self::$st_ar, self::$st_fa, $word);
    }

    public static function fa2ar($word)
    {
        return str_replace(self::$st_fa, self::$st_ar, $word);
    }

    public static function bn2en($number)
    {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number)
    {
        return str_replace(self::$en, self::$bn, $number);
    }

    public static function convertNull($array)
    {
        foreach ($array as $key => $value) {
            if ($value == 'NULL') {
                $array[$key] = null;
            }
        }

        return $array;
    }

}

?>
