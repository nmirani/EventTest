<?php
/*	FACEBOOK LOGIN BASIC - PHP SDK V4.0
 *	file 			- index.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://packetcode.com/apps/fblogin-basic/
 *	Date 			- 27th Sept 2014
 *	license			- GNU General Public License version 2 or later
*/

/* INCLUSION OF LIBRARY FILEs*/
	require_once( 'facebook-php-sdk/src/Facebook/facebook.php');
	require_once( 'facebook-php-sdk/src/Facebook/FacebookSession.php');
	require_once( 'facebook-php-sdk/src/Facebook/FacebookRequest.php' );
	require_once( 'facebook-php-sdk/src/Facebook/FacebookResponse.php' );
	require_once( 'facebook-php-sdk/src/Facebook/FacebookSDKException.php' );
	require_once( 'facebook-php-sdk/src/Facebook/FacebookRequestException.php' );
	require_once( 'facebook-php-sdk/src/Facebook/FacebookRedirectLoginHelper.php');
	require_once( 'facebook-php-sdk/src/Facebook/FacebookAuthorizationException.php' );
	require_once( 'facebook-php-sdk/src/Facebook/GraphObject.php' );
	require_once( 'facebook-php-sdk/src/Facebook/GraphUser.php' );
	require_once( 'facebook-php-sdk/src/Facebook/GraphSessionInfo.php' );
	require_once( 'facebook-php-sdk/src/Facebook/Entities/AccessToken.php');
	require_once( 'facebook-php-sdk/src/Facebook/HttpClients/FacebookCurl.php' );
	require_once( 'facebook-php-sdk/src/Facebook/HttpClients/FacebookHttpable.php');
	require_once( 'facebook-php-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php');

/* USE NAMESPACES */
	
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\GraphUser;
	use Facebook\GraphSessionInfo;
	use Facebook\HttpClients\FacebookHttpable;
	use Facebook\HttpClients\FacebookCurl;
	use Facebook\HttpClients\FacebookCurlHttpClient;
	use Facebook\Entities\AccessToken;

/*PROCESS*/
	
	//1.Stat Session
	 session_start();
	//2.Use app id,secret and redirect url

	 $app_id = '1486180144974468';
	 $app_secret = '528b621709faf5bf2277b5272a1572e6';
	 $url = 'http://agile-badlands-9486.herokuapp.com/';
	 $redirect_url='http://agile-badlands-9486.herokuapp.com/';
	 
	 //3.Initialize application, create helper object and get fb sess
	 FacebookSession::setDefaultApplication($app_id,$app_secret);
	 $helper = new FacebookRedirectLoginHelper($redirect_url);
	 $sess = $helper->getSessionFromRedirect();
	 $helper->getLoginUrl(array('scope' => 'user_events'));


	//4. if fb sess exists echo name 
	 	if(isset($sess)){
	 		//create request object,execute and capture response
		$request = new FacebookRequest($sess, 'GET', '/me');
		// from response get graph object
		$response = $request->execute();
		$graph = $response->getGraphObject(GraphUser::className());
		// use graph object methods to get user details
		$name= $graph->getName();
		echo "hi $name";
	}else{
		//else echo login
		echo '<a href='.$helper->getLoginUrl().'>Login with facebook</a>';
	}

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	?>
