<?php

include_once "facebook-php-sdk/src/facebook.php";

$app_id = '1486180144974468';
$app_secret = '528b621709faf5bf2277b5272a1572e6';
$url = 'http://agile-badlands-9486.herokuapp.com/';



$facebook = new Facebook(array(
				'appId' => $app_id,
				'secret' => $app_secret,
				'cookie' => true));
				
$access_token =  $facebook->getAccessToken();
$facebook->setAccessToken($access_token);

$session = new FacebookSession('$access_token');

try {
  $me = (new FacebookRequest(
    $session, 'GET', '/me'
  ))->execute()->getGraphObject();
  echo $me->getName();
} catch (FacebookRequestException $e) {
  // The Graph API returned an error
  print_r $e;
} catch (\Exception $e) {
  // Some other error occurred
  print_r $e;
}
