<?php
//STUFF FOR API CALLS
require_once('parser.php');

function random() {
	return (mt_rand()/mt_getrandmax()) * .7;
}

//&song_type=acoustic:false
$song_type = array('christmas','live','studio','acoustic','electric'); 

/*
$song_styles = json_decode(file_get_contents('http://developer.echonest.com/api/v4/artist/list_terms?api_key=PCDOMTD1QSYCNESM5&format=json&type=style'),true);
$song_styles = $song_styles['response']['terms'];
*/

/*
$song_moods = json_decode(file_get_contents('http://developer.echonest.com/api/v4/artist/list_terms?api_key=PCDOMTD1QSYCNESM5&format=json&type=mood'),true);
$song_moods = $song_moods['response']['terms'];
*/

$min_danceability = random();
$min_energy = random();
$min_liveness = random();
$min_speechiness = random();












?>