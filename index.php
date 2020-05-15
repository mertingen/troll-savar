<?php

session_start();

require_once("vendor/autoload.php");

if (empty($_SESSION['access_token'])){
    header("Location: /login.php"); /* Redirect browser */
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Troll Savar</title>
    <!-- Favicon-->
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link type="text/plain" rel="author" href="{{ asset('humans.txt') }}" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/assets/css/themes/all-themes.css" rel="stylesheet" />

    <link href="/assets/css/custom.css" rel="stylesheet">

</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar" id="top-navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ path('keyword-list') }}"><b>TROLL SAVAR</b></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img class="profile-image-url" src="#" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false"></div>
                <a href="#" target="_blank" class="screen-name-url"><div class="screen-name" style="color:cyan"></div></a>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li class="signout"><a href="#"><i class="material-icons">input</i>Çıkış</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <!--<div class="menu">
            <ul class="list">
                <li class="header">Menu</li>
                <li class="active">
                    <a href="{{ path('keyword-list') }}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">format_quote</i>
                        <span>Keyword</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ path('keyword-add') }}">
                                <span>Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ path('keyword-table') }}">
                                <span>Table</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>!-->
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2020 <a href="/index.php">Troll SAVAR</a>
            </div>
            <div class="version">
                <b>Version: </b> 0.0.2
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    </aside>
    <!-- #END# Right Sidebar -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2></h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            İşlemler
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                                <!--<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button class="btn btn-primary btn-lg btn-block waves-effect keywords"
                                            type="button"
                                            data-keywordId="{{ userKeyword.keywordId }}">Hepsini Blockla</button>
                                </div>!-->
                                <div class="row clearfix js-sweetalert" style="margin-left: 5px;">
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                        <button class="btn btn-primary btn-lg btn-block waves-effect" data-type="ajax-spam">Spamla</button>
                                    </div>
                                                                        
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                        <button class="btn btn-primary btn-lg btn-block waves-effect" data-type="ajax-block">Blockla</button>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                        <button class="btn btn-primary btn-lg btn-block waves-effect" data-type="ajax-spam-block">Spamla ve Blockla</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" id="hashtager-list">
          
      </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Hashtags
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix" id="hashtag-list">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="tweets">

     
        </div>


    </div>
</section>

<!-- Jquery Core Js -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="/assets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<script src="/assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="/assets/plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="/assets/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="/assets/js/admin.js"></script>

<!-- Demo Js -->
<script src="/assets/js/demo.js"></script>

<script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>

<script src="/assets/js/admin.js"></script>
<script src="/assets/js/demo.js"></script>
<script type="text/javascript">

  var screen_names = [];

  $(document).ready(function(){

    $(document).on('click','.signout', function() { 

        $.get("/signout.php", function(res,status){
            res = JSON.parse(res);
            window.location.href = "/login.php";
        });
    });

    $.get("/me.php", function(me,status){
        me = JSON.parse(me);
        $(".name").text(me['name']);
        $(".screen-name").text("@" + me['screen_name']);
        $(".screen-name-url").attr("href","https://twitter.com/" + me['screen_name']);
        $(".profile-image-url").attr("src", me['profile_image_url']);
    });

    $.get("/hashtag.php", function(hashtags, status){
          var hashtags = JSON.parse(hashtags);
          for (var i = 0; i < hashtags.length; i++) {
                $("#hashtag-list").append("<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>" +
                                "<button class='btn btn-block btn-lg btn-info waves-effect hashtag'" +
                                       "type='button'" +
                                        "data-keywordId='{{ userKeyword.keywordId }}'>#" + hashtags[i] + "</button>" +
                            "</div>");
          }
          var hashtagerUrl = "/hashtager.php?hashtag=" + hashtags[0];
          $.get(hashtagerUrl, function(hashtagers,status){
            var hashtagers = JSON.parse(hashtagers);
            $('#hashtager-list').empty();
            for (var i = 0; i < hashtagers.length; i++) {
              screen_names.push(hashtagers[i].screen_name);
                $("#hashtager-list").append("<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" +
                  "<div class='card'>" +
                        "<div class='body bg-cyan' style='height:150px;'>" +
                            "<div class='tweet-text'>" + hashtagers[i].text + "</div>" +
                            "<a href='https://twitter.com/" + hashtagers[i].screen_name + "' target='_blank'><img class='tweet-profile-img' src='" + hashtagers[i].profile_image_url + "'></a>" +
                            "<span class='tweet-created-at'>" + hashtagers[i].date + "</span>" +
                            "<a href='https://twitter.com/" + hashtagers[i].screen_name + "' target='_blank'><div class='tweet-username'>@" + hashtagers[i].screen_name + "</div></a>" +
                            "<a href='javascript:void(0);' class='dropdown-toggle tweet-setting' data-toggle='dropdown'>"+
                                "<i class='material-icons'>more_vert</i>"+
                            "</a>" +
                            "<ul class='dropdown-menu tweet-setting pull-right'>"+
                                "<li><a href='https://twitter.com/" + hashtagers[i].screen_name + "/status/" + hashtagers[i].tweet_id_str
                                       + "' target='_blank'>Tweet'e git</a></li>"+
                                "<li><a class='select-user'>Seç</a></li>"+
                                "<li><a class='unselect-user'>Çıkar</a></li>"+
                            "</ul>"+
                        "</div>"+
                    "</div>"+
                "</div>");
            }
          });
      });



      $(document).on('click','.hashtag', function() { 
        var hashtag = $(this).text().replace('#','');
        var hashtagerUrl = "/hashtager.php?hashtag=" + hashtag;
        $.get(hashtagerUrl, function(hashtagers,status){
            var hashtagers = JSON.parse(hashtagers);
            $('#hashtager-list').empty();
            screen_names = [];
            for (var i = 0; i < hashtagers.length; i++) {
              screen_names.push(hashtagers[i].screen_name);
                $("#hashtager-list").append("<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>" +
                  "<div class='card'>" +
                        "<div class='body bg-cyan' style='height:150px;'>" +
                            "<div class='tweet-text'>" + hashtagers[i].text + "</div>" +
                            "<a href='https://twitter.com/" + hashtagers[i].screen_name + "' target='_blank'><img class='tweet-profile-img' src='" + hashtagers[i].profile_image_url + "'></a>" +
                            "<span class='tweet-created-at'>" + hashtagers[i].date + "</span>" +
                            "<a href='https://twitter.com/" + hashtagers[i].screen_name + "' target='_blank'><div class='tweet-username'>@" + hashtagers[i].screen_name + "</div></a>" +
                            "<a href='javascript:void(0);' class='dropdown-toggle tweet-setting' data-toggle='dropdown'>"+
                                "<i class='material-icons'>more_vert</i>"+
                            "</a>" +
                            "<ul class='dropdown-menu tweet-setting pull-right'>"+
                                "<li><a href='https://twitter.com/" + hashtagers[i].screen_name + "/status/" + hashtagers[i].tweet_id_str
                                       + "' target='_blank'>Tweet'e git</a></li>"+
                                "<li><a class='select-user'>Seç</a></li>"+
                                "<li><a class='unselect-user'>Çıkar</a></li>"+
                            "</ul>"+
                        "</div>"+
                    "</div>"+
                "</div>");
            }
        });

      });
  });

    $(document).on('click','.unselect-user', function() {
        var unselected = $(this).closest(".bg-cyan");
        unselected.toggleClass('bg-cyan bg-blue');

        var remove_screen_name = $(this).closest("div").find('.tweet-username').text().replace("@","");
        screen_names = jQuery.grep(screen_names, function(value) {
          return value != remove_screen_name;
        });
        console.log(screen_names);
    });

    $(document).on('click','.select-user', function() {
        var selected = $(this).closest(".bg-blue");
        selected.toggleClass('bg-blue bg-cyan');

        var add_screen_name = $(this).closest("div").find('.tweet-username').text().replace("@","");
        screen_names.indexOf(add_screen_name) === -1 && screen_names.push(add_screen_name);
        console.log(screen_names);
    });

    $(function () {
        $('.js-sweetalert button').on('click', function () {
            var type = $(this).data('type');
            if (type === 'ajax-block') {
                showAjaxBlockMessage();
            } else if (type === 'ajax-spam'){
                showAjaxSpamMessage();  
            } else if (type === 'ajax-spam-block'){
                showAjaxSpamAndBlockMessage();  
            }
        });
    });

    function showAjaxBlockMessage() {
        swal({
            title: "Blocklamak istediğinden emin misin?",
            text: "",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            var blockerUrl = "/blocker.php?screen_names=" + screen_names.toString();
            $.get(blockerUrl, function(blockedUsers,status){
              console.log(blockedUsers);
              swal("Başarılı bir şekilde kurtuldun :)");
            });
        });
    }

    function showAjaxSpamMessage() {
        swal({
            title: "Spam olarak bildirmek istediğinden emin misin?",
            text: "",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            var reporterUrl = "/reporter.php?screen_names=" + screen_names.toString();
            $.get(reporterUrl, function(reportedUsers,status){
              console.log(reportedUsers);
              swal("Başarılı bir şekilde kurtuldun :)");
            });
        });
    }

    function showAjaxSpamAndBlockMessage() {
        swal({
            title: "Spam olarak bildirip, blocklamak istediğinde emin misin?",
            text: "",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            var reporterUrl = "/reporter.php?screen_names=" + screen_names.toString() + "&is_block_perform=1";
            $.get(reporterUrl, function(reportedUsers,status){
              console.log(reportedUsers);
              swal("Başarılı bir şekilde kurtuldun :)");
            });
        });
    }
</script>
</body>

</html>