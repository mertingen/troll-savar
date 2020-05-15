<?php

session_start();
$currentTimeout= ini_get('session.gc_maxlifetime');

// Change session timeout value for a particular page load  - 1 month = ~2678400 seconds
ini_set('session.gc_maxlifetime', 2678400);


require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\Dotenv\Dotenv;

if ($_ENV['IS_DEVELOPMENT']){
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');
}


$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    dd("there is an error!");
}

$connection = new TwitterOAuth($_ENV['CONSUMER_KEY'], $_ENV['CONSUMER_SECRET_KEY'], $request_token['oauth_token'], $request_token['oauth_token_secret']);

$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);

$_SESSION['access_token'] = $access_token['oauth_token'];
$_SESSION['access_token_secret'] = $access_token['oauth_token_secret'];

header("Location: ./login.php"); exit;
