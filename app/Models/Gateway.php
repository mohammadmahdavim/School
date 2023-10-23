<?php

namespace App\Models;

use App\Exceptions\MellatException;
use App\Exceptions\ParsianResult;
use App\Exceptions\SadadException;
use App\Exceptions\ZarinpalException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use DateTime;

class Gateway extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'gateways';
    protected $fillable = [
        'name',
        'slug',
        'type',
        'image',
        'config',
        'default',
        'active',
        'wallet',
        'limit_cost',
    ];

    public static function showCard($number, $maskingCharacter = '*')
    {
        return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
    }

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }


    public static function payment($gateway_id, $token, $try = false, $charge = false)
    {
        $gateway = Gateway::find($gateway_id);
        $config = json_decode($gateway->config);
        switch ($gateway->slug) {
            case 'Zarinpal':
                return static::zarinpalRequest($token, $config, $try, $charge);
            case 'Home':
                return static::HomeRequest($token);
            case 'Wallet':
                return static::WalletRequest($token);
            case 'Parsian':
                return static::ParsianRequest($token, $config, $try, $charge);
            case 'Mellat':
                return static::MellatRequest($token, $config, $try, $charge);
            case 'Sadad':
                return static::SadadRequest($token, $config, $try, $charge);
        }
    }

    public static function ZarinpalRequest($token, $config, $try, $charge)
    {
        $payment = static::getPayment($token);

        $apiPurchaseUrl = config('gateway.drivers.zarinpal.apiPurchaseUrl');
        $client = new \SoapClient($apiPurchaseUrl, ['encoding' => 'UTF-8']);

        $callback = url('/payment/checkout/' . $payment->token);
        if ($try) {
            $callback = url('/payment/checkoutAgain/' . $payment->token);
        }
        if ($charge) {
            $callback = url('/profile/wallet/checkout/' . $payment->token);
        }

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $config->merchant,
                'Amount' => $payment->amount,
                'Description' => 'مدرسه',
                'Email' => '',
                'Mobile' => '',
                'CallbackURL' => $callback,
            ]
        );


        if ($result->Status == 100) {
            Payment::where('token', $payment->token)->orderBy('id', 'desc')->first()->update([
                'trans_id' => $result->Authority
            ]);

            $url = config('gateway.drivers.zarinpal.apiPaymentUrl') . $result->Authority . '/Asan';

            return response()->json(['status' => 200, 'url' => $url]);
        } else {
            $payment->update([
                'status' => 'failed',
                'description' => json_encode($result->Status)
            ]);
            return response()->json(['status' => $result->Status]);
        }

    }

    public static function getPayment($token)
    {
        $payment = Payment::where('token', $token)->whereStatus('waiting')->orderby('id', 'desc')->first();
        return $payment;
    }

    public static function HomeRequest($token)
    {
        Payment::where('token', $token)->whereNotIn('type', ['wallet'])->update([
            'trans_id' => rand(100000000, 999999999),
            'type' => 'local'
        ]);

        $url = url('/payment/checkout/' . $token);
        return response()->json(['status' => 200, 'url' => $url]);
    }

    public static function WalletRequest($token)
    {
        Payment::where('token', $token)->update([
            'trans_id' => rand(100000000, 999999999)
        ]);

        $url = url('/payment/checkout/' . $token);
        return response()->json(['status' => 200, 'url' => $url]);
    }

    public static function ParsianRequest($token, $config, $try, $charge)
    {
        $payment = static::getPayment($token);

        $pin = $config->pin;;
        $price = $payment->amount * 10;// RIAL

        $callback = url('/payment/checkout/' . $payment->token);
        if ($try) {
            $callback = url('/payment/checkoutAgain/' . $payment->token);
        }
        if ($charge) {
            $callback = url('/profile/wallet/checkout/' . $payment->token);
        }

        $orderId = self::getPaymentId($token);

        $params = array(
            'LoginAccount' => $pin,
            'Amount' => $price,
            'OrderId' => $orderId,
            'CallBackUrl' => $callback,
            'AdditionalData' => ""
        );

        $serverUrl = config('gateway.drivers.parsian.serverUrl');
//         $serverUrl        = 'http://banktest.ir/gateway/Parsian/NewIPGServices/Sale/SaleService.asmx?wsdl'; // For test

        try {
            $soap = new \SoapClient($serverUrl);
            $response = $soap->SalePaymentRequest(["requestData" => $params]);

        } catch (\SoapFault $e) {
            return response()->json(['status' => $e, 'message' => 'خطایی رخ داد']);
        }

        if (!isset($response->SalePaymentRequestResult)
            || isset($response->SalePaymentRequestResult)
            && !isset($response->SalePaymentRequestResult->Token)
            || isset($response->SalePaymentRequestResult->Token)
            && $response->SalePaymentRequestResult->Token == '') {
            $errorMessage = ParsianResult::errorMessage($response->SalePaymentRequestResult->Status);
            return response()->json(['status' => $response->SalePaymentRequestResult->Status, 'message' => $errorMessage]);
        }
        if ($response !== false) {
            $authority = $response->SalePaymentRequestResult->Token;
            $status = $response->SalePaymentRequestResult->Status;

            if ($authority && $status == 0) {
                Payment::where('token', $payment->token)->orderBy('id', 'desc')->first()->update([
                    'trans_id' => $authority
                ]);

                $url = config('gateway.drivers.parsian.apiPaymentUrl') . "?Token=" . $authority;
//                $url = "http://banktest.ir/gateway/Parsian/NewIPGq?Token=".$authority; // For test

                return response()->json(['status' => 200, 'url' => $url]);
            }

            $errorMessage = ParsianResult::errorMessage($status);
            return response()->json(['status' => $response->SalePaymentRequestResult->Status, 'message' => $errorMessage]);

        } else {
            return response()->json(['status' => -1, 'message' => "خطا در اتصال به درگاه پارسیان"]);
        }


    }

    public static function getPaymentId($token)
    {
        $payment = static::getPayment($token);
        return $payment->date + $payment->id;
    }

    public static function MellatRequest($token, $config, $try, $charge)
    {

        $dateTime = new DateTime();
        $payment = static::getPayment($token);
        $terminalId = $config->terminalId;
        $username = $config->username;
        $password = $config->password;
        $price = $payment->amount * 10;// RIAL

        $callback = url('/payment/checkout/' . $payment->token);
        if ($try) {
            $callback = url('/payment/checkoutAgain/' . $payment->token);
        }
        if ($charge) {
            $callback = url('/profile/wallet/checkout/' . $payment->token);
        }

        $orderId = self::getPaymentId($token);

        $fields = array(
            'terminalId' => $terminalId,
            'userName' => $username,
            'userPassword' => $password,
            'orderId' => $orderId,
            'amount' => $price,
            'localDate' => $dateTime->format('Ymd'),
            'localTime' => $dateTime->format('His'),
            'additionalData' => '',
            'callBackUrl' => $callback,
            'payerId' => 0,
        );

        $serverUrl = config('gateway.drivers.mellat.serverUrl');
//        $serverUrl = 'http://banktest.ir/gateway/mellat/ws?wsdl'; // For test

        try {
            $soap = new \SoapClient($serverUrl);
            $response = $soap->bpPayRequest($fields);

        } catch (\SoapFault $e) {
            return response()->json(['status' => $e, 'message' => 'خطایی رخ داد']);
        }

        $response = explode(',', $response->return);

        if ($response[0] != '0') {
            $errorMessage = MellatException::errorMessage($response[0]);
            $payment->update([
                'description' => $errorMessage
            ]);
            return response()->json(['status' => $response[0], 'message' => $errorMessage]);
        }

        Payment::where('token', $payment->token)->orderBy('id', 'desc')->first()->update([
            'trans_id' => $response[1]
        ]);

        $url = url('payment/bank-redirect/Mellat?refId=' . $response[1]);
        return response()->json(['status' => 200, 'url' => $url]);
    }

    public static function SadadRequest($token, $config, $try, $charge)
    {

        $payment = static::getPayment($token);
        $callback = url('/payment/checkout/' . $payment->token);
        if ($try) {
            $callback = url('/payment/checkoutAgain/' . $payment->token);
        }
        if ($charge) {
            $callback = url('/profile/wallet/checkout/' . $payment->token);
        }

        $orderId = self::getPaymentId($token);
        $Amount = $payment->amount * 10;// RIAL
        $TerminalId = $config->terminalId;
        $MerchantId = $config->merchant;
        $key = $config->transactionKey;
        $LocalDateTime = date("m/d/Y g:i:s a"); // این زمان نباید بیشتر از ۲ دقیقه با زمان سرور بانک اختلاف داشته باشد


        $SignData = self::encryptPkcs7Sadad("$TerminalId;$orderId;$Amount", "$key");

        $data = [
            'TerminalId' => $TerminalId,
            'MerchantId' => $MerchantId,
            'Amount' => $Amount,
            'SignData' => $SignData,
            'ReturnUrl' => $callback,
            'LocalDateTime' => $LocalDateTime,
            'OrderId' => $orderId,
        ];

        $str_data = json_encode($data);
        $serverUrl = config('gateway.drivers.sadad.serverUrl');
        $res = self::CallAPISadad($serverUrl, $str_data);
        $response = json_decode($res);

        $gatewayURL = config('gateway.drivers.sadad.gatewayURL');

        if ($response->ResCode == 0) {
            $Token = $response->Token;
            $url = "{$gatewayURL}?Token=$Token";

            Payment::where('token', $payment->token)->orderBy('id', 'desc')->first()->update([
                'trans_id' => $response->Token
            ]);

            return response()->json(['status' => 200, 'url' => $url]);
        } else {
            $payment->update([
                'description' => $response->Description
            ]);
            return response()->json(['status' => $response->ResCode, 'message' => $response->Description]);
        }
    }

    //Create sign data(Tripledes(ECB,PKCS7)) in PHP 7+
    public static function encryptPkcs7Sadad($str, $key)
    {
        $key = base64_decode($key);
        $cipherText = OpenSSL_encrypt($str, "DES-EDE3", $key, OPENSSL_RAW_DATA);

        return base64_encode($cipherText);
    }

    public static function CallAPISadad($url, $data = false)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
        ]);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function getOrder($token)
    {
        $order = Order::where('token', $token)->first();
        return $order;
    }

    public static function verify($token)
    {
        if (Payment::where('token', $token)->orderBy('id', 'desc')->first() != null) {
            $payment = static::getPayment($token);
            $bank = Gateway::find($payment->gateway_id);
            $bank_slug = $bank->slug;
            $bank_config = json_decode($bank->config);
            $result = static::{$bank_slug . 'Verify'}($token, $bank_config);
            if ($result) {
                return true;
            } else return false;
        } else {
            return redirect('/profile');
        }
    }

    public static function ZarinpalVerify($token, $config)
    {
        if ($_GET['Status'] == 'OK') {
            $Authority = request('Authority');
            $payment = static::getPayment($token);
            $apiPurchaseUrl = config('gateway.drivers.zarinpal.apiVerificationUrl');
            $client = new \SoapClient($apiPurchaseUrl, ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $config->merchant,
                    'Authority' => $Authority,
                    'Amount' => $payment->amount,
                ]
            );

            if ($result->Status == 100) {
                $description = ZarinpalException::errorMessage($result->Status);
                $payment->update([
                    'description' => json_encode($description),
                    'status' => 'success'
                ]);
                return true;
            } else {
                $error = ZarinpalException::errorMessage($result->Status);
                $payment->update([
                    'description' => json_encode($error),
                    'status' => 'failed'
                ]);
                return false;
            }

        } else return false;
    }

    public static function HomeVerify($token, $config)
    {
        return true;
    }

    public static function WalletVerify($token, $config)
    {
        return true;
    }

    public static function ParsianVerify($token, $config)
    {

        if (!Request::has('Token') && !Request::has('status'))
            return false;

        $payment = static::getPayment($token);
        $authority = Request::input('Token');
        $status = Request::input('status');

        if ($status != 0) {
            $errorMessage = ParsianResult::errorMessage($status);
            $payment->update([
                'description' => json_encode($errorMessage)
            ]);
            return false;
        }


        $pin = $config->pin;;

        if ($payment->trans_id != $authority)
            return false;

        $params = array(
            'LoginAccount' => $pin,
            'Token' => $authority,
        );

        $serverUrlConfirm = config('gateway.drivers.parsian.serverUrlConfirm');
//        $serverUrlConfirm = "http://banktest.ir/gateway/Parsian/NewIPGServices/Confirm/ConfirmService.asmx?wsdl"; // For test

        try {
            $soap = new \SoapClient($serverUrlConfirm);
            $result = $soap->ConfirmPayment([
                "requestData" => $params
            ]);

        } catch (\SoapFault $e) {
            $payment->update([
                'description' => $e
            ]);
            return false;
        }

        if ($result === false || !isset($result->ConfirmPaymentResult->Status))
            return false;


        if ($result->ConfirmPaymentResult->Status != 0) {
            $errorMessage = ParsianResult::errorMessage($result->ConfirmPaymentResult->Status);
            $payment->update([
                'description' => json_encode($errorMessage)
            ]);
            return false;
        }

        if ($result->ConfirmPaymentResult->Status == 0) {
            $description = ParsianResult::errorMessage($result->ConfirmPaymentResult->Status);

            $payment->update([
                'description' => json_encode($description)
            ]);

            return true;
        }

        return false;

    }

    public static function MellatVerify($token, $config)
    {

        if (!Request::has('RefId') && !Request::has('SaleReferenceId'))
            return false;

        $refId = Request::input('RefId');
        $trackingCode = Request::input('SaleReferenceId');
        $cardNumber = Request::input('CardHolderPan');
        $payRequestResCode = Request::input('ResCode');

        $payment = static::getPayment($token);
        $terminalId = $config->terminalId;
        $username = $config->username;
        $password = $config->password;

        if ($payRequestResCode != '0') {
            $errorMessage = MellatException::errorMessage($payRequestResCode);
            $payment->update([
                'description' => json_encode($errorMessage)
            ]);
            return false;
        }

        $orderId = self::getPaymentId($token);

        $fields = array(
            'terminalId' => $terminalId,
            'userName' => $username,
            'userPassword' => $password,
            'orderId' => $orderId,
            'saleOrderId' => $orderId,
            'saleReferenceId' => $trackingCode
        );

        $serverUrl = config('gateway.drivers.mellat.serverUrl');
//        $serverUrl = 'http://banktest.ir/gateway/mellat/ws?wsdl'; // For test

        try {
            $soap = new \SoapClient($serverUrl);
            $response = $soap->bpVerifyRequest($fields);

        } catch (\SoapFault $e) {
            $payment->update([
                'description' => json_encode($e)
            ]);
            return false;
        }

        if ($response->return != '0') {
            $errorMessage = MellatException::errorMessage($response->return);
            $payment->update([
                'description' => $errorMessage
            ]);
            return false;
        }

        try {
            $soap = new \SoapClient($serverUrl);
            $response = $soap->bpSettleRequest($fields);

        } catch (\SoapFault $e) {
            $payment->update([
                'description' => json_encode($e)
            ]);
            return false;
        }

        if ($response->return == '0' || $response->return == '45') {

            $description = [
                'refId' => $refId,
                'trackingCode' => $trackingCode,
                'cardNumber' => $cardNumber,
                'payRequestResCode' => $payRequestResCode,
                'status' => $response->return
            ];

            $payment->update([
                'description' => json_encode($description)
            ]);

            return true;
        }

        $errorMessage = MellatException::errorMessage($response->return);
        $payment->update([
            'description' => $errorMessage
        ]);
        return false;
    }

    public static function SadadVerify($token, $config)
    {
        $post = array_change_key_case($_POST, CASE_LOWER);
        $payment = static::getPayment($token);

        $key = $config->transactionKey;

        $OrderId = $post["orderid"];
        $Token = $post["token"];
        $ResCode = $post["rescode"];

        $verifyTransactionURL = config('gateway.drivers.sadad.verifyTransactionURL');

        if ($ResCode == 0) {
            $verifyData = [
                'Token' => $Token,
                'SignData' => self::encryptPkcs7Sadad($Token, $key),
            ];
            $str_data = json_encode($verifyData);
            $res = self::CallAPISadad($verifyTransactionURL, $str_data);
            $response = json_decode($res);
        }

        if ($ResCode==0 && $response->ResCode!=-1 ) {

            $description = [
                'RetrivalRefNo' => $response->RetrivalRefNo,
                'SystemTraceNo' => $response->SystemTraceNo,
                'OrderId' => $OrderId,
            ];

            $payment->update([
                'description' => json_encode($description)
            ]);

            return true;

        } else {

            $payment->update([
                'description' => "تراکنش ناموفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد."
            ]);

            return false;
        }

    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


}
