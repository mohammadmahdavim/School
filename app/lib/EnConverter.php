<?php

namespace App\lib;

class EnConverter
{



    public static $bn = array("۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹", "۰");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }


}

?>