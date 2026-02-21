<!-- Comment Bot-->
<?php

function getCurrentInfo() {
    $res = getConnection()->query("SELECT Incident FROM Units WHERE Machine='".$_SESSION["UserID"]."' LIMIT 1");
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            return $row['Incident'];
        }
    }
    return "";
}

$incident = getCurrentInfo();

if ($incident == 0 || $incident == "0") {
    echo("<br><center><b>You're not currently assigned to an active incident.</b></center><br>");
    return;
}
echo 'Comments for case number: '.$incident;
if (isset($_POST['comment'])) {
    //echo $_POST['comment'];
    $source = "CADView";
    $user = getShortRank($_SESSION["UserID"])." ".getLastName($_SESSION["UserID"]);
    $log = $_POST['comment'];
    $incident = $incident;
    getConnection()->query("INSERT INTO IncidentLogs (Source, User, Log, Incident, Time) VALUES ('".$source."','".$user."','".$log."','".$incident."',now());");
}
?>

<form action="" method="POST" role="form">
  <div class="form-group">
    <textarea name="comment" id="comment" class="form-control" placeholder="your comment" rows="5"></textarea>
  </div>
   <button type="submit" id="addcomment" class="btn uppercase dark btn-block">Add Comment</button>
</form>
