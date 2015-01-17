<?php
ini_set("display_errors", true);
error_reporting(E_ALL);
require 'vendor/autoload.php';

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

$track = $api->search('phoenix chloroform', 'track', array('limit' => 1));

print_r(json_encode($track));

?> 