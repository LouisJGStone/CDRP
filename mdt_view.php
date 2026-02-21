<?php



include("backend/functions.php");



$callsign = "";

$status = "";

$statusColor = "bg-grey-cascade";

$role = "";

$vehicle = "";

$incident = 0;



$conn = getConnection();

$result = $conn->query("SELECT Incident,Callsign,Status,Role,Vehicle FROM Units WHERE Machine='".UniqueMachineID()."' LIMIT 1;");



while ($row = $result->fetch_assoc()) {



  $callsign = $row["Callsign"];

  $status = $row["Status"];

  $role = $row["Role"];

  $vehicle = $row["Vehicle"];

  $incident = $row["Incident"];



}



if ($status == "Unavailable") {



  $statusColor = "bg-grey-cascade";



}



if ($status == "Available") {



  $statusColor = "bg-green-turquoise";



}



if ($status == "Break") {



  $statusColor = "bg-yellow-gold";



}



if ($status == "On Scene") {



  $statusColor = "bg-blue-soft";



}



if ($status == "Proceeding") {



  $statusColor = "bg-purple-studio";



}

if ($status == "Report") {



  $statusColor = "bg-purple-studio";



}

if ($status == "Polcol") {



  $statusColor = "bg-purple-studio";



}



if ($status == "Panic") {



  $statusColor = "bg-red-thunderbird";



}



 ?>

<div class="row-fluid">



  <?php

  

  $res = getConnection()->query("SELECT * FROM Authority WHERE Incident='".getCurrentInfo("Incident")."'");

  

  if ($res->num_rows > 0) {

	

	while ($r = $res->fetch_assoc()) {

		

		echo('

		<div class="row"><div class="col-md-12"><div class="alert alert-danger">'.$r["Type"].' given by '.$row["User"].' at '.$r["Time"].'</div></div></div>

		');

			

	}

	

  }



  if ($status == "Informed" && $incident != 0) {



    echo '

    <div class="modal fade in" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: block; padding-right: 17px;">

       <div class="modal-dialog">

           <div class="modal-content">

               <div class="modal-header">

                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                   <h4 class="modal-title">You\'ve been assigned</h4>

               </div>

               <div class="modal-body"> You\'ve been assigned to a new job! </div>

               <div class="modal-footer">

                   <button type="button" class="btn dark btn-outline" onclick="setState(\'Available\');">Go Available</button>

                   <button type="button" class="btn green" onclick="setState(\'Proceeding\')">Proceeding</button>

               </div>

           </div>

           <!-- /.modal-content -->

       </div>

       <!-- /.modal-dialog -->

    </div>

    <div class="modal-backdrop fade in"></div>

    <script>startInformed();</script>

    ';



  } else {



    echo("<script>stopInformed();</script>");



  }



  if (getConnection()->query("SELECT Member FROM Units WHERE Status='Panic'")->num_rows > 0 || $status == "Panic") {



    echo("<script>startPanic();</script>");



  } else {



    echo("<script>stopPanic();</script>");



  }

 

   ?>

  <div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">

    <div class="portlet light">

      <div class="portlet-title">

        <div class="caption">

          <i class="fa fa-car"></i>

          <span class="caption-subject">Unit Information [iMDT ID: <?php echo(UniqueMachineID()); ?>]</span>

        </div>

      </div>

      <div class="portlet-body">

        <h4><b><?php echo($callsign); ?></b> <span class="label <?php echo $statusColor; ?>"><?php echo $status; ?></span></h4>

        <b>Role:</b> <?php echo($role); ?><br>

        <b>Vehicle:</b> <?php echo($vehicle); ?><hr>

        <center>

          <a href="javascript:setState('Available')" class="icon-btn">

            <i class="fa fa-check"></i>

            <div> Available </div>

          </a>

          <?php

          if ($incident != 0) {

            echo '
            <a href="javascript:setState(\'Proceeding\')" class="icon-btn">

            <i class="fa fa-arrow-right"></i>

            <div> Proceeding </div>

          </a>

          <a href="javascript:setState(\'On Scene\')" class="icon-btn">

            <i class="fa fa-arrow-down"></i>

            <div> On Scene </div>

          </a>
            ';

          }

           ?>

          <a href="javascript:setState('Break')" class="icon-btn">

            <i class="fa fa-coffee"></i>

            <div> Break </div>

          </a>

          <a href="javascript:setState('Unavailable')" class="icon-btn">

            <i class="fa fa-times"></i>

            <div> Unavailable </div>

          </a>
          
            <a href="javascript:Report()" class="icon-btn">

            <i class="fa fa-pencil"></i>

            <div> Report </div>

          </a>
          
            <a href="javascript:Polcol()" class="icon-btn">

            <i class="fa fa-minus-circle "></i>

            <div> Polcol </div>

          </a>

          <?php



            echo '

            <a href="javascript:trafficStop()" class="icon-btn">

              <i class="fa fa-car"></i>

              <div> Traffic Stop </div>

            </a>

            ';



           ?>

          <a href="bookoff.php" class="icon-btn">

            <i class="fa fa-rocket"></i>

            <div> Off Duty </div>

          </a>
          
          
          <a href="javascript:setState('Panic')" class="icon-btn btn-block">

            <i class="fa fa-life-ring"></i>

            <div> Panic </div>

          </a>

        </center>

      </div>

    </div>

    <div class="col-md-12">

      <?php if ($incident == 0 || $incident == "0") {

        echo("<br><center><b>You're not currently assigned to an active incident.</b></center><br>");

      } else {



        echo '<b><center id="commentWarning"></center></b>

        <div class="form-group">

          <textarea name="comment" id="incident" class="form-control" placeholder="Officer comment" rows="5"></textarea>

        </div>

         <button onclick="addcomment()" id="addcomment" class="btn uppercase dark btn-block">Add Comment</button>';



      }

      if (isset($_POST["comment"])) {

        $user = getShortRank($_SESSION["UserID"])." ".getLastName($_SESSION["UserID"]);

        createLog("CADView", $user, $_POST["comment"], $incident);

      }

      ?>



        



    </div>

  </div>



  <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">

    <div class="portlet light">

      <div class="portlet-title">

        <div class="caption">

          <i class="fa fa-bolt"></i>

          <span class="caption-subject">Active Incident</span>

        </div>

      </div>

      <div class="portlet-body">

        <?php



        $incident = getCurrentInfo("Incident");



        if ($incident == 0 || $incident == "0") {



          echo("<br><center><b>You're not currently assigned to an active incident.</b></center><br>");



        } else {



          $label = "";



          if (getIncidentInfo("Grade", $incident) == "Grade 1") {



            $label = '<span class="label bg-red">Grade 1</span>';



          } else {



            $label = '<span class="label bg-yellow-crusta">'.getIncidentInfo("Grade", $incident).'</span>';



          }



          $assets = "";



          $conn = getConnection();



          $res = $conn->query("SELECT Callsign,Status,Member FROM Units WHERE Incident='".$incident."'");



          while ($row = $res->fetch_assoc()) {



            $assets = $assets . "<br>" . '

            <div class="col-md-2 name">

              '.$row["Callsign"].'

            </div>

            <div class="col-md-2 value">

              '.$row["Status"].'

            </div>

            <div class="col-md-4 value">

              '.$row["Member"].'

            </div>

            ';



          }



          $auth = "";



          $res = $conn->query("SELECT Type,User FROM Authority WHERE Incident='".$incident."'");

          while ($row = $res->fetch_assoc()) {



            $auth = $auth . "<br><br>"

            .'<div class="col-md-4 name label label-danger">

              '.$row["Type"].'

            </div>

            ';



          }



          $logs = "";



          $res = $conn->query("SELECT * FROM IncidentLogs WHERE Incident='".$incident."' ORDER BY Time ASC");



          while ($row = $res->fetch_assoc()) {



            $logs = $logs . "<tr><td>".$row["Time"]."</td><td>".$row["Log"]."</td><td>".$row["Source"]."</td><td>".$row["User"]."</td></tr>";



          }



          echo '

          <b>INC #'.$incident.' | '.getIncidentInfo("Type", $incident).' | '.$label.'<br></b>

          <b>Location: </b> '.getIncidentInfo("Location", $incident).'<br>

          <b>Postcode: </b> '.getIncidentInfo("Borough", $incident).'<br>

          <b>Channel: </b> '.getIncidentInfo("Channel", $incident).'<br>

          <b>Details: </b> '.getIncidentInfo("Details", $incident).'<br><br>

          <b>Deployed Assets</b>

          <br><br>

          <div class="col-md-2 name">

            <b>UNIT</b>

          </div>

          <div class="col-md-2 value">

            <b>STATUS</b>

          </div>

          <div class="col-md-4 value">

            <b>OFFICER</b>

          </div>

          ' . $assets . '



          <br><br><br>

          <b>Authority</b>

          '.$auth.'

          <br><br><br>

          <b>Incident Log</b> (<a href="javascript:addnote('.$incident.')">Add Incident Note</a>)

          <table class="table table-hover">

            <thead>

              <th>Time</th>

              <th>Log</th>

              <th>Source</th>

              <th>User</th>

            </thead>

            <tbody>

            '.$logs.'

            <tbody>

          </table>';



        }



         ?>

      </div>

    </div>

  </div>

</div>



<script>



function addcomment() {



  jQuery.post("mdt_note.php", {"incident": <?php echo($incident); ?>, "note": document.getElementById("incident").value});

  document.getElementById("incident").value = "";



}



function setState(state) {



  data = {

    "state": state,

  };



  jQuery.post("backend/state.php", data);



}



function trafficStop() {



  var url = "mdt_trafficstop.php";

  var w = 700;

  var h = 500;

  var left = Number((screen.width/2)-(w/2));

  var tops = Number((screen.height/2)-(h/2));

  window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);



}

function Polcol() {

 javascript:setState('Polcol')

  var url = "mdt_polcol.php";

  var w = 700;

  var h = 500;

  var left = Number((screen.width/2)-(w/2));

  var tops = Number((screen.height/2)-(h/2));

  window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);



}

function Report() {

    javascript:setState('Report')

  var url = "mdt_finishjob.php";

  var w = 700;

  var h = 500;

  var left = Number((screen.width/2)-(w/2));

  var tops = Number((screen.height/2)-(h/2));

  window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);



}



function addnote(incident) {



      var url = "mdt_note.php?incident=" + incident;

      var w = 700;

      var h = 350;

      var left = Number((screen.width/2)-(w/2));

      var tops = Number((screen.height/2)-(h/2));

      window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

    }



</script>

