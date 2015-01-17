<?php
ini_set("display_errors", true);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require 'parser.php';
require 'echonest_types.php';

echo 'dance: ';
echo $min_danceability . '<br/>';
echo 'energy: ';
echo $min_energy . '<br/>';
echo 'liveness: ';
echo $min_liveness . '<br/>';
echo 'speech: ';
echo $min_speechiness . '<br/>';

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
	
	require_once '/var/www/pennapps.gomurmur.com/php-echonest-api/lib/EchoNest/Autoloader.php';
	EchoNest_Autoloader::register();
	
	$apiKey = "PCDOMTD1QSYCNESM5"; 
	
	$echonest = new EchoNest_Client();
	$echonest->authenticate($apiKey);
	
	
	//Initiate Artist and Song APIs
	$artistApi = $echonest->getArtistApi();
	$songApi = $echonest->getSongApi();
	$trackApi = $echonest->getTrackApi();
	
	//$results = $echonest->getArtistApi()->search(array('name' => 'Radiohead'));
	$bpm = (mt_rand()/mt_getrandmax()) * 260;
	if ($bpm > 260) {
		$bpm = 260;
	} else if ($bpm < 40) {
		$bpm = 40;
	} else {
		;  
	}
	echo 'bpm: ';
	echo $bpm . '<br/>';

	/*
$results = file_get_contents('http://developer.echonest.com/api/v4/song/search?api_key=PCDOMTD1QSYCNESM5&format=json&max_tempo=' . 
	$bpm + 20 . '&min_tempo=' . $bpm - 20 . '&sort=artist_hotttnesss-desc&bucket=audio_summary');
	
*/	
	$bpm_max = $bpm + 10;
	$bpm_min = $bpm - 10;
	$query = "http://developer.echonest.com/api/v4/song/search?api_key=PCDOMTD1QSYCNESM5&format=json&max_tempo=$bpm_max&min_tempo=$bpm_min&sort=song_hotttnesss-desc&bucket=audio_summary&song_type=live:false&results=8";
	$results = file_get_contents($query);
	$the_money = array();
	$results = json_decode($results,true);
	print_r($results['response']['songs']);
	
	foreach($results['response']['songs'] as $song) {
		$temp = array();
		$temp['title'] = $song['title'];
		$temp['artist_name'] = $song['artist_name'];
		$temp['echo_nest_id'] = $song['id']; 
		array_push($the_money, $temp);
	}
			echo '<br/>';
					echo '<br/>';
			echo 'echonest array';
					echo '<br/>';	
	print_r(json_encode($the_money, true));
	
	$the_money_2 = array();  
			echo '<br/>';
				print_r(json_encode($the_money));
					echo '<br/>';
			echo 'spotify array';

	foreach($the_money as $song) {
		$return = $api->search($song['artist_name'] . ' ' . $song['title'], 'track', array('limit' => 1, 'market' => 'us'));
		echo '<br/>';
		echo '<br/>';
				echo '<br/>';
		print_r(json_encode($return));
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

		echo '<br/>';
				echo '<br/>';
						echo '<br/>';
								echo '<br/>';
										echo '<br/>';
										

	print_r(json_encode($the_money_2,true));
					echo '<br/> ' . 'count: ';
					echo count($the_money_2);

/*echo '<br/>';
echo '<br/>';


$id = 'SOAJKLS144C3CB7CB2';
$result = file_get_contents('http://developer.echonest.com/api/v4/song/profile?api_key=PCDOMTD1QSYCNESM5&format=json&id=' .$id. '&bucket=audio_summary');
$result = json_decode($result, true);
print_r($result['response']['songs'][0]['artist_name']);
*/
//$result = file_get_contents('http://developer.echonest.com/api/v4/song/profile?api_key=PCDOMTD1QSYCNESM5&id=$id&bucket=audio_summary');
/* var_dump(json_decode($result, true)); */

	

	/*
foreach ($the_money_2 as $doc) {
			$doc = objectToArray($doc); 
			print_r($doc['tracks']['items'][0]['id']);
			echo '<br/>';
	}	
*/




//}

?>	