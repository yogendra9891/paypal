<?php

define('PAYPAL_API_USER', 'sabrina.torti_api1.sixthcontinent.org');
define('PAYPAL_API_PWD', 'G88MY7L8R4Z2E57C');
define('PAYPAL_API_SIGNATURE', 'Ag8FwDQeQvCMvFZSnhyj7aprwQG9Ao1YwXVngiJN85CuZhH7m6r4gEYD');
define('PAYPAL_API_APPLICATION_ID', 'APP-7LV24104PR148000R');

$endpoint = "https://svcs.paypal.com/AdaptivePayments/Pay";

$headers = array(
    'X-PAYPAL-SECURITY-USERID: '.PAYPAL_API_USER,
    'X-PAYPAL-SECURITY-PASSWORD: '.PAYPAL_API_PWD,
    'X-PAYPAL-SECURITY-SIGNATURE: '.PAYPAL_API_SIGNATURE,
    'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
    'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
    'X-PAYPAL-APPLICATION-ID: '.PAYPAL_API_APPLICATION_ID,
);
$payload = "actionType=PAY&ipnNotificationUrl=http://php-sg1234.rhcloud.com/ipn_test.php&cancelUrl=http://45.33.45.34/sixthcontinent_symfony/php/web/".
"&clientDetails.applicationId=APP-80W284485P519543T&clientDetails.ipAddress=127.0.0.1&currencyCode=USD&receiverList.receiver(0).amount=20.00&receiverList.receiver(0).email=ankit.daffodil@gmail.com"
."".
"&requestEnvelope.errorLanguage=en_US&returnUrl=http://45.33.45.34/sixthcontinent_symfony/php/web/".
"&senderEmail=sabrina.torti@sixthcontinent.org".
"&preapprovalKey=PA-36B90416H64663228";
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