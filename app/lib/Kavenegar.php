<?php

namespace App\lib;

class Kavenegar
{

    public static function sendSMS($mobile, $token, $template)
    {

        /*
         * Author: M.Fakhrani
         * Description : for send sms whit algorithm on kavenegar by API
         */
  //      $url = 'https://api.kavenegar.com/v1/392B6349396C2F6E56675056414C4C4B73764E37386863306D6272447A54396C4A3066414A766F7A6861303D/verify/lookup.json?receptor=' . $mobile . '&token=' . 'امروز' . '&template=absent';
    //    $ch = curl_init();
      //  curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 0);
  //      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //    $response = curl_exec($ch);
      //  curl_close($ch);
        //return $response;

    }

    public static function sendFinanceSMS($mobile)
    {

  //      $url = 'https://api.kavenegar.com/v1/392B6349396C2F6E56675056414C4C4B73764E37386863306D6272447A54396C4A3066414A766F7A6861303D/verify/lookup.json?receptor=' . $mobile . '&token=' . 'سه' . '&template=absent';

    //    $ch = curl_init();
      //  curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 0);
  //      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //    $response = curl_exec($ch);
      //  curl_close($ch);
        //return $response;

    }

    public static function sendCheque($mobile, $number, $price)
    {

  //      $url = 'https://api.kavenegar.com/v1/392B6349396C2F6E56675056414C4C4B73764E37386863306D6272447A54396C4A3066414A766F7A6861303D/verify/lookup.json?receptor=' . $mobile . '&token=' . $number . '&token2=' . $price . '&template=cheque';

//        $ch = curl_init();
  //      curl_setopt($ch, CURLOPT_URL, $url);
    //    curl_setopt($ch, CURLOPT_POST, 0);
      //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //$response = curl_exec($ch);
      //  curl_close($ch);
        //return $response;

    }

}

?>
