<?php
include("../config.php");
include("../backend.php");

session_start();

if (!isLoggedIn()) {

  echo("<script>window.close();</script>");
  die();

}

if (!isset($_GET["course"]) && !isset($_POST["course"])) {

  echo("<script>window.close();</script>");
  die();

}

if (isset($_GET["removeaccess"])) {

  $course = $_GET["course"];
  $user = $_GET["user"];

  getConnection()->query("DELETE FROM CourseAccess WHERE User='".$user."' AND Course='".$course."'");

}

if (isset($_POST["giveaccess"])) {

  $course = $_POST["course"];

  $collar = $_POST["collar"];

  $res = getConnection()->query("SELECT UserID FROM Users WHERE CollarNumber='".$collar."'");

  if ($res->num_rows > 0) {

    while ($r=$res->fetch_assoc()) {

      getConnection()->query("INSERT INTO CourseAccess (Course, User) VALUES ('".$course."','".$r["UserID"]."')");

    }

  }

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
                <button type="button" class="close" onclick="window.close();" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Course Access</b></h4>
            </div>
            <div class="modal-body">
                <center>
                  <?php

                  $conn = getConnection();

                  $res = $conn->query("SELECT * FROM CourseAccess WHERE Course='".$_GET["course"]."'");

                  if ($res->num_rows > 0) {

                    while ($r = $res->fetch_assoc()) {

                      echo("[" . getUserDetail($r["User"], "CollarNumber") . "] " . getUserDetail($r["User"], "FirstName") . " " . getUserDetail($r["User"], "LastName") . " - " .
                    '<a href="popup_courseaccess.php?removeaccess&course='.$_GET["course"].'&user='.$r["User"].'">Remove Access</a><br>');

                    }

                  }

                   ?>
                </center>
            </div>
            <div class="modal-footer">

              <form action="popup_courseaccess.php?course=<?php echo($_GET["course"]); ?>" method="post">
                <center>
                  <input type="hidden" name="giveaccess" value="true">
                  <input type="hidden" name="course" value="<?php echo $_GET["course"]; ?>">
                  <label><b>Collar Number</b></label><br>
                  <input class="form-control" name="collar" placeholder="Collar Number"><br>
                  <button type="submit" class="btn btn-primary">Give Access</button>
                </center>
              </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>
</html>
