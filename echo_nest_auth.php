<?php

require_once '/var/www/pennapps.gomurmur.com/php-echonest-api/lib/EchoNest/Autoloader.php';
	EchoNest_Autoloader::register();
	
	$apiKey = "PCDOMTD1QSYCNESM5"; 
	
	$echonest = new EchoNest_Client();
	$echonest->authenticate($apiKey);
	
	
	//Initiate Artist and Song APIs
	$artistApi = $echonest->getArtistApi();
	$songApi = $echonest->getSongApi();
	$trackApi = $echonest->getTrackApi();

?>