<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$app_id="APP-12345";
$transaction_id=  "25";
$currency = "EUR";
$amount="2299";
$url_normal="https://www.carrerajeans.com/";
$urlpost="https://www.carrerajeans.com/post_transaction.php";
$url_back="https://www.carrerajeans.com/url_back_transaction.php";
$secret = "Ag8FwDQeQvCMvFZSnhyj7aprwQG9Ao1YwXVngiJN85CuZhH7m6r4gEYD";
$string = "transaction_id=".$transaction_id."currency=".$currency."amount=".$amount.$secret;
echo "string is: $string";
echo "<br>mac is: ";
echo $mac = sha1($string); exit;
$url ="http://45.33.28.108/sixthcontinent_angular/pay?";
$url.="app_id=$app_id";
$url.="amount=100";
$url.="currency=EUR";
$url.="url=$url_normal";
$url.="urlpost=$urlpost";
$url.="url_back=$url_back";
$url.="type_service=pay_once";
$url.="language_id=ITA";
$url.="mac=$mac";
        
echo " hello <br>";
echo " $url ";

/*

http://45.33.28.108/sixthcontinent_grunt/sixthcontinent_angular/pay/?app_id=APP-12345&amount=6149&currency=EUR&
url=https://www.carrerajeans.com?getdata=3/&
urlpost=http://45.33.15.158/sixthcontinent_symfony_dev/php/web/webapi/posturldata&url_back=https://www.carrerajeans.com/url_back_transaction.php?reference=34&type_service=pay_once
&language_id=ITA&mac=093c02d0417b1aec72893f2db70fa0ea9c530232&session_id=30085&description=payment&transaction_id=25#/

https://www.sixthcontinent.com/pay/?app_id=APP-2345DERT&amount=1379&currency=EUR&transaction_id=25
&url=http:%2F%2Fwww.carrerajeans.com&urlpost=http:%2F%2Fwww.carrerajeans.com%2Fsandbox%2Ferpec%2Fipn%2Fsixthcontinetipn.php
&url_back=http:%2F%2Fwww.carrerajeans.com&type_service=pay_once&language_id=ENG&
mac=f7908f713afd998906731e71f61e87df99d27202&description=desc&session_id=94b1ce4b3570fb1f1d4f0ca52f3fe1ad#/order/confirm
*/