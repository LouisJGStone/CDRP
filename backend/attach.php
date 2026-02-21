<?php

include("functions.php");

attach($_POST["incident"], $_POST["unit"]);

$callsign = "";
$conn = getConnection();
$res = $conn->query("SELECT Callsign FROM Units WHERE UnitID='".$_POST["unit"]."'");

while ($r = $res->fetch_assoc()) {

  $callsign = $r["Callsign"];

}

createLog("CADView", getCurrentInfo("Member"), $callsign . " was attached to the call via CADView.", $_POST["incident"]);

 ?>
