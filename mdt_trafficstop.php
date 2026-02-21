<?php 
include("config.php");
include("backend.php");
session_start();

if (!isLoggedIn()) {

  header("Location: login.php");

}

include("backend/functions.php");

if (isset($_POST["colour"])) {

  $colour = $_POST["colour"];
  $vehicle = $_POST["vehicle"];
  $reason = $_POST["reason"];
  $street = $_POST["street"];
  $inc = createIncident("Traffic Stop - " . $reason, $street, getCurrentInfo("Callsign") . " has stopped a " . $colour . " " . $vehicle . ' for ' . $reason, getNextChannel(), "NONE ASSIGNED");
  attach($inc, getCurrentInfo("UnitID"));
  echo('<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>');
  echo('<script>

  data {

    state: "On Scene"

  };

  jQuery.post("backend/state.php", data);
  window.close();

  </script>');


}

 ?>

<html>
<head>
  <meta charset="utf-8">
  <title>uFMS ~ Unofficial FMS</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <!-- BEGIN LAYOUT FIRST STYLES -->
  <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">
  <!-- END LAYOUT FIRST STYLES -->
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css">
  <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css">
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="../assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css">
  <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="favicon.ico">
</head>

<body>
  <div class="modal fade in" id="full" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Create Traffic Stop</b></h4>
            </div>
            <div class="modal-body">

              <form action="mdt_trafficstop.php" method="post">
                <input class="form-control" name="colour" placeholder="Vehicle Colour"><br>
                <input class="form-control" name="vehicle" placeholder="Vehicle Type"><br>
                <input class="form-control" name="reason" placeholder="Reason for Stop"><br>
                <input class="form-control" name="street" placeholder="Street Name"><br>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn default" onclick="window.close();">Close</button>
                <button type="submit" class="btn green">Create</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>

</html>
