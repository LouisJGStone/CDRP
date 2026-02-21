<?php

include("backend/functions.php");

$conn = getConnection();
$conn->query("DELETE FROM Units WHERE Machine='".UniqueMachineID()."'");

header("Location: index.php");

 ?>
