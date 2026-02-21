<?php



include("../backend.php");
include("../config.php");



if (isset($_POST["day"])) {



  $day = $_POST["day"];

  $user = $_POST["user"];

  $callsign = $_POST["callsign"];

  $role = $_POST["role"];

  $vehicle = $_POST["vehicle"];

  $division = $roles[$role];



  getConnection()->query("UPDATE Duties SET Callsign='".$callsign."' WHERE UserID='".$user."' AND Day='".$day."'");

  getConnection()->query("UPDATE Duties SET Role='".$role."' WHERE UserID='".$user."' AND Day='".$day."'");

  getConnection()->query("UPDATE Duties SET Vehicle='".$vehicle."' WHERE UserID='".$user."' AND Day='".$day."'");

  getConnection()->query("UPDATE Duties SET Division='".$division."' WHERE UserID='".$user."' AND Day='".$day."'");

  // echo("UPDATE Duties SET Callsign='".$callsign."' AND Role='".$role."' AND Vehicle='".$vehicle."' WHERE UserID='".$user."' AND Day='".$day."'");

  echo("<script>window.opener.location.reload();window.close();</script>");

  die();



}



$day = date('l', strtotime("Monday +{$_GET["day"]} days"));

$member = $_GET["user"];

$name = getShortRank($member) . " " . getLastName($member);



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

<body>

  <div class="modal fade in" id="full" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 15px;">

    <div class="modal-dialog modal-full">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                <h4 class="modal-title"><b>ASSIGN SHIFT - <?php echo($day); ?></b><br><?php echo($name); ?></h4>

            </div>

            <div class="modal-body">

              <form action="popup_assignshift.php" method="post">

                <input type="hidden" name="day" value="<?php echo $_GET["day"]; ?>">

                <input type="hidden" name="user" value="<?php echo $member; ?>">

                <label><b>Callsign</b></label><br>

                <input class="form-control" placeholder="S1" name="callsign">

                <br>

                <label><b>Role</b></label><br>

                <select class="form-control" name="role">

                  <?php

                  foreach ($roles as $role => $division) {

                    echo('<option value="'.$role.'">[' . $division . "] " . $role . "</option>");

                  }

                   ?>

                </select><br>

                <label><b>Vehicle</b></label><br>

                <select class="form-control" name="vehicle">

                  <option></option>

				  <optgroup label="Response Team">
					<option>Land Rover Discovery</option>
					<option>BMW F11</option>
					<option>Skoda VRS</option>
					<option>Volvo V40</option>
					<option>Hyundai I30 QCar</option>
					<option>Ford Focus Hatchback QCar</option>
					<option>Mercedes Sprinter</option>
					<option>Mercedes Box Sprinter</option>
					<option>Ford Tourneo</option>
					<option>Ford Transit</option>
					<option>Vauxhall Astra</option>
					<option>Hyundai I30</option>
					<option>Ford Mondeo Marked</option>
					<option>Mercedes Vito</option>
					<option>Unmarked Ford Mondeo</option>
				  </optgroup>
				  <optgroup label="Firearms">
					<option>BMW X5 DPG</option>
					<option>BMW X5 2016 </option>
					<option>Ford Mondeo St-Line DPG</option>
					<option>Range Rover SVR</option>
					<option>BMW 525D E60 Halagon</option>
					<option>BMW 525D E60</option>
				  </optgroup>
				  <optgroup label="OPU">
					<option>BMW 530D Touring</option>
					<option>BMW X5 F15 2017</option>
					<option>BMW 525D (Unmarked)</option>
					<option>Volvo V70</option>
					<option>Audi A4</option>
					<option>BMW X5 2016</option>
					<option>BMW 530D F10</option>
					<option>Ford Mondaeo</option>
					<option>BMW 330D</option>
				  </optgroup>
				  <optgroup label="WMAS">
					<option>Mercedes Sprinter</option>
					<option>Doctors Car</option>
					<option>Community First Responder</option>
					<option>Tiguan</option>
					<option>Land Rover Discovery</option>
					<option>Skoda Octavia Combi</option>
					<option>BTP Ford Focus</option>
					<option>BTP V70 ARV</option>
					<option>BTP FRU</option>
					<option>LFB Pump 2007</option>
					<option>LFB Pump 2017</option>
					<option>Turtable Ladder</option>
					<option>Heathrow Fire Engine</option>
					<option>LFB Search And Rescue Boat</option>
					<option>RNLI Search And Rescue Boat</option>
					<option>
				  </optgroup>


                </select>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn dark btn-outline" onclick="window.close();">Close</button>

                <button type="submit" class="btn green">Assign Shift</button></form>

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

  </div>

</body>

</html>
