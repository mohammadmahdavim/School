<?php
return [

    'drivers' => [

        'mellat' => [
            'serverUrl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
            'apiPaymentUrl' => 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat',
        ],

        'parsian' => [
            'serverUrl' => 'https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl',
            'apiPaymentUrl' => 'https://pec.shaparak.ir/NewIPG',
            'serverUrlConfirm' => 'https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?WSDL',
        ],

        'zarinpal' => [
            /* normal api */
//            'apiPurchaseUrl' => 'https://www.zarinpal.com/pg/services/WebGate/wsdl',
//            'apiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/',
//            'apiVerificationUrl' => 'https://www.zarinpal.com/pg/services/WebGate/wsdl',

            /* sandbox api */
           'apiPurchaseUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',
         'apiPaymentUrl' => 'https://sandbox.zarinpal.com/pg/StartPay/',
        'apiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',

        ],

        'sadad' => [
            'serverUrl' => 'https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest',
            'gatewayURL' => 'https://sadad.shaparak.ir/VPG/Purchase',
            'verifyTransactionURL' => 'https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify',

            /*
             * sandbox url
             */

            // 'serverUrl' => 'http://banktest.ir/gateway/melli/payment-request',
            // 'gatewayURL' => 'http://banktest.ir/gateway/melli/purchase',
            // 'verifyTransactionURL' => 'http://banktest.ir/gateway/melli/verify'
        ]
    ]

];
