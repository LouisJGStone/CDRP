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

if (isset($_POST["name"])) {

  $course = $_POST["course"];

  $name = $_POST["name"];
  $link = $_POST["link"];

  getConnection()->query("UPDATE Courses SET Name='".$name."' AND Link='".$link."' WHERE ID='".$course."'");

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
                <h4 class="modal-title"><b>Edit Course</b></h4>
            </div>
            <div class="modal-body">
              <form method="post" action="popup_editcourse.php">
                <input type="hidden" value="<?php echo($_GET["course"]); ?>" name="course">
                <label><b>Name</b></label><br>
                <input class="form-control" onclick="this.select();" value="<?php echo(getMembersDetail($_GET["course"], "Courses", "Name")); ?>" name="name"><br>
                <label><b>Link</b></label><br>
                <input class="form-control" onclick="this.select();" value="<?php echo(getMembersDetail($_GET["course"], "Courses", "Link")); ?>" name="link"><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>
                <button type="submit" class="btn green">Edit Course</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>
</html>
