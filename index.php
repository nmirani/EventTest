<?php

session_start();

include_once "facebook-php-sdk/src/facebook.php";
 
require_once( 'facebook-php-sdk/src/Facebook/FacebookSession.php' );
require_once( 'facebook-php-sdk/src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'facebook-php-sdk/src/Facebook/FacebookRequest.php' );
require_once( 'facebook-php-sdk/src/Facebook/FacebookResponse.php' );
require_once( 'facebook-php-sdk/src/Facebook/FacebookSDKException.php' );
require_once( 'facebook-php-sdk/src/Facebook/FacebookRequestException.php' );
require_once( 'facebook-php-sdk/src/Facebook/FacebookAuthorizationException.php' );
require_once( 'facebook-php-sdk/src/Facebook/GraphObject.php' );
require_once 'autoload.php';
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
 
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('1486180144974468','528b621709faf5bf2277b5272a1572e6');
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://agile-badlands-9486.herokuapp.com/' );
 
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
  echo print_r ($ex "Exception");
} catch( Exception $ex ) {
  // When validation fails or other local issues
  echo print_r ($ex "Exception");
}
 
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
   
  // print data
  echo  print_r( $graphObject, 1 );
} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
}

?>
