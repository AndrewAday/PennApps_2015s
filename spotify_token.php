<?php
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session('2c2e95538e2d46a19ba2cdd910883947', 'c9b8730873944d44a86a6e7aad79e132', 'http://pennapps.gomurmur.com/spotify_token.php');

$api = new SpotifyWebAPI\SpotifyWebAPI();

// Request a access token using the code from Spotify
$session->requestToken($_GET['code']);
$accessToken = $session->getAccessToken();

// Set the access token on the API wrapper
$api->setAccessToken($accessToken);
$refreshToken = $session->getRefreshToken();



?>