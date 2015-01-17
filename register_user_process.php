<?php 

if (isset($argv[1])) {
	require_once('db_connect');
	
	$account_info = explode("|", $argv[1]);
	$username = $account_info[0]; 
	$password = $account_info[1];
	
	if ($_SESSION['connection']) {
		$query = array("username" => $username, "password" => $password); 
		$users->insert($query);
		exit('successfully added user');
	} else {
		exit('failed to connect to db. please try again');	
	}
	
	
	
}


?> 