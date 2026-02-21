<?php



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

                          <h3 class="uppercase">CAD</h3>

                      </li>

                      <li class="nav-item  ">

                          <a href="cad.php" class="nav-link nav-toggle">

                              <i class="icon-bar-chart"></i>

                              <span class="title">Console</span>

                          </a>

                      </li>

                      <li class="nav-item  ">

                          <a href="http://sm.centrallondonpolicingcommunity.com" class="nav-link nav-toggle">

                              <i class="icon-magnifier"></i>

                              <span class="title">PNC Search</span>

                          </a>

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

                        <h1>CAD

                            <small>Computer Aided Dispatch</small>

                        </h1>

                    </div>

                  </div>



                  <div class="portlet light">

                    <div class="portlet-title">

                      <div class="caption">

                        <span class="caption-subject bold uppercase">CAD Console</span>

                        <span class="caption-helper">Sierra 1, are you available to dispatch?</span>

                      </div>

                    </div>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                    <div class="portlet-body">

                      <div class="row">

                        <div class="col-md-12" id="console">

                        </div>

                      </div>

                    </div>

                    <?php



                    if (true) {



                      echo '

                      <script>

                      function auto_load(){

                              $.ajax({

                                url: "cad_view.php",

                                cache: false,

                                success: function(data){

                                   $("#console").html(data);

                                }

                              });

                      }



                      $(document).ready(function(){



                      auto_load(); //Call auto_load() function when DOM is Ready



                      });



                      //Refresh auto_load() function after 10000 milliseconds

                      setInterval(auto_load,1000);

                      </script>

                      ';



                    }



                     ?>

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

function createIncident() {
    var url = "call999.php?create";
    var w = 700;
    var h = 500;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}
function PNC() {
    var url = "pnc.php";
    var w = 700;
    var h = 500;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}

function authority(incident) {
    var url = "cad_authority.php?incident=" + incident;
    var w = 700;
    var h = 500;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}


function Map(incident) {
    var url = "http://fms.centrallondonpolicingcommunity.com/map/#";
    var w = 700;
    var h = 500;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}

</script>

<script>


function allowDrop(ev) {

  ev.preventDefault();

}

function close(incident) {

  jQuery.post("backend/close.php", {"incident": incident});

}
</script>

<script>
function details(inc) {
    var url = "cad_details.php?incident=" + inc;
    var w = 6000;
    var h = 600;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}
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
