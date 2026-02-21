<?php

if (isset($_GET["unit"])) {

  include("backend.php");
  getConnection()->query("UPDATE Units SET Status='Available' WHERE UnitID='".$_GET["unit"]."'");
  getConnection()->query("UPDATE Units SET Incident='0' WHERE UnitID='".$_GET["unit"]."'");

}

 ?>
