<?php

session_start();
include("config.php");
include("backend.php");

if (isset($_POST["username"]) && isset($_POST["password"])) {

  login($_POST["username"], $_POST["password"]);

}

 ?>
<html lang="en" class="no-js"><head>

        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:400,700">
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="page-container">
            <h1>Login</h1>
            <img src="https://i.imgur.com/bQZHxoc.png" width="50%">
            <form action="login.php" method="post">
                <input type="text" name="username" class="username" placeholder="Username">
                <input type="password" name="password" class="password" placeholder="Password">
                <button type="submit">Sign me in</button>
                <div class="error"><span>+</span></div>
            </form>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/js/supersized.3.2.7.min.js"></script>
        <script src="assets/js/supersized-init.js"></script>
        <script src="assets/js/scripts.js"></script>

    



<ul id="supersized" class="quality" style="visibility: visible;"><li class="slide-0" style="visibility: visible; opacity: 1;"><a target="_blank"><img src="https://i.imgur.com/DDZwCrK.jpg" style="max-width: 100%, max-height: 100%; width: 1910.71px; left: -472px; top: 0px; height: 1070px;"></a></li><li class="slide-1 prevslide" style="visibility: visible; opacity: 1;"><a target="_blank"><img src="https://i.imgur.com/DDZwCrK.jpg" style="max-width: 100%, max-height: 100%; width: 1910.71px; left: -472px; top: 0px; height: 1070px;"></a></li><li class="slide-2 activeslide" style="visibility: visible; opacity: 1;"><a target="_blank"><img src="https://i.imgur.com/DDZwCrK.jpg" style="max-width: 100%, max-height: 100%; width: 1910.71px; height: 1070px; left: -472px; top: 0px;"></a></li></ul></body></html>
