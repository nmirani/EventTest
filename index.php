<?php

include_once "facebook-php-sdk/src/facebook.php";

$app_id = '1486180144974468';
$app_secret = '528b621709faf5bf2277b5272a1572e6';
$url = 'http://agile-badlands-9486.herokuapp.com/';



$facebook = new Facebook(array(
				'appId' => $app_id,
				'secret' => $app_secret,
				'cookie' => true));

session_start();

//getting access token
$access_token =  $facebook->getAccessToken();
$facebook->setAccessToken($access_token);

//setting login and including the required permissions
$helper = new FacebookRedirectLoginHelper( 'http://agile-badlands-9486.herokuapp.com/' );
$helper->getLoginUrl(array('scope' => 'user_events'));

// Get User ID
$user = $facebook->getUser();

// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
  
  // validate the access_token to make sure it's still valid
  try {
    if ( !$session->validate() ) {
      $session = null;
    }
  } catch ( Exception $e ) {
    // catch any exceptions
    $session = null;
  }
}

// see if we have a session
if ( isset( $session ) ) {
  
  // save the session
  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
  
  $request = new FacebookRequest( $session, 'GET', '/{347776302055884}/attending' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject()->asArray();

  echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
  
  error_reporting(E_ALL);
	ini_set('display_errors', 1); }
	?>
