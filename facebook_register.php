<?php 
header('Content-Type: application/json');
require_once 'db_connect.php';

$facebook_id = $_POST['access_token'];
$username = $_POST['username']; 

$result = $users->findOne(array("username" => $username)); 

$query=array('$set' => array("facebook_id" => $facebook_id));

$users->update($result,$query);

$result = $users->findOne(array("username" => $username)); 

$response = array('facebook_id' => $result['facebook_id']);
echo json_encode($response);





?> 