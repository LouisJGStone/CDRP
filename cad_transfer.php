<?php

include("backend.php");

if (isset($_POST["incident"])) {

	getConnection()->query("UPDATE Incidents SET Status='Open' WHERE IncidentID='".$_POST["incident"]."'");

}

 ?>