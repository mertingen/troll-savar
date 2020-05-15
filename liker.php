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

	$hashtag = $_GET['hashtag'];
	if (empty($hashtag)){
		dd("you have to send a hashtag bro!");
	}

	$settings = array(
	    'oauth_access_token' => $_SESSION['access_token'],
	    'oauth_access_token_secret' => $_SESSION['access_token_secret'],
	    'consumer_key' => $_ENV['CONSUMER_KEY'],
	    'consumer_secret' => $_ENV['CONSUMER_SECRET_KEY']
	);

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q=#' . $hashtag . "&count=95&result_type=recent";
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$response= $twitter->setGetfield($getfield)
	    ->buildOauth($url, $requestMethod)
	    ->performRequest();
	$response = json_decode($response);

	$tweets = [];
	foreach ($response->statuses as $key => $value) {
		if (!$value->retweeted_status){
			$tweets[$key]['id'] = $value->id_str;
		}
	}

	if (!empty($tweets)){
		foreach ($tweets as $id) {
			sleep ( rand (1, 2));
			$url = 'https://api.twitter.com/1.1/favorites/create.json';
			$postfields = array(
			    'id' => $id['id']
			);
			$requestMethod = 'POST';
			$twitter = new TwitterAPIExchange($settings);
			$response= $twitter->setPostfields($postfields)
			    ->buildOauth($url, $requestMethod)
			    ->performRequest();
			$response = json_decode($response);
		}

		echo json_encode(array('success!'));
		 
	} else{
		echo json_encode(array('tweets are not found!'));
	}


} catch(\Exception $e){
	dd($e->getMessage());
}
?>