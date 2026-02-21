<?php



$state = $_POST["state"];



include("functions.php");



$conn = getConnection();



$previousState = getCurrentInfo("Status");



$conn->query("UPDATE Units SET Status='".$state."' WHERE Machine='".UniqueMachineID()."'");



if ($state == "Available") {



  $conn->query("UPDATE Units SET Incident='0' WHERE Machine='".UniqueMachineID()."'");

  $conn->query("UPDATE Units SET QueueTime=now() WHERE Machine='".UniqueMachineID()."'");



}



if ($state == "Panic" && $previousState != "Panic") {



  if (getCurrentInfo("Incident") == 0) {



  	$incident = createIncident("Panic Button", "UNKNOWN", getCurrentInfo("Callsign") . " has activated their panic button.", "INC 0", "Grade 1");

  	createLog("MDTView", getCurrentInfo("Member"), "Incident created for panic button.", $incident);

  	createLog("MDTView", getCurrentInfo("Member"), getCurrentInfo("Callsign") . " was assigned as the activating officer.", $incident);

  	setIncidentState($incident, "Open");

  	attach($incident, getCurrentInfo("UnitID"));



	getConnection()->query("UPDATE Units SET Incident='".$incident."' WHERE Status='Available'");

  	getConnection()->query("UPDATE Units SET Status='Informed' WHERE Status='Available'");



  } else {

	  

	  getConnection()->query("UPDATE Units SET Incident='".getCurrentInfo("Incident")."' WHERE Status='Available'");

  	getConnection()->query("UPDATE Units SET Status='Informed' WHERE Status='Available'");

	

  }



  $conn->query("UPDATE Units SET Status='Panic' WHERE Machine='".UniqueMachineID()."'");



}



 ?>

