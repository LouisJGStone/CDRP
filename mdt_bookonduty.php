<?php



if (isset($_GET["book"])) {



  include("backend.php");

  include("config.php");



  session_start();



  $day = date("N") - 1;



  $res = getConnection()->query("SELECT * FROM Duties WHERE UserID='".$_SESSION["UserID"]."' AND Day='".$day."'");



  while ($r = $res->fetch_assoc()) {



    getConnection()->query("INSERT INTO Units (Member, Division, Callsign, Role, Vehicle, Machine) VALUES ('".getShortRank($r["UserID"])." ".getLastName($r["UserID"])."',

    '".$r["Division"]."','".$r["Callsign"]."','".$r["Role"]."','".$r["Vehicle"]."','".$r["UserID"]."')");

    header("Location: mdt.php");

    die();



  }



}



$day = date("N") - 1;

$hasShift = getConnection()->query("SELECT UserID FROM Duties WHERE UserID='".$_SESSION["UserID"]."' AND Day='".$day."'")->num_rows > 0 ? true : false;



if (!$hasShift) {



  echo('<div class="row"><div class="col-md-12"><div class="note note-danger"><h4 class="block">No shift booked!</h4> <p>The system has detected that you haven\'t booked a shift - make sure you do!</p></div></div></div>'); die();



}



$hour = date("G");

$minute = date("i");



if ($hour < "19") {



  // echo('<div class="row"><div class="col-md-12"><div class="note note-danger"><h4 class="block">No patrol yet, my friend!</h4> <p>The patrol starts at 19:30!</p></div></div></div>'); die();



}





echo '



<div class="row">

<div class="col-md-12">

  <div class="col-md-12">

    <div class="tiles">

    <a class="tile bg-green-jungle" href="mdt_bookonduty.php?book">

      <div class="tile-body">

      <i class="fa fa-sign-in"></i>

      </div>

      <div class="tile-object">

        <div class="name">

          Book On Duty

        </div>

      </div>

    </a>

    </div>

  </div>

</div>

</div>



';



 ?>

