<?php

session_start();

require_once("vendor/autoload.php");

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
	$getfield = '?q=#' . $hashtag . "&count=21";
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$response= $twitter->setGetfield($getfield)
	    ->buildOauth($url, $requestMethod)
	    ->performRequest();
	$response = json_decode($response);

	$hashtager = [];
	#dd($response->statuses);
	foreach ($response->statuses as $key => $value) {
		$hashtager[$key]['name'] = $value->user->name;
		$hashtager[$key]['screen_name'] = $value->user->screen_name;
		$hashtager[$key]['profile_image_url'] = str_replace('normal', 'bigger', $value->user->profile_image_url);
		$hashtager[$key]['text'] = $value->text;
		$hashtager[$key]['tweet_id_str'] = $value->id_str;
		$hashtager[$key]['date'] = date('Y-m-d H:i', strtotime($value->created_at));
	}

	echo json_encode($hashtager);


} catch(\Exception $e){
	dd($e->getMessage());
}
?>