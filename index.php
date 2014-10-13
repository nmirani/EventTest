<?php

session_start();
require_once 'autoload.php';

include_once "facebook-php-sdk/src/facebook.php";


$app_id = '1486180144974468';
$app_secret = '528b621709faf5bf2277b5272a1572e6';
$url = 'http://agile-badlands-9486.herokuapp.com/';



$facebook = new Facebook(array(
				'appId' => $app_id,
				'secret' => $app_secret,
				'cookie' => true));
				


$session = Facebook\FacebookSession::setDefaultApplication('1486180144974468','528b621709faf5bf2277b5272a1572e6');
$access_token =  $facebook->getAccessToken();
$facebook->setAccessToken($access_token);
print_r($session);

$session = new FacebookSession('$access_token');

//setting login and including the required permissions
$helper = new FacebookRedirectLoginHelper( 'http://agile-badlands-9486.herokuapp.com/' );
$helper->getLoginUrl(array('scope' => 'user_events'));


try {
	if(isset($session)){
	
  $request = new FacebookRequest(
  $session,
  'GET',
  '/{347776302055884}/attending'
);
$response = $request->execute();
$graphObject = $response->getGraphObject();
 print_r $graphObject;
 echo "List of attendees" $graphObject;
 } else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
}
	
} catch (FacebookRequestException $e) {
	print_r($e);
  // The Graph API returned an error
  print_r $e;
} catch (\Exception $e) {
  // Some other error occurred
  print_r $e;
   error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
 
?>
