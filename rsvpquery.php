 <?php

//After succesfully creating an event, you can create a query to get results of attendees.
	//Get Facebook SDK Object
	 $app_id = '1486180144974468';
   $app_secret = '528b621709faf5bf2277b5272a1572e6';
   $my_url = 'http://murmuring-plains-1063.herokuapp.com/';

	 $code = $_REQUEST["code"];

 // auth user
 if(empty($code)) {
    $dialog_url = 'https://www.facebook.com/dialog/oauth?client_id=' 
    . $app_id . '&redirect_uri=' . urlencode($my_url) ;
    echo("<script>top.location.href='" . $dialog_url . "'</script>");
  }

  // get user access_token
  $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='
    . $app_id . '&redirect_uri=' . urlencode($my_url) 
    . '&client_secret=' . $app_secret 
    . '&code=' . $code;

  // response is of the format "access_token=AAAC..."
  $access_token = substr(file_get_contents($token_url), 13);



	//Create Query
	$params = array(
	    'method' => 'fql.query',
	    'query' => "SELECT eid, rsvp_status FROM event_member WHERE uid = me() AND rsvp_status= "attending"";

	//Run Query
	$result = $facebook->api($params);
?>
