<?php

include("../config.php");

include("../backend.php");



session_start();



if (!isLoggedIn()) {



  echo("<script>window.close();</script>");

  die();



}

if (getUserDetail($_SESSION["UserID"], "HR") == 1 &&  !in_array(getShortRank(), $tase) && !in_array($_SESSION["UserID"], $bypass)) {

  header("Location: ../index.php");
  die();

}


if (isset($_POST["fn"])) {



  getConnection()->query("INSERT INTO Users (FirstName, LastName, Username, CollarNumber, Division, Controller, ShortRank, JoinDate, Password) VALUES ('".$_POST["fn"]."','".$_POST["ln"]."','".$_POST["fn"][0].$_POST["ln"]."',

  '".$_POST["cn"]."','".$_POST["branch"]."','".$_POST["cad"]."','".$_POST["rank"]."', now(), '".password_hash("changeme", PASSWORD_DEFAULT)."')");



  echo("INSERT INTO Users (FirstName, LastName, Username, CollarNumber, Division, Controller, ShortRank, JoinDate, Password) VALUES ('".$_POST["fn"]."','".$_POST["ln"]."','".$_POST["fn"][0].$_POST["ln"]."',

  '".$_POST["cn"]."','".$_POST["branch"]."','".$_POST["cad"]."','".$_POST["rank"]."', now(), '".password_hash("changeme", PASSWORD_DEFAULT)."')");



  echo("<script>window.opener.location.reload();window.close();</script>");



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

                <h4 class="modal-title"><b>Add a User</b></h4>

            </div>

            <div class="modal-body">

              <form method="post" action="popup_adduser.php">

                <div class="row">

                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

                    <label><b>First Name</b></label><br>

                    <input class="form-control" placeholder="John" name="fn">

                  </div>

                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

                    <label><b>Last Name</b></label><br>

                    <input class="form-control" placeholder="Doe" name="ln">

                  </div>

                </div><br>

                <div class="row">

                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

                    <label><b>Collar Number</b></label><br>

                    <input class="form-control" placeholder="CW 999" name="cn">

                  </div>

                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

                    <label><b>Branch</b></label><br>

                    <select class="form-control" name="branch">

                      <?php

                      foreach ($divisions as $div) {



                        if ($div != "Gold Command") {



                          echo("<option>" . $div . "</option>");



                        }



                      }

                       ?>

                    </select>

                  </div>

                </div><br>

                <label><b>Rank</b></label>

                <select class="form-control" name="rank">

                  <?php



                  foreach ($ranks as $short => $rank) {



                    if ($short == "CC") {



                      continue;



                    }



                    echo("<option value=\"".$short."\">" . $rank . "</option>");



                  }



                   ?>

                </select><br>

                <label><b>CAD Access</b></label>

                <div class="mt-radio-inline">

                    <label class="mt-radio">

                        <input type="radio" name="cad" id="optionsRadios25" value="1" checked=""> Yes

                        <span></span>

                    </label>

                    <label class="mt-radio">

                        <input type="radio" name="cad" id="optionsRadios26" value="0" checked=""> No

                        <span></span>

                    </label>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>

                <button type="submit" class="btn green">Add User</button>

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

  </div>

</body>

</html>

