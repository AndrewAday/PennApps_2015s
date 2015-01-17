<?php
//authenticates user for web API
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session('2c2e95538e2d46a19ba2cdd910883947', 'c9b8730873944d44a86a6e7aad79e132', 'http://pennapps.gomurmur.com/spotify_token.php');

$scopes = array(
    'playlist-read-private',
    'user-read-private'
);

$authorizeUrl = $session->getAuthorizeUrl(array(
    'scope' => $scopes
));

header('Location: ' . $authorizeUrl);
die();