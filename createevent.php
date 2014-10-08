
<?php
include_once("facebook-php-sdk/src/facebook.php");

define("FACEBOOOK_API_KEY","571112299660525");
define("FACEBOOK_SECRET_KEY","471475a93471dcfe35f41b672387a82d");

$name = $_POST['name'];
$token = $_POST['access_token'];
$startTime = $_POST['start_time'];
$endTime = $_POST['end_time'];
$location = $_POST['location'];
$description = $_POST['description'];

$fileName = ""; //profile picture of the event

$fb = new Facebook(array(
    'appId'      => FACEBOOOK_API_KEY,
    'secret'     => FACEBOOK_SECRET_KEY,
    'cookie'     => true,
    //'fileUpload' => true
));

$fb->setAccessToken($token);

$data = array("name"=>$name,
              "access_token"=>$token,
              "start_time"=>$startTime,
              "end_time"=>$endTime,
              "location"=>$location,
              "description"=>$description,
              //basename($fileName) => '@'.$fileName
             );
try{
    $result = $fb->api("/me/events","POST",$data);
    $facebookEventId = $result['id'];
    echo $facebookEventId; //check if event is created with correct id
}catch( Exception $e){
    echo "0";
}

//(not sure of this though just a test snippet)
//creates a new request to get users that are attending particluar event using graph API
$request = new FacebookRequest(
  $session,
  'GET',
  '/{event-id}/attending'
);
$response = $request->execute();
$graphObject = $response->getGraphObject();

$attending = $facebook->api('/[EVENT-ID]/attending');
$attending = $attending['data'];
echo "List of people attending event" $attending;






?>
