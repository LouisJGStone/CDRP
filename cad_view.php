<?php

include("backend/functions.php");

function getOccupants($callsign) {

  $day = date("N") - 1;

  $num = getConnection()->query("SELECT Callsign FROM Duties WHERE Callsign='".$callsign."' AND Day='{$day}'")->num_rows;

  return $num;

}

function getDivision($division, $info) {

  $conn = getConnection();

  $result = $conn->query("SELECT UnitID,QueueTime,Callsign,Role,Vehicle,Status,Member FROM Units WHERE Division='".$division."' AND Status='Available' OR Status='Break' AND Division='".$division."' ORDER BY QueueTime");

  $value = "<center><h4>".$division." <small>".$info."</small></h4></center>";

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      if ($row["Status"] == "Available") {

        $occupantNum = getOccupants($row["Callsign"]);

        $occupants = $occupantNum == 1 ? "Occupant" : "Occupants";

        $value = $value . '<br><button class="btn green-jungle btn-block" ondragstart="drag'.$row["UnitID"].'(event)" draggable="true">' . $row["Callsign"] . " - ".$row["Role"]." - ".$occupantNum." ". $occupants . '</button>
        <script>
        function drag'.$row["UnitID"].'(ev) {

          ev.dataTransfer.setData("unit", '.$row["UnitID"].');

        }
        </script>';

      } else {

        $occupantNum = getOccupants($row["Callsign"]);

        $occupants = $occupantNum == 1 ? "Occupant" : "Occupants";

        $value = $value . '<br><button class="btn yellow-casablanca btn-block" ondragstart="drag'.$row["UnitID"].'(event)" draggable="true">' . $row["Callsign"] . " - ".$row["Role"]." - ".$occupantNum." ". $occupants . '</button>
        <script>
        function drag'.$row["UnitID"].'(ev) {

          ev.dataTransfer.setData("unit", '.$row["UnitID"].');

        }
        </script>';

      }

    }

  } else {

    $value = $value . "<br><center>No available ".$division." units!</center><br>";

  }

  return $value;

}

if (getConnection()->query("SELECT Incident FROM Units WHERE Status='Panic'")->num_rows > 0) {

  echo('
    <audio id="panic" src="panic.wav" autoplay loop>
        Your browser does not support the <code>audio</code> element.
    </audio>
    <script>document.getElementById("panic").volume = 0.05;</script>
    ');

}

 ?>

<div class="row">
  <div class="col-md-12">
    <button onclick="javascript:createIncident();" class="btn btn-default">Create Incident</button>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-lg-3 col-sm-3">
    <?php
    
    echo(getDivision("DC", "Duty Command"));
    echo("<br>");
    echo(getDivision("ERT", "Emergency Response Team"));
    echo("<br>");
    echo(getDivision("RTPC", "Roads Transport Policing Command"));
    echo("<br>");
    echo(getDivision("SFC", "Specialist Firearms Command"));
    echo("<br>");
    echo(getDivision("JRU", "Joint Responce Unit"));

     ?>
  </div>

  <div class="col-md-9 col-lg-9 col-sm-9">
    <?php

    $conn = getConnection();
    $res = $conn->query("SELECT * FROM Incidents WHERE Status='999'");

    if ($res->num_rows > 0) {

      while ($row = $res->fetch_assoc()) {

        echo('
          <div class="portlet box blue-hoki">
            <div class="portlet-title">
              <div class="caption">'.$row["Type"].' | '.$row["Location"].' ('.$row["Borough"].')</div>
              <div class="actions"><a href="javascript:jQuery.post(\'cad_transfer.php\', {incident: '.$row["IncidentID"].'});" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Transfer </a></div>
            </div>
          </div>
          ');

      }

    }

     ?>
    <?php

    $conn = getConnection();
    $res = $conn->query("SELECT * FROM Incidents WHERE Status='Open' ORDER BY Channel");

    if ($res->num_rows > 0) {

      while ($row = $res->fetch_assoc()) {

        $label = "<span class=\"label bg-red\">I - IMMEDIATE</span>";

        if ($row["Grade"] == "S - SCHEDULED" || $row["Grade"] == "Unset") {

          $label = "<span class=\"label bg-yellow-crusta\">".$row["Grade"]."</span>";

        }

        $assets = "";

        $result = $conn->query("SELECT * FROM Units WHERE Incident='".$row["IncidentID"]."'");

        if ($result->num_rows > 0) {

          while ($row2 = $result->fetch_assoc()) {

            if ($row2["Status"] == "Panic") {

              $assets = $assets . '
              <a href="javascript:endPanic('.$row2["UnitID"].')"><b><font color="red">
              <center>
                <div class="col-md-2">
                  '.$row2["Callsign"].'
                </div>
                <div class="col-md-2">
                  '.$row2["Role"].'
                </div>
                <div class="col-md-2">
                  '.$row2["Member"].'
                </div>
                <div class="col-md-2">
                  '.$row2["Division"].'
                </div>
                <div class="col-md-4">
                  <i>'.$row2["Status"].'</i>
                </div>
              </center></a></font></b>';

            } else {

              $assets = $assets . '

              <a href="javascript:removeFromCall('.$row2["UnitID"].')"><font color="black"><center>
                <div class="col-md-2">
                  '.$row2["Callsign"].'
                </div>
                <div class="col-md-2">
                  '.$row2["Role"].'
                </div>
                <div class="col-md-2">
                  '.$row2["Member"].'
                </div>
                <div class="col-md-2">
                  '.$row2["Division"].'
                </div>
                <div class="col-md-4">
                  <i>'.$row2["Status"].'</i>
                </div>
              </center></font></a>';

            }

          }

        }

		$auth = "";

		$res2 = $conn->query("SELECT * FROM Authority WHERE Incident='".$row["IncidentID"]."' AND Status='Active'");

		if ($res2->num_rows > 0) {

			while ($r2 = $res2->fetch_assoc()) {

				$auth = $auth . '
				<div class="row">
				<div class="col-md-12"><div class="alert alert-danger">'.$r2["Type"].' given by '.$r2["User"].' at '.$r2["Time"].'</div></div>
				</div>
				';

			}

		}

        $divColor = 'dark';
        if ($row["Type"] == "Panic Button") { $divColor = "red-soft"; };

        echo '<div class="portlet box '.$divColor.'" >
          <div class="portlet-title">
            <div class="caption">
              <span class="caption-subject"><small>CAD#'.$row["IncidentID"].' | '.$row["Type"].' | '.$row["Location"].' | '.$label.'</small><br>
            <small>'.$row["Channel"].'</small></span> </div>
              <div class="actions">
                <a href="javascript:details('.$row["IncidentID"].')" class="btn btn-default btn-sm"><font color="white">
                  <i class="fa fa-info"></i> Details
                </a>
                <a href="javascript:authority('.$row["IncidentID"].')" class="btn btn-default btn-sm"><font color="white">
                  <i class="fa fa-bolt"></i> Authority
                </a>
                <a href="javascript:close('.$row["IncidentID"].')" class="btn btn-default btn-sm"><font color="white">
                  <i class="fa fa-times"></i> Close
                </a></font></font></font></font>
              </div>
          </div>
          <div class="portlet-body" ondragover="allowDrop(event)" ondrop="drop'.$row["IncidentID"].'(event)">
		  '.$auth.'
            <div class="row">

              <center>
                <div class="col-md-2">
                  <b>UNIT</b>
                </div>
                <div class="col-md-2">
                  <b>ROLE</b>
                </div>
                <div class="col-md-2">
                  <b>CREW</b>
                </div>
                <div class="col-md-2">
                  <b>DIVISION</b>
                </div>
                <div class="col-md-4">
                  <b>STATUS</b>
                </div>
              </center>
              '.$assets.'
            </div>
          </div>
        </div><br>

        <script>

        function drop'.$row["IncidentID"].'(ev) {

          ev.preventDefault();
          var unit = ev.dataTransfer.getData("unit");
          data = {

            "incident": '.$row["IncidentID"].',
            "unit": unit

          };

          jQuery.post("backend/attach.php", data);

        }

        </script>';

      }

    } else {

      echo("<br><center>There are no active incidents currently.</center><br>");

    }

     ?>
	 <script>

function createIncident() {
    var url = "call999.php?create";
    var w = 700;
    var h = 500;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}

function endPanic(unit) {

  jQuery.post("imdt_endpanic.php?unit=" + unit);

}

function removeFromCall(unit) {

  jQuery.post("imdt_removefromcall.php?unit=" + unit);

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
    var w = 900;
    var h = 600;
    var left = Number((screen.width/2)-(w/2));
    var tops = Number((screen.height/2)-(h/2));
    window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);
}
</script>
  </div>
</div>
