<?php 
include("config.php");
include("backend.php");
session_start();

if (!isLoggedIn()) {

  header("Location: login.php");

}

$con = mysqli_connect('localhost','central3_fms','MacyBeth2','central3_fms');
    
    if(!$con)
    {
        echo '<div class="alert alert-danger" role="alert">
                Contact Dev Im Broken #18452Finish
            </div>';
    }

    if (isset($_POST["cadid"])) {
        
  $cadid = $_POST["cadid"];
  $officer = $_POST["officer"];
  $final = $_POST["final"];
  $state = $_POST["state"];
  
  $sql = "INSERT INTO report (cadid,officer,final,state) 
            VALUES 
  ('$cadid','$officer','$final','$state')";
  
  if(!mysqli_query($con,$sql))
    {
        echo '<div class="alert alert-danger" role="alert">
                Contact Dev Im Broken #74544
            </div>';
    }
    else
    {
        echo '';
    }
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
                <h4 class="modal-title"><b>File A Report</b></h4>
            </div>
            <div class="modal-body">

              <form action="mdt_finishjob.php" method="post">
                <input class="form-control" name="cadid" placeholder="CAD REF #"><br>
                <input class="form-control" name="officer" placeholder="Officer Writing The Report"><br>
                <textarea class="form-control" name="final" rows="5" placeholder="Final Remark"></textarea><br>
                <select name="state">
                    <option value="Open">Open</option>
                    <option value="Awaiting">Handed Over To CID</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn default" onclick="window.close();">Close</button>
                <button type="submit" value="insert" class="btn green">Create</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>
</html>