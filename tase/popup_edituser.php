<?php

include("../config.php");

include("../backend.php");



session_start();



if (!isLoggedIn()) {



  echo("<script>window.close();</script>");

  die();



}

if (!in_array(getShortRank(), $tase) && !in_array($_SESSION["UserID"], $bypass)) {



  header("Location: ../index.php");

  die();



}

if (!isset($_GET["user"]) && !isset($_POST["user"])) {



  echo("<script>window.close();</script>");

  die();



}


if (isset($_POST["user"])) {



  $user = $_POST["user"];

  $rank = $_POST["rank"];

  $steam = $_POST["steam"];

  $branch = $_POST["branch"];

  $collar = $_POST["collar"];

  $note = str_replace("'", "\'", $_POST["note"]);



  getConnection()->query("UPDATE Users SET ShortRank='".$rank."' WHERE UserID='".$user."'");

  getConnection()->query("UPDATE Users SET SteamID='".$steam."' WHERE UserID='".$user."'");

  getConnection()->query("UPDATE Users SET Division='".$branch."' WHERE UserID='".$user."'");

  getConnection()->query("UPDATE Users SET CollarNumber='".$collar."' WHERE UserID='".$user."'");

  getConnection()->query("UPDATE Users SET Note='".$note."' WHERE UserID='".$user."'");

  getConnection()->query("UPDATE Users SET EditUser='".getUserDetail($_SESSION["UserID"], "ShortRank")." ".getUserDetail($_SESSION["UserID"], "LastName")."' WHERE UserID='".$user."'");





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

                <h4 class="modal-title"><b>Edit Account</b> - <?php echo(getUserDetail($_GET["user"], "FirstName")); ?> <?php echo(getUserDetail($_GET["user"], "LastName")); ?></h4>

            </div>

            <div class="modal-body">

              <form method="post" action="popup_edituser.php">

                <input type="hidden" name="user" value="<?php echo $_GET["user"]; ?>">

                <label><b>Collar Number</b></label><br>

                <input class="form-control" name="collar" onclick="this.select();" value="<?php echo(getUserDetail($_GET["user"], "CollarNumber")); ?>"><br>

                <label><b>Rank</b></label><br>

                <select name="rank" class="form-control">

                  <?php



                  foreach ($ranks as $short => $full) {



                    if ($short == "CC") {

                      continue;

                    }



                    if (getUserDetail($_GET["user"], "ShortRank") == $short) {



                      echo("<option value=\"".$short."\" selected>" . $full . " (CURRENT)</option>");



                    } else {



                      echo("<option value=\"".$short."\">" . $full . "</option>");



                    }



                  }



                   ?>

                </select><br>

                <label><b>Branch</b></label><br>

                <select name="branch" class="form-control">

                  <?php



                  foreach ($divisions as $division) {



                    if (getUserDetail($_GET["user"], "Division") == $division) {



                      echo("<option value=\"".$division."\" selected>" . $division . " (CURRENT)</option>");



                    } else {



                      echo("<option value=\"".$division."\">" . $division . "</option>");



                    }



                  }



                   ?>

                </select><br>

                <label><b>Steam ID</b></label><br>

                <input name="steam" class="form-control" value="<?php echo getUserDetail($_GET["user"], "SteamID");  ?>"><br>

                <label><b>Note</b></label><br>

                <textarea class="form-control" name="note" onclick="this.select();" rows="3"><?php echo getUserDetail($_GET["user"], "Note"); ?></textarea>



            </div>

            <div class="modal-footer">

                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>

                <button type="submit" class="btn green">Edit User</button></form>

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

  </div>

</body>

</html>

