<?php

session_start();

if (!empty($_SESSION['access_token'])) {
	header("Location: ./index.php");
}


require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\Dotenv\Dotenv;

if ($_ENV['IS_DEVELOPMENT']){
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');
}


$connection = new TwitterOAuth($_ENV['CONSUMER_KEY'], $_ENV['CONSUMER_SECRET_KEY']);

$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $_ENV['CALLBACK_URL']));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Troll Savar</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Waves Effect Css -->
    <link href="/assets/plugins/node-waves/waves.css" rel="stylesheet" type="text/css">

    <!-- Animation Css -->
    <link href="/assets/plugins/animate-css/animate.css" rel="stylesheet" type="text/css">

    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">

    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="login-page">
<div class="login-box">
    <div class="logo"><a href="javascript:void(0);"><img src="/assets/images/trollsavar.png" height="55px" width="55px">Troll<b>SAVAR</b></a>
        <small></small>
    </div>
    <div class="card">
        <div class="body">
            <div class="msg">Oturum başlatmak için giriş yapın</div>
            <div class="social-wrap a">
                <button id="twitter" style="margin-left: 55px; font-weight: bold">Sign in with Twitter</button>
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="/assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>

<!-- Bootstrap Core Js -->
<script src="/assets/plugins/bootstrap/js/bootstrap.js" type="text/javascript"></script>

<!-- Waves Effect Plugin Js -->
<script src="/assets/plugins/node-waves/waves.js" type="text/javascript"></script>

<!-- Custom Js -->
<script src="/assets/js/admin.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
       $('#twitter').click(function(event){
           window.location.href = "<?php echo $url; ?>";
       }) ;
    });
</script>
</body>

</html>
