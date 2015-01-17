<?php
header('Content-Type: application/json');


require_once('db_connect.php');


if($_SERVER['REQUEST_METHOD'] != 'POST') {
	echo 'pls post'; 
	exit;
} else {
	if (empty($_POST['username'])) {
		echo 'error, post username'; 
		exit;
	} else if ($_POST['data'] == 'retrieve') {
		$username = $_POST['username'];
		$query = array("username" => $username);
		$return = $users->findOne($query);
		if(!$return) {
			exit('user not in db');
		} else {
			echo json_encode($return,true);
			exit;
		}	
	} else if ($_POST['data'] == 'update' and isset($_POST['bpm'])) {
		$username = $_POST['username'];
		$query = array("username" => $username);
		$return = $users->findOne($query);
		if(!$return) {
			$response = array('message' => 'user not in db');
			echo json_encode($response); 
		} else {
			$query = array('$set' => array("bpm" => $_POST['bpm']));
			$users->update($return, $query);
			$response = array('message' => 'good job bro, bpm updated');
			echo json_encode($response); 
		}
	} else {
		$response = array('message' => 'watchu doin');
		echo json_encode($response); 

	}
}



/* TO RETRIEVE DATA
	data: retrieve
	username: username
	
   TO UPDATE DATA
    data: update
    username: username
    bpm: bpm
    
*/
   



?>