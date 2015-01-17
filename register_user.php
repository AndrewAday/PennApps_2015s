<?php 
header('Content-Type: application/json');
require("db_connect.php");


/* 

Exit statuses

0: error, user not registered correctly. Please try again
1: user registered correctly

*/
	
if ($_SESSION['connection']) {	
	if (isset($_POST['username'])) {

		$username = $_POST['username'];

		//check if user exists
		$query = (array("username" => $username));
		$result = $users->findOne($query);
		if (!$result) {
			//user doesn't exist, add to database
			$account_info = $username;
			$command = "php register_user_process.php '" .$account_info."' &";
			$shell = shell_exec($command);
			if (is_null($shell)) {
				exit('error, user not registered correctly. Please try again.');
			} else {
				$response = array("status" => "registered successfully");
				$response = json_encode($response);
				echo $response;	
			}
		} else {
			$response = array("status" => "already registered");
			$response = json_encode($response);
			exit($response); 
		}

	}
} else {
	exit('error connecting to database'); 
}

?>
