<?php

function getConnection() {

  include("config.php");

  return new mysqli($settings["databaseHost"], $settings["databaseUsername"], $settings["databasePassword"],
                    $settings["databaseName"]);

}

function isDayFull($day) {

  $conn = getConnection();
  $res = $conn->query("SELECT DutyID FROM Duties WHERE Callsign <> 'Control Room' AND Day = '".$day."'");

  if ($res->num_rows >= 32) {

    return true;

  }

  return false;

}

function getDivision($userID = 0) {

  if ($userID == 0) {

    $userID = $_SESSION["UserID"];

  }

  $conn = getConnection();

  $result = $conn->query("SELECT Division FROM Users WHERE UserID='".$userID."' LIMIT 1");

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      return $row["Division"];

    }
  }

  return "";

}

function getFirstName($userID = 0) {

  if ($userID == 0) {

    $userID = $_SESSION["UserID"];

  }

  $conn = getConnection();

  $result = $conn->query("SELECT FirstName FROM Users WHERE UserID='".$userID."' LIMIT 1");

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      return $row["FirstName"];

    }
  }

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

function getRank($userID = 0) {

  if ($userID == 0) {

    $userID = $_SESSION["UserID"];

  }

  $conn = getConnection();

  $result = $conn->query("SELECT Rank FROM Users WHERE UserID='".$userID."' LIMIT 1");

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      return $row["Rank"];

    }
  }

  return "";

}

function isLoggedIn() {

  return isset($_SESSION["UserID"]);

}

function getMyDuties() {

  $id = $_SESSION["UserID"];

  $conn = getConnection();
  $res = $conn->query("SELECT PatrolID,Day FROM Patrols WHERE Enabled='1' ORDER BY Day");

  if ($res->num_rows > 0) {

    while ($row = $res->fetch_assoc()) {

      $dow_text = date('l', strtotime("Monday +{$row["Day"]} days"));

      $res2 = $conn->query("SELECT * FROM Duties WHERE Day='".$row["Day"]."' AND UserID='".$_SESSION["UserID"]."'");

      if ($res2->num_rows > 0) {

        while ($r = $res2->fetch_assoc()) {

          echo "<tr>
          <td>".$dow_text."</td>
          <td>".$r["Callsign"]."</td>
          <td>".$r["Role"]."</td>
          <td>".$r["Vehicle"]."</td>
          <td><a onclick=\"popup_editshift(".$row["Day"].")\" class=\"btn default btn-xs red-stripe\">EDIT DUTY</a></td>
          </tr>";

        }

      } else {

        $day = date("N") - 1;

        if ($row["Day"] < $day) {

          echo "<tr>
          <td>".$dow_text."</td>
          <td>OFF DUTY</td>
          <td>OFF DUTY</td>
          <td>OFF DUTY</td>
          <td><a class=\"btn default btn-xs green-stripe\" disabled>BOOK DUTY</a></td>
          </tr>";

        } else {

          echo "<tr>
          <td>".$dow_text."</td>
          <td>OFF DUTY</td>
          <td>OFF DUTY</td>
          <td>OFF DUTY</td>
          <td><a onclick=\"popup_bookshift(".$row["Day"].")\" class=\"btn default btn-xs green-stripe\">BOOK DUTY</a></td>
          </tr>";

        }

      }

    }

  }

}

function getMembersDetail($id, $table, $value) {

  $conn = getConnection();

  $result = $conn->query("SELECT " . $value . " FROM ".$table." WHERE ID='".$id."'");

  while ($r = $result->fetch_assoc()) {

    return $r[$value];

  }

  return "nilnilnil";

}

function getUserDetail($id, $value) {

  $conn = getConnection();

  $result = $conn->query("SELECT " . $value . " FROM Users WHERE UserID='".$id."'");

  while ($r = $result->fetch_assoc()) {

    return $r[$value];

  }

  return "nilnilnil";

}

function login($username, $password) {

  // echo "SELECT UserID FROM Users WHERE Username='".$username."' AND Password = BINARY '".$password."' LIMIT 1";

  $conn = getConnection();

  $result = $conn->query("SELECT Password,UserID FROM Users WHERE Username='".$username."' LIMIT 1");

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      if (password_verify($password, $row["Password"])) {

        $_SESSION["UserID"] = $row["UserID"];
        $conn->query("UPDATE Users SET LastLogin=now() WHERE UserID='".$_SESSION["UserID"]."'");
        header("Location: index.php");

      }

    }

  }

}

 ?>
