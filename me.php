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
	
	$url = 'https://api.twitter.com/1.1/account/verify_credentials.json';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$res= $twitter->buildOauth($url, $requestMethod)
	    ->performRequest();

	$res = json_decode($res);

	$me = array(
		'screen_name' => $res->screen_name,
		'name' => $res->name,
		'profile_image_url' => str_replace('normal', 'bigger', $res->profile_image_url)
	);

	$mongo = new MongoDB\Driver\Manager($_ENV['MONGODB_URL']);


	$filter      = ['screen_name' => $me['screen_name']];
	$options = [];

	$query = new \MongoDB\Driver\Query($filter, $options);
	$rows   = $mongo->executeQuery('twitter.member', $query);

	$isData = [];
	foreach ($rows as $document) {
		$isData[] = $document;
	}
	if (count($isData) < 1){
	    $bulk = new MongoDB\Driver\BulkWrite;

	    $doc = array(
	        'id'      => new MongoDB\BSON\ObjectID,     #Generate MongoID
	        'access_token'    => $_SESSION['access_token'],
	        'access_token_secret'     => $_SESSION['access_token_secret'],
	        'screen_name' => $me['screen_name']
	    );

	    $bulk->insert($doc);
	    $res = $mongo->executeBulkWrite('twitter.member', $bulk);
	}

	echo json_encode($me);

}catch(\Exception $e){
	dd($e->getMessage());
}
