<?php
// Must pass session data for the library to work (only if not already included in your app)
session_start();
 
// Facebook app settings
$app_id = '1486180144974468';
$app_secret = '528b621709faf5bf2277b5272a1572e6';
$redirect_uri = 'http://murmuring-plains-1063.herokuapp.com/';
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;

if (!isset($_SESSION['facebookUserId']) || !isset($_SESSION['facebookSession']) || !isset($_SESSION['facebookUserProfile'])) {
    // init app with app id (APPID) and secret (SECRET)
    FacebookSession::setDefaultApplication($appId,$appSecret);

    // login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper( $canvasUrl );
    try {
         $FBSession = $helper->getSessionFromRedirect();
    } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
    } catch( Exception $ex ) {
         // When validation fails or other local issues
    }
    if (!isset($FBSession)) {
        // STEP ONE - REDIRECT THE USER TO FACEBOOK FOR AUTO LOGIN / APP APPROVAL
        header('Location: ' . $helper->getLoginUrl());
        exit();
    } else {
        $user_profile = (new FacebookRequest($FBSession, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
        $_SESSION['facebookUserId'] = $user_profile->getID();
        $_SESSION['facebookSession'] = $FBSession; // I DON'T THINK THIS ACTAULLY WORKS RIGHT
        $_SESSION['facebookUserProfile'] = $user_profile;

    }
}
