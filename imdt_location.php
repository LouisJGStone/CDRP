<?php

include("backend.php");

getConnection()->query("UPDATE Units SET X='".$_GET["x"]."' WHERE Machine='".$_GET["id"]."'");
getConnection()->query("UPDATE Units SET Y='".$_GET["y"]."' WHERE Machine='".$_GET["id"]."'");
getConnection()->query("UPDATE Units SET Z='".$_GET["z"]."' WHERE Machine='".$_GET["id"]."'");

 ?>