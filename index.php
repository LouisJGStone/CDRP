<?php

include("backend.php");

session_start();

if (isset($_GET["password"])) {

  if (isset($_POST["pswd"])) {

    $pswd = $_POST["pswd"];

    getConnection()->query("UPDATE Users SET Password='".password_hash($pswd, PASSWORD_DEFAULT)."' WHERE UserID=" . $_SESSION["UserID"]);

  }

  if (isset($_POST["pswdForce"])) {

    $pswd = $_POST["pswdForce"];

    getConnection()->query("UPDATE Users SET ChangedPass='1' WHERE UserID=". $_SESSION["UserID"]);
    getConnection()->query("UPDATE Users SET Password='".password_hash($pswd, PASSWORD_DEFAULT)."' WHERE UserID=" . $_SESSION["UserID"]);

  }


}

if (isset($_GET["logout"])) {

  unset($_SESSION);
  session_destroy();

}

if (isLoggedIn()) {

  header("Location: main.php");

} else {

  header("Location: login.php");

}

 ?>
