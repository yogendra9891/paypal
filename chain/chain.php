<?php
define('PAYPAL_API_USER', 'shalu.garg_api1.daffodilsw.com');
define('PAYPAL_API_PWD', 'FBATAT8VDJ7N3UKJ');
define('PAYPAL_API_SIGNATURE', 'AEQPlaBXsuAUNaatfuOLqB3PeHvsApPAXnbWqFuXFclh4rEryXngoW18');
define('PAYPAL_API_APPLICATION_ID', 'APP-80W284485P519543T');

        $environment = 'sandbox';
		//$IPaddress = urlencode('172.18.2.59');

		$API_Endpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";

		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-PAYPAL-SECURITY-USERID: '.PAYPAL_API_USER));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-PAYPAL-SECURITY-PASSWORD: '.PAYPAL_API_PWD));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-PAYPAL-SECURITY-SIGNATURE: '.PAYPAL_API_SIGNATURE));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-PAYPAL-REQUEST-DATA-FORMAT:NVP'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-PAYPAL-RESPONSE-DATA-FORMAT:NVP'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-PAYPAL-APPLICATION-ID: '.PAYPAL_API_APPLICATION_ID));
		
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);

		// Set the API operation, version, and API signature in the request.
		$nvpreq = "actionType=PAY&cancelUrl=http://localhost/sixthcontinent_symfony/php/web/&clientDetails.applicationId=APP-80W284485P519543"
				."&clientDetails.ipAddress=127.0.0.1&currencyCode=USD".
				"&receiverList.receiver(0).amount=100.00&receiverList.receiver(0).email=yogendra.singh-buyer@daffodilsw.com".
					"&receiverList.receiver(0).primary=true&receiverList.receiver(1).amount=50.00
					&receiverList.receiver(1).email=abhinav.nehra@daffodilsw.com
					&receiverList.receiver(1).primary=false
					&requestEnvelope.errorLanguage=en_US
					&returnUrl=http://localhost/sixthcontinent_symfony/php/web/
					&senderEmail=prem.baboo@daffodilsw.com";
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		// Get response from the server.
		$httpResponse = curl_exec($ch);
echo "<pre>"; echo($httpResponse); exit;
		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}

		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
		
?>