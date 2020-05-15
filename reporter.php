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

try {

	$screenNames = $_GET['screen_names'];
	$isBlockPerform = $_GET['is_block_perform'];
	if (empty($screenNames)){
		dd("you have to send a screen name bro!");
	}
	if (empty($isBlockPerform)){
		$isBlockPerform = '0';
	}

	$screenNames = explode(',', $screenNames);

	$settings = array(
	    'oauth_access_token' => $_SESSION['access_token'],
	    'oauth_access_token_secret' => $_SESSION['access_token_secret'],
	    'consumer_key' => $_ENV['CONSUMER_KEY'],
	    'consumer_secret' => $_ENV['CONSUMER_SECRET_KEY']
	);

	/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
	$url = 'https://api.twitter.com/1.1/users/report_spam.json';
	$requestMethod = 'POST';

	foreach ($screenNames as $screenName) {
		$postfields = array(
		    'screen_name' => $screenName, 
		    'perform_block' => $isBlockPerform
		);

		/** Perform a POST request and echo the response **/
		$twitter = new TwitterAPIExchange($settings);
		$blockedUser = $twitter->buildOauth($url, $requestMethod)
		             ->setPostfields($postfields)
		             ->performRequest();
		
	}

	echo json_encode(array("success!"));



} catch (\Exception $e){
	dd($e->getMessage());
}