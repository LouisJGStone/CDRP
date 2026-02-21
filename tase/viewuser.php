<?php

include("../config.php");
include("../backend.php");
session_start();

if (isset($_GET["resetpassword"])) {
  getConnection()->query("UPDATE Users SET ChangedPass='0' WHERE UserID=". $_SESSION["UserID"]);
  getConnection()->query("UPDATE Users SET Password='".password_hash("changeme", PASSWORD_DEFAULT)."' WHERE UserID='".$_GET["user"]."'");
  header("Location: users.php?removed");
}
if (!in_array(getShortRank(), $tase) && !in_array($_SESSION["UserID"], $bypass)) {

  header("Location: ../index.php");
  die();

}

if (!isLoggedIn()) {

  header("Location: ../login.php");
  die();

}

if (!isset($_GET["user"]) && !isset($_POST["removeuser"])) {

  header("Location: users.php");
  die();

}

if (isset($_POST["removeuser"])) {

  getConnection()->query("DELETE FROM Users WHERE UserID='".$_POST["uid"]."'");
  header("Location: users.php");
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

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">

                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <?php include("side.php") ?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content" style="min-height: 1147px;">

                  <div class="page-head">
                    <div class="page-title">
                        <h1>TASE
                            <small>The All Seeing Eye</small>
                        </h1>
                    </div>
                  </div>

                  <div class="portlet light">
                    <div class="portlet-title">
                      <div class="caption">
                        <span class="caption-subject bold uppercase"><?php echo getUserDetail($_GET["user"], "FirstName"); ?> <?php echo getUserDetail($_GET["user"], "LastName"); ?> [ID: <?php echo getUserDetail($_GET["user"], "UserID"); ?>]</span>
                      </div>
                      <div class="actions">
                        <form action="viewuser.php" method="post">
                          <input type="hidden" name="removeuser" value="true">
                          <input type="hidden" name="uid" value="<?php echo $_GET["user"]; ?>">
                          <button type="submit" class="btn btn-xs btn-default"><i class="fa fa-times"></i> REMOVE USER</button>
                        </form>
                      </div>
                    </div>
                    <div class="portlet-body">
                      <div class="tabbable-line">
                          <ul class="nav nav-tabs ">
                              <li class="active">
                                  <a href="#tab_15_1" data-toggle="tab" aria-expanded="true"> Overview </a>
                              </li>
                              <li class="">
                                  <a href="#tab_15_2" data-toggle="tab" aria-expanded="false"> Permissions </a>
                              </li>
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane active" id="tab_15_1">
                                <h4><strong>Account Overview</strong></h4>
                                <b>Status: </b><?php echo getUserDetail($_GET["user"], "Status"); ?><br>
                                <b>Created: </b><?php echo getUserDetail($_GET["user"], "JoinDate"); ?><br>
                                <b>Last Edited: </b><?php echo getUserDetail($_GET["user"], "EditTime"); ?><br>
                                <b>Last Edited By: </b><?php echo getUserDetail($_GET["user"], "EditUser"); ?><br>
                                <b>Note: </b><?php echo getUserDetail($_GET["user"], "Note"); ?><br>
                                <b>SteamID: </b><?php echo getUserDetail($_GET["user"], "SteamID"); ?><br><br>
                                <h4><strong>Officer Information</strong></h4>
                                <b>Collar Number: </b><?php echo getUserDetail($_GET["user"], "CollarNumber"); ?><br>
                                <b>Rank: </b><?php echo $ranks[getUserDetail($_GET["user"], "ShortRank")]; ?> (<?php echo getUserDetail($_GET["user"], "ShortRank"); ?>)<br>
                                <b>Branch: </b><?php echo getUserDetail($_GET["user"], "Division"); ?><br><br>
                                <a href="javascript:edit()" class="btn uppercase yellow-gold">Edit Account</a>
                              </div>
                              <div class="tab-pane" id="tab_15_2">
                                <h4><strong>Permissions</strong></h4>
                                <b>Controller: </b><?php echo getUserDetail($_GET["user"], "Controller"); ?><br>
                                <b>Human Resources: </b><?php echo getUserDetail($_GET["user"], "HR"); ?><br><br>
                                <a href="javascript:perms()" class="btn uppercase yellow-gold">Edit Permissions</a>
                              </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->


        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-W276BJ"></script><script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            });

            function edit() {

              var url = "popup_edituser.php?user=<?php echo $_GET["user"] ?>";
              var w = 600;
              var h = 600;
              var left = Number((screen.width/2)-(w/2));
              var tops = Number((screen.height/2)-(h/2));
              window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

            }

            function training() {

              var url = "popup_traininguser.php?user=<?php echo $_GET["user"] ?>";
              var w = 600;
              var h = 600;
              var left = Number((screen.width/2)-(w/2));
              var tops = Number((screen.height/2)-(h/2));
              window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

            }

            function perms() {

              var url = "popup_editperms.php?user=<?php echo $_GET["user"] ?>";
              var w = 300;
              var h = 300;
              var left = Number((screen.width/2)-(w/2));
              var tops = Number((screen.height/2)-(h/2));
              window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

            }
        </script>
    <!-- Google Code for Universal Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- End -->

<!-- Google Tag Manager -->
<noscript>&lt;iframe src="//www.googletagmanager.com/ns.html?id=GTM-W276BJ"
height="0" width="0" style="display:none;visibility:hidden"&gt;&lt;/iframe&gt;</noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W276BJ');</script>
<!-- End -->



</body>

</html>
