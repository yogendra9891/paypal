<?php

define('PAYPAL_API_USER', 'shalu.garg_api1.daffodilsw.com');
define('PAYPAL_API_PWD', 'FBATAT8VDJ7N3UKJ');
define('PAYPAL_API_SIGNATURE', 'AEQPlaBXsuAUNaatfuOLqB3PeHvsApPAXnbWqFuXFclh4rEryXngoW18');
define('PAYPAL_API_APPLICATION_ID', 'APP-80W284485P519543T');

$endpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";

$headers = array(
    'X-PAYPAL-SECURITY-USERID: '.PAYPAL_API_USER,
    'X-PAYPAL-SECURITY-PASSWORD: '.PAYPAL_API_PWD,
    'X-PAYPAL-SECURITY-SIGNATURE: '.PAYPAL_API_SIGNATURE,
    'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
    'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
    'X-PAYPAL-APPLICATION-ID: '.PAYPAL_API_APPLICATION_ID,
);
$payload = "actionType=PAY&cancelUrl=http://localhost/sixthcontinent_symfony/php/web/&clientDetails.applicationId=APP-80W284485P519543T"
				."&preapprovalKey=PA-4SL21444P6625833C"
				."&clientDetails.ipAddress=127.0.0.1&currencyCode=USD&feesPayer=EACHRECEIVER&memo=Parallel-payment-example".
				"&receiverList.receiver(0).amount=200.00&receiverList.receiver(0).email=yogendra.singh-buyer@daffodilsw.com".
					"&receiverList.receiver(0).primary=true&receiverList.receiver(1).amount=50.00".
					"&receiverList.receiver(1).email=prem.baboo2@daffodilsw.com".
					"&receiverList.receiver(1).primary=false".
					"&requestEnvelope.errorLanguage=en_US".
					"&returnUrl=http://localhost/sixthcontinent_symfony/php/web/".
					"&senderEmail=singh.yogendra465-1@gmail.com";
					//echo $payload; exit;
$options = array(
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => $headers,
	CURLOPT_POST => false,
	CURLOPT_POSTFIELDS => $payload,
    CURLOPT_RETURNTRANSFER => true
);

try{
    $curl = curl_init($endpoint);
    if(!$curl){
        throw new Exception('Could not initialize curl');
    }
    if(!curl_setopt_array($curl, $options)){
        throw new Exception('Curl error:' . curl_error($curl));
    }
    $result = curl_exec($curl);
    if(!$result){
        throw new Exception('Curl error:' . curl_error($curl));
    }
    curl_close($curl);
    echo $result;
}catch(Exception $e){
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}