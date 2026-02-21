<table>
    <thead>
        <tr>
            <th>#</th>
            <th>VRN</th>
            <th>Investigating Officer</th>
            <th>Reporting Officer</th>
            <th>What Occurd</th>
            <th>State</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        
$con = mysqli_connect('localhost','central3_fms','MacyBeth2','central3_fms');
$result = mysqli_query($conn, "SELECT * FROM polcol");

while ($row = mysqli_fetch_assoc($result)):
    ?>
    
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['vrn']; ?></td>
        <td><?php echo $row['invoff']; ?></td>
        <td><?php echo $row['officer']; ?></td>
        <td><?php echo $row['what']; ?></td>
        <td><?php echo $row['state']; ?></td>
    </tr>
    
    <?php endwhile ?>
    
    </tbody>
</table>