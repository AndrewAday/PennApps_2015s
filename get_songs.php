<?php
header('Content-Type: application/json');
require 'vendor/autoload.php';
require 'parser.php'; 
require 'echonest_types.php'; 
$session = new SpotifyWebAPI\Session('2c2e95538e2d46a19ba2cdd910883947', 'c9b8730873944d44a86a6e7aad79e132', 'jockulus://callback');

$api = new SpotifyWebAPI\SpotifyWebAPI();

// Request a access token with optional scopes
$scopes = array(
    'playlist-read-private',
    'user-read-private'
);

$session->requestCredentialsToken($scopes);
$accessToken = $session->getAccessToken(); // We're good to go!

// Set the code on the API wrapper
$api->setAccessToken($accessToken);



if(!isset($_POST['bpm'])) {
	exit('no bpm');
} else {
	
	$bpm = $_POST['bpm'];

	/*
if ($bpm == 0) {
		$response = array('status' => 'not moving');
		echo json_encode($response); 
		exit;
	}
*/ 	if ($bpm > 260) {
		$bpm = 260;
	} else if ($bpm < 40) {
		$bpm = 100;
	} else {
		;  
	}
	
	require_once '/var/www/pennapps.gomurmur.com/php-echonest-api/lib/EchoNest/Autoloader.php';
	EchoNest_Autoloader::register();
	
	$apiKey = "PCDOMTD1QSYCNESM5"; 

	
	$echonest = new EchoNest_Client();
	$echonest->authenticate($apiKey);
	
	
	//Initiate Artist and Song APIs
	$artistApi = $echonest->getArtistApi();
	$songApi = $echonest->getSongApi();
	
	//$results = $echonest->getArtistApi()->search(array('name' => 'Radiohead'));
	$bpm_max = $bpm + 10;
	$bpm_min = $bpm - 10;
	$query = "http://developer.echonest.com/api/v4/song/search?api_key=PCDOMTD1QSYCNESM5&format=json&max_tempo=$bpm_max&min_tempo=$bpm_min&sort=song_hotttnesss-desc&bucket=audio_summary&song_type=live:false&results=8";

	
	$results = file_get_contents($query); 
	
	/*
$results = $songApi->search(array('max_tempo' => $bpm + 12, 'min_tempo' => $bpm - 12, 
										'results' => 5, 
										'min_danceability' => $min_danceability,
										'min_energy' => $min_energy,
										'min_liveness' => $min_liveness,
										'min_speechiness' => $min_speechiness,
										'bucket' => 'song_hotttnesss', 
										'bucket' => 'song_hotttnesss_rank', 
										'bucket' => 'id:spotify', 
										'sort' => 'artist_hotttnesss-desc'));
*/
	$the_money = array();
	$results = json_decode($results,true);
	foreach($results['response']['songs'] as $song) {
		$temp = array();
		$temp['title'] = $song['title'];
		$temp['artist_name'] = $song['artist_name'];
		$temp['echo_nest_id'] = $song['id']; 
		array_push($the_money, $temp);
	}
	$the_money_2 = array(); 
	foreach($the_money as $song) {
		$return = $api->search($song['artist_name'] . ' ' . $song['title'], 'track', array('limit' => 1, 'market' => 'us'));
		$return = objectToArray($return);
		$temp = array();
		if (isset($return['tracks']['items'][0]['id'])) {
			$temp['id'] = $return['tracks']['items'][0]['id'];
			$temp['echo_nest'] = $song['echo_nest_id'];
			array_push($the_money_2, $temp);
		} else {
			;
		}
	}
	echo json_encode($the_money_2,true); 
	exit;
}

?>	