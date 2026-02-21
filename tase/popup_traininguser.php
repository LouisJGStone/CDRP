<?php
include("../config.php");
include("../backend.php");

session_start();

if (!isLoggedIn()) {

  echo("<script>window.close();</script>");
  die();

}

if (!isset($_GET["user"]) && !isset($_POST["user"])) {

  echo("<script>window.close();</script>");
  die();

}

if (isset($_POST["user"])) {

  $user = $_POST["user"];
  $CarrierTrained = isset($_POST["CarrierTrained"]) ? 1 : 0;
  $UnmarkedTrained = isset($_POST["UnmarkedTrained"]) ? 1 : 0;
  $FirearmsLevel = $_POST["FirearmsLevel"];
  $DriverLevel = $_POST["DriverLevel"];
  $TaserTrained = isset($_POST["TaserTrained"]) ? 1 : 0;

  getConnection()->query("UPDATE Users SET CarrierTrained='".$CarrierTrained."' WHERE UserID='".$user."'");
  getConnection()->query("UPDATE Users SET UnmarkedTrained='".$UnmarkedTrained."' WHERE UserID='".$user."'");
  getConnection()->query("UPDATE Users SET FirearmsLevel='".$FirearmsLevel."' WHERE UserID='".$user."'");
  getConnection()->query("UPDATE Users SET DriverLevel='".$DriverLevel."' WHERE UserID='".$user."'");
  getConnection()->query("UPDATE Users SET TaserTrained='".$TaserTrained."' WHERE UserID='".$user."'");

  echo("UPDATE Users SET DriverLevel='".$DriverLevel."' WHERE UserID='".$user."'");

  echo('<script>window.opener.location.reload();window.close();</script>');

  die();

}

?>

<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $settings["clanName"]; ?> | FMS</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Alex Colville" name="author">
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css">
  <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css">
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="../assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color">
  <link href="../assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css">
  <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
  <div class="modal fade in" id="full" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 15px;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Edit Permissions</b> - <?php echo(getUserDetail($_GET["user"], "FirstName")); ?> <?php echo(getUserDetail($_GET["user"], "LastName")); ?></h4>
            </div>
            <div class="modal-body">
              <form method="post" action="popup_traininguser.php">
                <input type="hidden" name="user" value="<?php echo $_GET["user"]; ?>">
                <label class="mt-checkbox">
                  <input type="checkbox" name="TaserTrained" <?php if (getUserDetail($_GET["user"], "TaserTrained") == 1) { echo("checked");} ?>> Taser Trained
                  <span></span>
                </label><br>
                <select name="DriverLevel" class="form-control">
                  <?php

                  $level = getUserDetail($_GET["user"], "DriverLevel");

                  if ($level == 4) {

                    echo("<option value=\"4\" selected>Level 4 (CURRENT)</option>");

                  } else {

                    echo("<option value=\"4\">Level 4</option>");

                  }

                  if ($level == 3) {

                    echo("<option value=\"3\" selected>Level 3 (CURRENT)</option>");

                  } else {

                    echo("<option value=\"3\">Level 3</option>");

                  }

                  if ($level == 2) {

                    echo("<option value=\"2\" selected>Level 2 (CURRENT)</option>");

                  } else {

                    echo("<option value=\"2\">Level 2</option>");

                  }

                  if ($level == 1) {

                    echo("<option value=\"1\" selected>Level 1 (CURRENT)</option>");

                  } else {

                    echo("<option value=\"1\">Level 1</option>");

                  }

                   ?>
                </select>
                <br>
                <select class="form-control" name="FirearmsLevel">
                  <?php

                  $level = getUserDetail($_GET["user"], "FirearmsLevel");

                  if ($level == "N/A") {

                    echo("<option selected>N/A (CURRENT)</option>");

                  } else {

                    echo("<option>N/A</option>");

                  }

                  if ($level == "TFO") {

                    echo("<option selected>TFO (CURRENT)</option>");

                  } else {

                    echo("<option>TFO</option>");

                  }

                  if ($level == "AFO") {

                    echo("<option selected>AFO (CURRENT)</option>");

                  } else {

                    echo("<option>AFO</option>");

                  }

                  if ($level == "CTSFO") {

                    echo("<option selected>CTSFO (CURRENT)</option>");

                  } else {

                    echo("<option>CTSFO</option>");

                  }

                   ?>
                </select>
                <br>
                <label class="mt-checkbox">
                  <input type="checkbox" name="CarrierTrained" <?php if (getUserDetail($_GET["user"], "CarrierTrained") == 1) { echo("checked");} ?>> Carrier Trained
                  <span></span>
                </label><br>
                <label class="mt-checkbox">
                  <input type="checkbox" name="UnmarkedTrained" <?php if (getUserDetail($_GET["user"], "UnmarkedTrained") == 1) { echo("checked");} ?>> Unmarked Trained
                  <span></span>
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>
                <button type="submit" class="btn green">Edit Training</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>
</html>
