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

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

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

 

