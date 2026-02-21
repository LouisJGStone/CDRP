<?php



include("config.php");

include("backend.php");

session_start();



if (!isLoggedIn()) {



  header("Location: login.php");



}

include("defines.php");

$success = false;

if (isset($_POST["firstName"])) {

  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $dob = $_POST["dateOfBirth"];
  $warning = "";
  $wanted = "";

  var_dump($_POST["warning"]);

  if (isset($_POST["warning"])) {

    $warning = implode("|", $_POST["warning"]);

  }

  if (isset($_POST["wanted"])) {

    $wanted = implode("|", $_POST["wanted"]);

  }

  getConnection()->query("DELETE FROM PNC WHERE FirstName='".$firstName."' AND LastName='".$lastName."'");
  getConnection()->query("INSERT INTO PNC (FirstName, LastName, Markers, Wanted, DOB) VALUES ('".$firstName."','".$lastName."','".$warning."','".$wanted."','".$dob."')");

  $success = true;

}

 ?>



<html>



<head>

  <meta charset="utf-8">

  <title><?php echo $settings["clanName"]; ?> | FMS</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta content="width=device-width, initial-scale=1" name="viewport">

  <meta content="Alex Colville" name="author">

  <link href="../assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />

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

  <script src="dist/jquery.inputmask.bundle.js"></script>
<script src="dist/inputmask/phone-codes/phone.js"></script>
<script src="dist/inputmask/phone-codes/phone-be.js"></script>
<script src="dist/inputmask/phone-codes/phone-ru.js"></script>

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

                          <h3 class="uppercase">Civilian</h3>

                      </li>

                      <li class="nav-item  ">

                          <a href="civilian.php" class="nav-link nav-toggle">

                              <i class="icon-bar-chart"></i>

                              <span class="title">PNC Info</span>

                          </a>

                      </li>

                      <li class="nav-item  ">

                          <a href="javascript:call()" class="nav-link nav-toggle">

                              <i class="icon-call-out"></i>

                              <span class="title">Call 999</span>

                          </a>

                      </li>
                      <script>
                        function call() {
                          var url = "call999.php";
                          var w = 700;
                          var h = 500;
                          var left = Number((screen.width/2)-(w/2));
                          var tops = Number((screen.height/2)-(h/2));
                          window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
                        }
                      </script>

                      <li class="heading">

                          <h3 class="uppercase">Systems</h3>

                      </li>

                      <li class="nav-item  ">

                          <a href="index.php" class="nav-link nav-toggle">

                              <i class="fa fa-home"></i>

                              <span class="title">Portal</span>

                          </a>

                      </li>

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



                  <div class="page-head">

                    <div class="page-title">

                        <h1>Civilian Dashboard

                        </h1>

                    </div>

                  </div>



                  <div class="portlet light">

                    <div class="portlet-title">

                      <div class="caption">

                        <span class="caption-subject bold uppercase">PNC Info</span>

                        <span class="caption-helper">Time for a new name...</span>

                      </div>

                    </div>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                    <div class="portlet-body">

                      <?php 

                      if ($success) {

                        echo '
                        <div class="alert alert-success"><strong>Success!</strong> Your PNC information has been uploaded to the PNC database. To edit it, create a character with the same name again - it\'ll replace the old one</div>
                        ';

                      }

                      ?>

                      <div class="row">

                        <div class="col-md-4">

                          <form method="post">

                          <label><b>First Name</b></label><br>
                          <input class="form-control" name="firstName" id="firstName"><br>
                          <label><b>Last Name</b></label><br>
                          <input class="form-control" name="lastName" id="lastName"><br>
                          <label><b>Date of Birth</b> <small>It must be formatted as: dd/mm/yyyy</small></label>
                          <input data-inputmask="'mask': 'd/m/y'" class="form-control" name="dateOfBirth">

                          <br>

                          <label><b>Warning Markers</b></label><br>
                          <select name="warning[]" class="form-control" multiple="multiple">
                            <option>Drugs</option>
                            <option>Firearms</option>
                            <option>Violence</option>
                            <option>Weapons</option>
                            <option>Impersonator</option>
                            <option>Mental Heath</option>
                            <option>Conceals</option>
                            <option>Sex Offender</option>
                          </select>

                          <br>

                          <label><b>Wanted Reasons</b></label><br>
                          <select name="wanted[]" class="form-control" multiple="multiple">
                            <option>Abusive Behaviour</option>
                            <option>Murder</option>
                            <option>Manslaughter</option>
                            <option>Failing to Stop</option>
                            <option>Assault ABH</option>
                            <option>Assault GBH</option>
                            <option>Sexual Assault</option>
                            <option>Rape</option>
                          </select>

                          <br>

                          <button type="submit" class="btn btn-success">Submit PNC Details</button>
                          </form>

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

          $(document).ready(function () {
            document.getElementById("firstName").value = "<?php echo($firstNames[array_rand($firstNames)]); ?>";
            document.getElementById("lastName").value = "<?php echo($lastNames[array_rand($lastNames)]); ?>";


          });

        </script>

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







</body>



</html>

