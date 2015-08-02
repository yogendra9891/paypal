<?php

define('PAYPAL_API_USER', 'shalu.garg_api1.daffodilsw.com');
define('PAYPAL_API_PWD', 'FBATAT8VDJ7N3UKJ');
define('PAYPAL_API_SIGNATURE', 'AEQPlaBXsuAUNaatfuOLqB3PeHvsApPAXnbWqFuXFclh4rEryXngoW18');
define('PAYPAL_API_APPLICATION_ID', 'APP-80W284485P519543T');

$endpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments/Preapproval";

$headers = array(
    'X-PAYPAL-SECURITY-USERID: '.PAYPAL_API_USER,
    'X-PAYPAL-SECURITY-PASSWORD: '.PAYPAL_API_PWD,
    'X-PAYPAL-SECURITY-SIGNATURE: '.PAYPAL_API_SIGNATURE,
    'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
    'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
    'X-PAYPAL-APPLICATION-ID: '.PAYPAL_API_APPLICATION_ID,
);
$payload = "cancelUrl=http://localhost/sixthcontinent_symfony/php/web/&clientDetails.applicationId=APP-80W284485P519543"
				."&clientDetails.ipAddress=127.0.0.1&currencyCode=USD&startingDate=2015-04-17T10:45:52Z".
				"&endingDate=2015-04-29T20:40:52Z".
					"&maxAmountPerPayment=335.00".
					"&maxNumberOfPayments=20".
					"&maxTotalAmountOfAllPayments=800.00".
					"&returnUrl=http://localhost/sixthcontinent_symfony/php/web/".
					"&requestEnvelope.errorLanguage=en_US";
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