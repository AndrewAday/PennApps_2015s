<?php 
header('Content-Type: application/json');
require_once 'db_connect.php'; 
require_once '/var/www/pennapps.gomurmur.com/php-echonest-api/lib/EchoNest/Autoloader.php';

if(isset($_POST['echo_nest_id']) && isset($_POST['username'])) {
	require_once 'echo_nest_auth.php';
	$id = $_POST['echo_nest_id']; 
	$username = $_POST['username']; 

	$user = $users->findOne(array('username' => $username)); 
	
	$audio_info = file_get_contents('http://developer.echonest.com/api/v4/song/profile?api_key=PCDOMTD1QSYCNESM5&format=json&id=' .$id. '&bucket=audio_summary');
	$audio_info = json_decode($audio_info, true);
	//updates current track and song info in db
	if($audio_info['response']['status']['code'] == 0) {
		$song_info = $audio_info['response']['songs'][0];
		$query = array('$set' => array("song" => array('song_name' => $song_info['title'], 'artist_name' => $song_info['artist_name'], 'song_info' => $song_info)));
		$users->update($user, $query);
		$response = array('message' => 'good job, song updated');
		echo json_encode($response);
	} else {
		$response = array('message' => 'song failed to update');
		echo json_encode($response);
	}

	
}





?>