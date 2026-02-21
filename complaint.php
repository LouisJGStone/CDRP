<?php

if ($_GET["view"] == "tase") {

  header("Location: /tase");

}

include("config.php");
include("backend.php");

session_start();

if (!isLoggedIn()) {

  header("Location: login.php");

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
  <style>
        .mt-element-ribbon .ribbon.ribbon-color-success {
            background-color: #36c6d3;
            color: #fff;
        }
        components.min.css:1
        .mt-element-ribbon .ribbon.ribbon-shadow {
            box-shadow: 2px 2px 7px rgba(0,0,0,.4);
        }
        components.min.css:1
        .mt-element-ribbon .ribbon {
            padding: .5em 1em;
            z-index: 5;
            float: left;
            margin: 10px 0 0 -2px;
            clear: left;
            position: relative;
        }
  </style>
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <!-- force password change for brand new/new password accounts -->
        <div class="modal fade" id="pswdForce" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                      <div class="alert alert-danger text-center">
                        <strong>Whoops!</strong> Your account has been flagged for new or has recently had a password change, please update your password to continue
                      </div>
                      <form method="post" action="index.php?password">
                      <input class="form-control" type="password" name="pswdForce" placeholder="New Password">


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn green">Save changes</button></form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- change password-->
        <div class="modal fade" id="pswd" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">

                      <form method="post" action="index.php?password">
                      <input class="form-control" type="password" name="pswd" placeholder="New Password">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save changes</button></form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
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
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="heading">
                            <h3 class="uppercase">Systems</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="?view=portal" class="nav-link nav-toggle">
                                <i class="fa fa-home"></i>
                                <span class="title">Portal</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-laptop"></i>
                                <span class="title">MDT</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-desktop"></i>
                                <span class="title">CAD</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="#pswd" data-toggle="modal" class="nav-link nav-toggle">
                                <i class="fa fa-key"></i>
                                <span class="title">Change Password</span>
                            </a>
                        </li>

                        <?php

                        $rank = getShortRank();

                        if (in_array($_SESSION["UserID"], $bypass)) {

                          $rank = "COMM";

                        }

                        if (in_array($rank, $babyTase) || in_array($rank, $tase) || in_array($rank, $polcols)) {

                          echo '
                          <li class="heading">
                              <h3 class="uppercase">Supervisor</h3>
                          </li>
                          ';

                        }

                        if (in_array($rank, $babyTase) || in_array($rank, $tase) || in_array($rank, $polcols)) {

                          echo('
                          <li class="nav-item  ">
                              <a href="javascript:;" class="nav-link nav-toggle">
                                  <i class="fa fa-car fa-spin fa-3x fa-fw"></i>
                                  <span class="title">POLCOL Report</span>
                              </a>
                          </li>
                          ');

                        }

                        if (in_array($rank, $babyTase) || in_array($rank, $tase)) {

                          echo('
                          <li class="nav-item  ">
                              <a href="tase/duties.php" class="nav-link nav-toggle">
                                  <i class="fa fa-calendar"></i>
                                  <span class="title">Duties Management</span>
                              </a>
                          </li>
                          ');

                        }

                        if (in_array($rank, $admin)) {

                          echo '
                          <li class="heading">
                              <h3 class="uppercase">Administration Settings</h3>
                          </li>
                          ';

                        }

                        if (in_array($rank, $admin)) {

                          echo('
                          <li class="nav-item  ">
                              <a href="admin/index.php" class="nav-link nav-toggle">
                                  <i class="fa fa-hand-lizard-o"></i>
                                  <span class="title">Website Settings</span>
                              </a>
                          </li>
                          ');

                        }

                         ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content" style="min-height: 1147px;">
                    <div class="col-md-8">
                        <div class="portlet light">
                          <div class="portlet-title">
                            <div class="caption">
                              <span class="caption-subject bold uppercase">Complaint</span>
                              <span class="caption-helper">about a member of staff? let us know</span>
                            </div>
                          </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="" method="POST" role="form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="Title" name="Title" placeholder="Title" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="About" name="About" placeholder="Who is your complaint about" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="10" id="Report" name="Report" placeholder="What happened" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="Evidance" name="Evidance" placeholder="Evidance" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="Involved" name="Involved" placeholder="Who was involved in this" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Remain Anonymous</label>
                                            <select class="form-control" name="Anonymous">
                                                <option value="No">No, I do not wish to remain Anonymous</option>
                                                <option value="Yes">Yes, I wish to remain Anonymous</option>
                                            </select>
                                        </div>
                                        <p class="text-info">Your details will still be passed along with this complaint who ever your name shall not be brought up should you wish to remain Anonymous.</p>
                                            
                                        <button type="submit" class="btn btn-danger btn-block btn-lg">File Complaint</button>
                                    </form>
                                    <?php
                                    
                                    if(isset($_POST['submit'])){
                                
                                        $Fname = getUserDetail($_SESSION["UserID"], "FirstName");
                                        $Lname = getUserDetail($_SESSION["UserID"], "LastName");
                                        
                                        $Title = $_POST["Title"];
                                        $About = $_POST["About"];
                                        $Report = $_POST["Report"];
                                        $Evidance = $_POST["Evidance"];
                                        $Involved = $_POST["Involved"];
                                        
                                        $query= "INSERT INTO Complaints (Username, Date, Title, About, Report, Evidance, Involved, Anonymous) VALUES ($Fname $Lname, NOW(), $Title, $About, $Report, $Evidance, $Involved, $Anonymous)";
                                        getConnection()->query($query);
                                        
                                        echo "<div class='alert alert-success text-center'>Complaint created</div>";
                                    }
                                    ?>
                                    <!-- END FORM-->
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portlet light">
                            <div class="portlet-body">
                                <div class="alert alert-warning text-center">THINGS TO REMEMBER</div>
                                <h3>Not discuss your complaint</h3>
                                <p>Anyone found to be talking about a complaint outside of a misconduct/inital interview will be placed onto an amber notice and the complaint will be closed without warning.</p>
                                <h3>Serivce Level Agreement</h3>
                                <p>We aim to have most cases closed within 7 working days from when they are first opened unless more information or more evidance needs to be collected to take action further.</p>
                                <h3>Who can see your complaint</h3>
                                <p>GC/HR are the only members who can see complaint and no one outside of these areas will know about your complaint until the time is right.</p>
                                <br>
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
<script>
<?php  
if (getUserDetail($_SESSION["UserID"], "ChangedPass") == 0) {
  echo"$('#pswdForce').modal({
  backdrop: 'static',
  keyboard: false
})";
}
?>
</script>
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
