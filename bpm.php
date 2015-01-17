<?php
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] != 'POST') {
	exit('error, pls post'); 
} else {
	require_once('db_connect.php');
	if (!isset($_POST['username']) {
		exit('error, post username');
	} else if ($_POST['data'] = 'retrieve') {
		$username = $_POST['username'];
		$query = array("username" => $username);
		$return = $users->findOne($query);
		if(!$return) {
			exit('user not in db');
		} else {
			echo $return['bpm'];
			exit;
		}	
	} else if ($_POST['data'] = 'update' && isset($POST['bpm'])) {
		$username = $_POST['username'];
		$query = array("username" => $username);
		$return = $users->findOne($query);
		if(!$return) {
			exit('user not in db');
		} else {
			$query = array('$set' => array("bpm" => $_POST['bpm']));
			$users->update($return, $query);
			exit;
		}
	} else {
		exit('whatchu doin');
	}
}


/* TO RETRIEVE DATA
	data: retrieve
	username: username
	
   TO UPDATE DATA
    data: update
    username: username
    bpm: bpm
   



?>