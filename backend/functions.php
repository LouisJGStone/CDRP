<?php

session_start();

// error_reporting(0);

function UniqueMachineID() {
   return $_SESSION["UserID"];
}

function getConnection() {

  return new mysqli("localhost", "central3_fms", "MacyBeth2", "central3_fms");

}

function getShortRank($userID = 0) {
  
    if ($userID == 0) {
  
      $userID = $_SESSION["UserID"];
  
    }
  
    $conn = getConnection();
  
    $result = $conn->query("SELECT ShortRank FROM Users WHERE UserID='".$userID."' LIMIT 1");
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
  
        return $row["ShortRank"];
  
      }
    }
  
    return "";
  
  }


  
function getLastName($userID = 0) {
  
    if ($userID == 0) {
  
      $userID = $_SESSION["UserID"];
  
    }
  
    $conn = getConnection();
  
    $result = $conn->query("SELECT LastName FROM Users WHERE UserID='".$userID."' LIMIT 1");
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
  
        return $row["LastName"];
  
      }
    }
  
    return "";
  
  }

function getIncidentInfo($info, $incident) {

  if (!isset($incident)) {

    $incident = getCurrentInfo("Incident");

  }

  $conn = getConnection();

  $res = $conn->query("SELECT " . $info . " FROM Incidents WHERE IncidentID='".$incident."' LIMIT 1");

  if ($res->num_rows > 0) {

    while ($row = $res->fetch_assoc()) {

      return $row[$info];

    }

  }

  return "";

}

function getCurrentInfo($info) {

  $conn = getConnection();

  $res = $conn->query("SELECT " . $info . " FROM Units WHERE Machine='".UniqueMachineID()."' LIMIT 1");

  if ($res->num_rows > 0) {

    while ($row = $res->fetch_assoc()) {

      return $row[$info];

    }

  }

  return "";

}

function attach($incident, $unit) {

  $conn = getConnection();
  $conn->query("UPDATE Units SET Incident='".$incident."' WHERE UnitID='".$unit."'");
  $conn->query("UPDATE Units SET Status='Informed' WHERE UnitID='".$unit."'");

}

function createIncident($type, $location, $details, $channel, $grade) {

  $conn = getConnection();

  $conn->query("INSERT INTO Incidents (Type, Location, Details, Channel, Grade)

  VALUES ('".$type."','".$location."','".$details."','".$channel."','".$grade."')");

  return $conn->insert_id;

}

function getNextChannel() {

  $channels = ["INC 1", "INC 2", "INC 3", "INC 4", "INC 5", "INC 6"];

  $conn = getConnection();

  foreach ($channels as $each) {

    $res = $conn->query("SELECT IncidentID FROM Incidents WHERE Channel='".$each."' AND Status='Open'");
    if ($res->num_rows > 0) {



    } else {

      return $each;

    }

  }

  return "INC 0";

}

function setIncidentState($incident, $state) {

  $conn = getConnection();
  $conn->query("UPDATE Incidents SET Status='".$state."' WHERE IncidentID='".$incident."'");

}

function createLog($source, $user, $log, $incident) {

  $conn = getConnection();

  $conn->query("INSERT INTO IncidentLogs (Source, User, Log, Incident, Time) VALUES

  ('".$source."','".$user."','".$log."','".$incident."',now());");

}

function isBookedOn() {

  $conn = getConnection();

  $result = $conn->query("SELECT Incident FROM Units WHERE Machine='".UniqueMachineID()."'");

  if ($result->num_rows > 0) {

    return true;

  }

  return false;

}

function isOfficialModeEnabled() {

  $conn = getConnection();
  $result = $conn->query("SELECT Value FROM Settings WHERE Setting='OfficialPatrol'");

  while ($row = $result->fetch_assoc()) {

    if ($row["Value"] == "True") {

      return true;

    } else {

      return false;

    }

  }

  return false;

}

?>
