<?php
//chain preapproval key getting
define('PAYPAL_API_USER', 'sabrina.torti_api1.sixthcontinent.org');
define('PAYPAL_API_PWD', 'G88MY7L8R4Z2E57C');
define('PAYPAL_API_SIGNATURE', 'Ag8FwDQeQvCMvFZSnhyj7aprwQG9Ao1YwXVngiJN85CuZhH7m6r4gEYD');
define('PAYPAL_API_APPLICATION_ID', 'APP-7LV24104PR148000R');

$endpoint = "https://svcs.paypal.com/AdaptivePayments/Preapproval";

$headers = array(
    'X-PAYPAL-SECURITY-USERID: '.PAYPAL_API_USER,
    'X-PAYPAL-SECURITY-PASSWORD: '.PAYPAL_API_PWD,
    'X-PAYPAL-SECURITY-SIGNATURE: '.PAYPAL_API_SIGNATURE,
    'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
    'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
    'X-PAYPAL-APPLICATION-ID: '.PAYPAL_API_APPLICATION_ID,
);
$payload = "cancelUrl=https://sixthcontinent.com/&clientDetails.applicationId=APP-7LV24104PR148000R"
				."&clientDetails.ipAddress=127.0.0.1&currencyCode=USD".
				"&startingDate=2015-06-18T02:45:52Z".
				"&endingDate=2015-10-29T20:40:52Z".
					"&maxAmountPerPayment=50.00".
					"&maxNumberOfPayments=4".
					"&maxTotalAmountOfAllPayments=200.00".
					"&displayMaxTotalAmount=true".
					"&returnUrl=https://sixthcontinent.com/".
					"&requestEnvelope.errorLanguage=en_US".
					"&senderEmail=sabrina.torti@sixthcontinent.org&Subscription=true";
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