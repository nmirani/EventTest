<?php

include_once "facebook-php-sdk/src/facebook.php";


$app_id = "1486180144974468";
$app_secret = "528b621709faf5bf2277b5272a1572e6";
$my_url = "http://murmuring-plains-1063.herokuapp.com/";

$facebook = new Facebook(array(
						'appId' => $app_id,
						'secret' => $app_secret,
						'cookie' => true));
						
$access_token =  $facebook->getAccessToken();
$facebook->setAccessToken($access_token);

//List tester

$request = new FacebookRequest(
  $session,
  'GET',
  '/{347776302055884}/attending'
);
$response = $request->execute();
$graphObject = $response->getGraphObject();

<h1> People attending event </h1>
echo $request;
/* handle the result */

 

