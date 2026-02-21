<?php

include("functions.php");
$conn = getConnection();

$conn->query("UPDATE Incidents SET Status='Closed' WHERE IncidentID='".$_POST["incident"]."'");
$conn->query("UPDATE Units SET Status='Available' WHERE Incident='".$_POST["incident"]."'");

 ?>
