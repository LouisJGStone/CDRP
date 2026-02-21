<?php 
    include_once("backend/functions.php");

    $conn = getConnection();

    $IncidentID = $_GET['incNum'];

            $result = $conn->query("SELECT * FROM Incidents WHERE IncidentID=$IncidentID");

            while ($row = $result->fetch_assoc()) { ?> 
                <div class="row">
                <div class="col-md-9">
                    <div class='mt-element-ribbon bg-grey-steel'>
                        <div class='ribbon ribbon-shadow ribbon-color-<?php if($row["Status"]=="Open"){echo"success";}else{echo"danger";};?> uppercase'>Status: <?php echo $row["Status"]; ?></div>
                        <p class='ribbon-content'>
                        <?php 
                            $res = $conn->query("SELECT * FROM IncidentLogs WHERE Incident=$IncidentID ORDER BY Time ASC");

                            while ($r = $res->fetch_assoc()) {
                                $logs = $logs . "<tr><td>".$r["Time"]."</td><td>".$r["Log"]."</td><td>".$r["Source"]."</td><td>".$r["User"]."</td></tr>";
                            }

                            echo"<b>Incident Log's</b>
                            <table class='table table-hover'><thead><th>Time</th><th>Log</th><th>Source</th><th>User</th></thead><tbody>$logs<tbody></table>"
                        ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                <?php
                        echo "<div class='mt-element-ribbon bg-grey-steel'>
                        <p class='ribbon-content'>
                        <strong>Type:</strong> ". $row["Type"]."</br></br>
                        <strong>Location:</strong> ". $row["Location"]."</br></br>
                        <strong>Borough:</strong> ". $row["Borough"]."</br></br>
                        <strong>Details:</strong> ". $row["Details"]."</br></br>
                         <strong>Cad Notes:</strong> ". $row["Notes"]."</br></br>
                        <strong>Inc Channel:</strong> ". $row["Channel"]."</br></br>
                        <strong>Grade:</strong> ". $row["Grade"]."</br></br>
                        </p>
                        </div>";
                    }

?></div> </div>