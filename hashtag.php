<?php

session_start();

require_once("vendor/autoload.php");
use Symfony\Component\Dotenv\Dotenv;

if ($_ENV['IS_DEVELOPMENT']){
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');
}

if (empty($_SESSION['access_token'])){
	echo json_encode('You have to be auth on app.'); exit;
}

try{

	$settings = array(
	    'oauth_access_token' => $_SESSION['access_token'],
	    'oauth_access_token_secret' => $_SESSION['access_token_secret'],
	    'consumer_key' => $_ENV['CONSUMER_KEY'],
	    'consumer_secret' => $_ENV['CONSUMER_SECRET_KEY']
	);
	
	$url = 'https://api.twitter.com/1.1/trends/place.json';
	$getfield = '?id=23424969';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$res= $twitter->setGetfield($getfield)
	    ->buildOauth($url, $requestMethod)
	    ->performRequest();

	$res = json_decode($res);

	$trends = [];
	$counter = 0;
	foreach ($res[0]->trends as $trend) {
		$counter++;
		if ($counter>7){
			break;
		}
		$trends[] = str_replace('#', '', $trend->name);
	}

	echo json_encode($trends);

}catch(\Exception $e){
	dd($e->getMessage());
}
