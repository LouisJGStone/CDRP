<?php

if (isset($_GET["unit"])) {

  include("backend.php");
  getConnection()->query("UPDATE Units SET Status='On Scene' WHERE UnitID='".$_GET["unit"]."'");

}

 ?>
