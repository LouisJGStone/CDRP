<?php

include("backend.php");

getConnection()->query("DELETE FROM Units;");
getConnection()->query("UPDATE Incidents SET Status='Closed' WHERE Status='Open'");

?>