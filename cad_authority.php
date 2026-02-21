<?php 

include("backend/functions.php");

if (!isset($_GET["incident"]) && !isset($_POST["incident"])) {
		
	//echo("<script>window.close();</script>"); die();
	
}

$close = false;

if (isset($_POST["traffic"]) && $_POST["traffic"] != "null") {
		
  // echo("INSERT INTO Authority (Type, Incident, User, Status) VALUES ('".$_POST["traffic"]."','".$_POST["incident"]."','". getShortRank() . " " . getLastName() ."','Active')");
	$conn = getConnection();

  $getInfo = $conn->query('SELECT CollarNumber, LastName FROM Users WHERE UserID = '.$_SESSION['UserID']);
  if ($getInfo->num_rows > 0) {
    while($row = $getInfo->fetch_assoc()) {
      $CollarNumber = $row['CollarNumber'];
      $LastName = $row['LastName'];
    }
  }

  $user = getShortRank($_SESSION["UserID"])." ".getLastName($_SESSION["UserID"]);
  $log = 'Granted Use Of: '.$_POST["traffic"];

  $conn->query("INSERT INTO IncidentLogs (Source, User, Log, Incident, Time) VALUES ('Authority Logs','$CollarNumber $LastName','".$log."','".$_POST["incident"]."',now());");
	$conn->query("INSERT INTO Authority (Type, Incident, User, Status) VALUES ('".$_POST["traffic"]."','".$_POST["incident"]."','".$user."','Active')");
	
	$close = true;
	
}

if (isset($_POST["firearms"]) && $_POST["firearms"] != "null") {
		
	$conn = getConnection();

  $getInfo = $conn->query('SELECT CollarNumber, LastName FROM Users WHERE UserID = '.$_SESSION['UserID']);
  if ($getInfo->num_rows > 0) {
    while($row = $getInfo->fetch_assoc()) {
      $CollarNumber = $row['CollarNumber'];
      $LastName = $row['LastName'];
    }
  }
  
  $user = getShortRank($_SESSION["UserID"])." ".getLastName($_SESSION["UserID"]);
  $log = 'Granted Use Of: '.$_POST["firearms"];

  $conn->query("INSERT INTO IncidentLogs (Source, User, Log, Incident, Time) VALUES ('Authority Logs','$CollarNumber $LastName','".$log."','".$_POST["incident"]."',now());");
  $conn->query("INSERT INTO Authority (Type, Incident, User, Status) VALUES ('".$_POST["firearms"]."','".$_POST["incident"]."','".$user."','Active')");

  $close = true;
	
}

if ($close == true) {
	
	echo("<script>window.close();</script>"); die();
	
}

 ?>

<html>
<head>
  <meta charset="utf-8">
  <title>OIS - Grant Authority</title>
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
                <h4 class="modal-title"><b>Grant/Remove Authority</b></h4>
            </div>
            <div class="modal-body">
			<form method="post" action="cad_authority.php">
			  <input type="hidden" name="incident" value="<?php echo $_GET["incident"]; ?>">
              <label><b>Traffic Authority</b></label>
			  <select class="form-control" name="traffic">
				<option value="null"></option>
				<option>Initial Pursuit Authority</option>
				<option>Stinger Authority</option>
				<option>Tactical Contact Authority</option>
				<option>Hard Stop Authority</option>
				<option>TPAC Authority</option>
				<option>Preemtive TPAC Authority</option>
			  </select><br><br>
			  <label><b>Firearms Authority</b></label>
			  <select class="form-control" name="firearms">
				<option value="null"></option>
				<option>Preemtive TASER Authority</option>
				<option>Standard Firearms Authority</option>
				<option>Advanced Firearms Authority</option>
				<option>CTSFO Authority</option>
			  </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn default" onclick="window.close();">Close</button>
				<button type="submit" class="btn primary" >Grant Authority</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</body>

</html>
