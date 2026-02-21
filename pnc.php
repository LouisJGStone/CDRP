<?php
include('defines.php');
include("config.php");
include("backend.php");
session_start();

if (!isLoggedIn()) {
  header("Location: login.php");
}

if (getUserDetail($_SESSION["UserID"], "Controller") == 0) {
  header("Location: index.php");
}
?>

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
  body {
    background: #e9ecf3;
    margin: 42px !important;
  }
  </style>

</head>



<body class="page-container-bg-solid">

        <!-- BEGIN HEADER & CONTENT DIVIDER -->

        <div class="clearfix"> </div>

        <!-- END HEADER & CONTENT DIVIDER -->

        <!-- BEGIN CONTAINER -->

        <div class="page-container">

            <!-- BEGIN CONTENT -->

            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-speech"></i>
                                        <span class="caption-subject bold uppercase"> PNC</span>
                                        <span class="caption-helper">Police National Computer </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                                    <div class="borderd-div">
                    <h4>Person Check</h4>
                    <form method="GET" action="pncsearch.php">
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" required />
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" required />
                            </div>
                            <div class="col-md-6">
                                <label>D.O.B</label>
                                <input type="text" name="dob" class="form-control" required />
                            </div>
                        </div>
                        <input type="hidden" name="type" value="person" />
                        <input type="submit" class="hidden" />
                    </form>
                    <hr />
                    <h4>Vehicle Check</h4>
                    <form method="GET" action="./pncsearch.php">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Vehicle Registration</label>
                                <input type="text" name="reg" class="form-control" required />
                            </div>
                        </div>
                        <input type="hidden" name="type" value="vehicle" />
                    </form>
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

    </body>
</html>

