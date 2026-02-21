<?php

include("../config.php");
include("../backend.php");
session_start();

if (!in_array(getShortRank(), $tase) && !in_array(getShortRank(), $babyTase) && !in_array($_SESSION["UserID"], $bypass)) {

  header("Location: ../index.php");
  die();

}

if (!isLoggedIn()) {

  header("Location: ../login.php");
  die();

}

if (!isset($_GET["day"])) {

  $_GET["day"] = date("N") - 1;

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
                        <span class="caption-subject bold uppercase">DUTIES</span>
                        <span class="caption-helper">hmm, S1 or S2?</span>
                      </div>
                    </div>
                    <div class="portlet-body">
                      <center>
                        <a class="btn default" href="duties.php?day=0">MONDAY</a>
                        <a class="btn default" href="duties.php?day=1">TUESDAY</a>
                        <a class="btn default" href="duties.php?day=2">WEDNESDAY</a>
                        <a class="btn default" href="duties.php?day=3">THURSDAY</a>
                        <a class="btn default" href="duties.php?day=4">FRIDAY</a>
                        <a class="btn default" href="duties.php?day=5">SATURDAY</a>
                        <a class="btn default" href="duties.php?day=6">SUNDAY</a>
                      </center>
                      <br>
                      <table class="table table-advanced table-hover table-striped table-bordered">
                        <thead>
                          <th>Callsign</th>
                          <th>Member</th>
                          <th>Division</th>
                          <th>Role</th>
                          <th>Vehicle</th>
                          <th>Actions</th>
                        </thead>
                        <tbody>
                          <center><h4><b>Emergency Service</b></h4></center>
                          <tr><td colspan="6"><center><b>Emergency Responce Team</b></center></td></tr>
                          <?php

                          $conn = getConnection();

                          $day = $_GET["day"];

                          $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='ERT' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.$r["Callsign"].'</td><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Division"].'</td>
                                <td>'.$r["Role"].'</td><td>'.$r["Vehicle"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                           ?>
                    <td colspan="6"><center><b>Specialist Firearms Command</b></center></td></tr>
                          <?php

                          $conn = getConnection();

                          $day = $_GET["day"];

                          $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='SFC' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.$r["Callsign"].'</td><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Division"].'</td>
                                <td>'.$r["Role"].'</td><td>'.$r["Vehicle"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                           ?>
                       <td colspan="6"><center><b>Roads Transport Policing Command</b></center></td></tr>
                          <?php

                          $conn = getConnection();

                          $day = $_GET["day"];

                          $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='RTPC' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.$r["Callsign"].'</td><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Division"].'</td>
                                <td>'.$r["Role"].'</td><td>'.$r["Vehicle"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                           ?>
                       <td colspan="6"><center><b>Senior Command</b></center></td></tr>
                          <?php

                          $conn = getConnection();

                          $day = $_GET["day"];

                          $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='Gold Command' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.$r["Callsign"].'</td><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Division"].'</td>
                                <td>'.$r["Role"].'</td><td>'.$r["Vehicle"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                           ?>
                           <td colspan="6"><center><b>Duty Command</b></center></td></tr>
                          <?php

                          $conn = getConnection();

                          $day = $_GET["day"];

                          $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='DC' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.$r["Callsign"].'</td><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Division"].'</td>
                                <td>'.$r["Role"].'</td><td>'.$r["Vehicle"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                           ?>

                           <tr><td colspan="6"><center><b>Joint Response Unit</b></center></td></tr>
                           <?php

                           $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='JRU' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.$r["Callsign"].'</td><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Division"].'</td>
                                <td>'.$r["Role"].'</td><td>'.$r["Vehicle"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                            ?>
                        </tbody>
                      </table>

                      <br>

                      <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                          <table class="table table-advanced table-bordered table-striped table-hover">
                            <center><h4><b>CCC</b></h4></center>
                            <thead>
                              <th>Member</th><th>Role</th><th>Actions</th>
                            </thead>
                            <tbody>
                              <?php

                           $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Division='CCC' AND Role <> 'Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td><td>'.$r["Role"].'</td><td><button class="btn btn-xs blue-stripe" onclick="popup_assign('.$day.','.$r["UserID"].')"><i class="fa fa-check-square-o"></i> Assign</button></td></tr>');

                            }
 
                          }

                            ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-md-3">
                        </div>
                      </div>

                      <br>

                      <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                          <center><h4><b>Civilians</b></h4></center>
                          <table class="table table-advanced table-bordered table-striped table-hover">
                            <tbody>
                              <?php

                           $res = $conn->query("SELECT * FROM Duties WHERE Day='".$day."' AND Role='Civilian'");

                          if ($res->num_rows > 0) {

                            while ($r = $res->fetch_assoc()) {

                              echo('<tr><td>'.getShortRank($r["UserID"])." ".getFirstName($r["UserID"])[0]." ".getLastName($r["UserID"]).'</td></tr>');

                            }
 
                          }

                            ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-md-3">
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
            })
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

<script>
function popup_assign(day, user) {

  var url = "popup_assignshift.php?day="+day+"&user=" + user;
  var w = 350;
  var h = 450;
  var left = Number((screen.width/2)-(w/2));
  var tops = Number((screen.height/2)-(h/2));
  window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

}
</script>

</body>

</html>
