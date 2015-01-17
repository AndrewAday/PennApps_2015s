<?php

ini_set("display_errors", true);
error_reporting(E_ALL);

require_once '/var/www/pennapps.gomurmur.com/php-echonest-api/lib/EchoNest/Autoloader.php';
EchoNest_Autoloader::register();

$apiKey = "PCDOMTD1QSYCNESM5"; 

$echonest = new EchoNest_Client();
$echonest->authenticate($apiKey);


//Initiate Artist and Song APIs
$artistApi = $echonest->getArtistApi();
$songApi = $echonest->getSongApi();
$trackApi = $echonest->getTrackApi();

$results = $echonest->getArtistApi()->search(array('name' => 'Radiohead'));
print_r(json_encode($results));


echo '<br/>';
$bpm = 110; 
$results = $songApi->search(array('max_tempo' => $bpm + 10, 'min_tempo' => $bpm -10, 'results' => 5, 'bucket' => 'song_hotttnesss', 'bucket' => 'song_hotttnesss_rank', 'bucket' => 'tracks', 'bucket' => 'id:spotify', 'sort' => 'song_hotttnesss-desc'));


/*
foreach($results as $song) {
	print_r(json_encode($song));
		echo '<br/>';
	echo $song['id'];
	echo(json_encode($trackApi->profile(array('id' => 'SOAJKLS144C3CB7CB2'))));
	echo '<br/>';
}
*/

	
echo json_encode($results);







?>