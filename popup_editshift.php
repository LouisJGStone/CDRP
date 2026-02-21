<?php

include("config.php");

include("backend.php");



session_start();



if (!isLoggedIn()) {



  echo("<script>window.close();</script>");



}



if (isset($_POST["day"])) {



  $day = $_POST["day"];

  $type = $_POST["type"];



  $conn = getConnection();

  $conn->query("DELETE FROM Duties WHERE Day='".$day."' AND UserID='".$_SESSION["UserID"]."'");



  if ($type == "Operational") {



    $conn = getConnection();

    $conn->query("INSERT INTO Duties (Day, UserID, Callsign, Role, Vehicle) VALUES

    ('".$day."','".$_SESSION["UserID"]."','UNASSIGNED','UNASSIGNED','UNASSIGNED')");



  }



  if ($type == "Civilian") {



    $conn = getConnection();

    $conn->query("INSERT INTO Duties (Day, UserID, Callsign, Role, Vehicle) VALUES

    ('".$day."','".$_SESSION["UserID"]."','','Civilian','')");



  }



  if ($type == "Control Room") {



    $conn = getConnection();

    $conn->query("INSERT INTO Duties (Day, UserID, Callsign, Role, Vehicle) VALUES

    ('".$day."','".$_SESSION["UserID"]."','Control Room','UNASSIGNED','CCC')");



  }



  echo("<script>window.opener.location.reload();</script>");



}



if (!isset($_GET["day"])) {



  echo("<script>window.close();</script>");



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

                <h4 class="modal-title">Edit Duty</h4>

            </div>

            <div class="modal-body">

              <form action="popup_editshift.php" method="post">

                <input type="hidden" name="day" value="<?php echo $_GET["day"]; ?>">

                <select class="form-control" name="type">

                  <?php



                  if (!isDayFull($_GET["day"])) {



                    echo '

                    <option>Operational</option>

                    <option>Civilian</option>

                    ';



                  }



                   ?>

                  <option>Control Room</option>

                  <option>Cancel Duty</option>

                </select>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>

                <button type="submit" class="btn green">Edit Duty</button></form>

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

  </div>

</body>

</html>

