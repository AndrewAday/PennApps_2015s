<?php
header('Content-Type: application/json');

if(!isset($_POST['bpm'])) {
	exit('no bpm');
} else {
	
	$bpm = $_POST['bpm'];
	
	require_once '/var/www/pennapps.gomurmur.com/php-echonest-api/lib/EchoNest/Autoloader.php';
	EchoNest_Autoloader::register();
	
	$apiKey = "PCDOMTD1QSYCNESM5"; 
	
	$echonest = new EchoNest_Client();
	$echonest->authenticate($apiKey);
	
	
	//Initiate Artist and Song APIs
	$artistApi = $echonest->getArtistApi();
	$songApi = $echonest->getSongApi();
	
	//$results = $echonest->getArtistApi()->search(array('name' => 'Radiohead'));
	
	$results = $songApi->search(array('max_tempo' => $bpm + 10, 'min_tempo' => $bpm -10, 'results' => 5, 'bucket' => 'song_hotttnesss', 'bucket' => 'song_hotttnesss_rank', 'bucket' => 'id:spotify', 'sort' => 'song_hotttnesss-desc'));
	
	echo json_encode($results);
	exit; 

}

?>	