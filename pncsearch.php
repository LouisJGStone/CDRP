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
    .about-header h2,.stories-header h2{letter-spacing:1px;text-transform:uppercase}.card-icon,.stories-cont .photo{width:100%}.about-header,.card-desc,.card-icon,.card-title,.stories-cont .title,.stories-footer,.stories-header{text-align:center}.about-header{height:500px;background-image:url(../media/bg/5.jpg);background-position:center;margin:0 -20px}.about-header h1{color:#fff;font-size:55px;font-weight:600;margin-top:130px;text-shadow:1px 1px 0 rgba(0,0,0,.2)}.about-header h2{color:#fff;font-size:22px;font-weight:400;margin-top:30px;margin-bottom:40px}.card-icon{overflow:hidden}.card-icon i{font-size:50px;border:1px solid #ecf0f4;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;padding:47px 30px;margin:30px 0}.card-title span{font-size:18px;font-weight:600;color:#373d43}.card-desc{margin-top:20px;margin-bottom:30px}.card-desc span{font-size:14px;font-weight:400;color:#808a94}.about-links-cont{background-color:#fff;margin:0 -20px}.about-links-cont .about-links{padding:70px 0 70px 70px}.about-links-cont .about-image{padding-left:110px}.about-links-item h4{font-size:18px;font-weight:600;color:#373d43}.about-links-item ul{margin:0;padding:0;list-style-type:none}.about-links-item ul li{padding-top:5px}.about-links-item ul li a{font-size:14px;font-weight:400;color:#4a8fba}.stories-header h1{color:#373d43;font-size:35px;font-weight:600}.stories-header h2{color:#808a94;font-size:18px;font-weight:400;margin-top:20px}.stories-cont .photo img{margin:30px auto;width:130px;height:130px;-webkit-border-radius:50%!important;-moz-border-radius:50%!important;border-radius:50%!important}.stories-cont .title span{font-size:18px;font-weight:600;color:#373d43}.stories-cont .desc{text-align:center;margin-top:20px;margin-bottom:30px}.stories-cont .desc span{font-size:14px;font-weight:400;color:#808a94}.about-text{height:500px;padding:0!important}.about-text>h4{background-color:#d9534f;font-size:24px;font-weight:600;color:#fff;padding:1em 20px;margin:0}.about-text>h4>i{font-size:24px!important;color:#fff}.about-text>p{color:#808a94}.about-text .about-quote,.about-text ul,.about-text>p{padding-left:20px;padding-right:20px}.about-text li{margin-bottom:.5em}.about-text .about-quote>h3{border-left:3px solid;border-color:#ccc;padding-left:1em;font-style:italic;line-height:1.3em}.about-text .about-quote>.about-author{text-align:right}.about-image{background-repeat:no-repeat;background-size:cover;height:545px}.about-links-item{margin-bottom:2em}@media (max-width:600px){.about-text{height:auto;padding-bottom:1.5em!important}.about-image{margin:0 -20px}}
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
<div class="col-md-12">
<div class="row">
                        <a href="./pnc.php" class="pull-right">< Back</a>
<?php 
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];

    $conn = getConnection();
    $result = $conn->query("SELECT * FROM PNC WHERE FirstName='".$fname."' AND LastName='".$lname."'");

    while ($row = $result->fetch_assoc())
    {
            echo "<strong>Name:</strong> ".$row['FirstName'] . " " . $row['LastName'];
            echo "</br></br>";
            echo "<strong>DOB:</strong> ".$row['DOB'];
            echo "</br></br>";
            echo "<strong>Details:</strong> ".$row['Details'];
    }
 ?>
                        <hr>
                        <div class="col-md-4">
                          <div class="row">
                            <h4><strong>Markers</strong></h4>
                            No Markers Found
                            <br><br>
                            <span class="label label-danger">Weapon</span><br><br>
                            <span class="label label-danger">Conceals</span><br><br>
                            <span class="label label-danger">Mental Health</span><br><br>
                            <span class="label label-danger">Domestic Abuse</span><br><br>
                            <span class="label label-warning">Violent</span><br><br>
                            <span class="label label-warning">Drugs</span><br><br>
                            <span class="label label-warning">Sex Offender</span><br><br>
                            <span class="label label-success">Offenders On Bail</span><br><br>      
                          </div>                    
                        </div>

                        <div class="col-md-4">
                          <div class="row">
                            <h4><strong>Wanted</strong></h4>
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

    </body>
</html>

