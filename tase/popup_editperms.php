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
  $cad = isset($_POST["cad"]) ? 1 : 0;
  $hr = isset($_POST["hr"]) ? 1 : 0;

  getConnection()->query("UPDATE Users SET Controller='".$cad."' WHERE UserID='".$user."'");
  getConnection()->query("UPDATE Users SET HR='".$hr."' WHERE UserID='".$user."'");

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
              <form method="post" action="popup_editperms.php">
                <input type="hidden" name="user" value="<?php echo $_GET["user"]; ?>">
                <label class="mt-checkbox">
                  <input type="checkbox" name="cad" <?php if (getUserDetail($_GET["user"], "Controller") == 1) { echo("checked");} ?>> CAD Access
                  <span></span>
                </label><br>
                <label class="mt-checkbox">
                  <input type="checkbox" name="hr" <?php if (getUserDetail($_GET["user"], "HR") == 1) { echo("checked");} ?>> Human Resources
                  <span></span>
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>
                <button type="submit" class="btn green">Edit Permissions</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>
</html>
