<?php
// Must pass session data for the library to work (only if not already included in your app)
session_start();
 
// Facebook app settings
$app_id = '1486180144974468';
$app_secret = '528b621709faf5bf2277b5272a1572e6';
$redirect_uri = 'http://murmuring-plains-1063.herokuapp.com/';
 
// Define the root directoy
define( 'ROOT', dirname( __FILE__ ) . '/' );
 
// Autoload the required files
require_once( ROOT . 'facebook-php-sdk-v4-4.0-dev/autoload.php' );
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
 
// Initialize the SDK
FacebookSession::setDefaultApplication( $app_id, $app_secret );
 
// Create the login helper and replace REDIRECT_URI with your URL
// Use the same domain you set for the apps 'App Domains'
// e.g. $helper = new FacebookRedirectLoginHelper( 'http://mydomain.com/redirect' );
$helper = new FacebookRedirectLoginHelper( $redirect_uri );
 
// Check if existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // Create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
 
    // Validate the access_token to make sure it's still valid
    try {
      if ( ! $session->validate() ) {
        $session = null;
      }
    } catch ( Exception $e ) {
      // Catch any exceptions
      $session = null;
    }
} else {
  // No session exists
  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
 
    // When Facebook returns an error
  } catch( Exception $ex ) {
 
    // When validation fails or other local issues
    echo $ex->message;
  }
}
 
// Check if a session exists
if ( isset( $session ) ) {
 
  // Save the session
  $_SESSION['fb_token'] = $session->getToken();
 
  // Create session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
 
  // Create the logout URL (logout page should destroy the session)
  $logoutURL = $helper->getLogoutUrl( $session, 'http://evening-earth-2752.herokuapp.com/logout' );
 
  echo '<a href="' . $logoutURL . '">Log out</a>';
} else {
  // No session
 
  // Get login URL
  $loginUrl = $helper->getLoginUrl( $permissions );
 
  echo '<a href="' . $loginUrl . '">Log in</a>';
}
