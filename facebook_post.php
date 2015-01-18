<?php 
header('Content-Type: application/json');

require_once 'db_connect.php';
require 'facebook_access.php';
require 'vendor/autoload.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookRequestException;
	use Facebook\GraphObject;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookCanvasLoginHelper;
	use Facebook\FacebookJavaScriptLoginHelper;
	
	FacebookSession::setDefaultApplication('826856194027238','062c6c932179c5464ffe58385a2fd415');

	
if (isset($_POST['distance']) and isset($_POST['username'])) {

	$distance = $_POST['distance'];
	$username = $_POST['username'];

	$user = $users->findOne(array('username' => $username));
 	$access_token = $user['facebook_id'];
	
	/* $access_token = 'CAALwBXW5ruYBAB1BwEZCaA3faPnRtyphwnAhqgujo7zJ0dZCruTUXXZC5pWBRUD59oeq6ZBF3EgZBnGw6JfYkyrqZBSrNeA4GHgEy428ZBD9PhY8Hvnz5yldkiEdcePMrKZCPZBvw8PcvKqWk4mMtsweDgWQvdsNYtz9Huir2VlYcR6Rqh9ohHM4Ocgp77aIaFPXvNPor2c4L8pS7BqfrDKHkSS9qGWK6hnoZD';  */
	$session = new FacebookSession($access_token);
		
	if($session) {	
		try {
		$message = 'I just ran ' . $distance . ' meters with Jockulus! #PennApps_2015'; 
	    // Upload to a user's profile. The photo will be in the
	    // first album in the profile. You can also upload to
	    // a specific album by using /ALBUM_ID as the path     
	    $response = (new FacebookRequest(
	      $session, 'POST', '/me/feed', array(
	        'message' => $message 
	      )
	    ))->execute()->getGraphObject();
	
	    // If you're not using PHP 5.5 or later, change the file reference to:
	    // 'source' => '@/path/to/file.name'
	
	    $response = array("id" => $response->getProperty('id'));
	    $response = json_encode($response);
	    echo $response;
	
	  } catch(FacebookRequestException $e) {
	
		$response = array("error_code" => $response->getProperty('id'), "message" => $e->getMessage());
		$response = json_encode($response);
		echo $response;
	  }   	
	}
	
} else {
	$response = array("status" => "error, improper params");
	$response = json_encode($response);
	echo $response;
}

?>