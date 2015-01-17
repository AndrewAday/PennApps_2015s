<?php 

if (isset($argv[1])) {
	require_once('db_connect.php');
	

	$username = $argv[1]; 
	
	if ($_SESSION['connection']) {
		$query = array("username" => $username); 
		$users->insert($query);
		exit('successfully added user');
	} else {
		exit('failed to connect to db. please try again');	
	}
	
	
	
}


?> 