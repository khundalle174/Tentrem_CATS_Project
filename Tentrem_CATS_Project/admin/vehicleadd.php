<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}

$result2 = mysqli_query($conn, "SELECT * FROM stations ORDER BY stationid DESC");
?>
<div class="wrapper">
    <br>
    <h2>Add New Vehicle</h2><br>

    <form class="row g-3" action="vehicleadd.php" method="post" name="form1">
        <div class="col-md-12">
            <label for="vehicleid" class="form-label">Vehicle ID</label>
            <input type="text" class="form-control" name="vehicleid" required id="vehicleid">
        </div>
        <div class="col-md-6">
            <label for="vehicletype" class="form-label">Vehicle Type</label>
            <select id="vehicletype" name="vehicletype" class="form-select">
                <option>E-Scooter</option>
                <option>Bike</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option>Ready</option>
                <option>IN Use</option>
                <option>Maintenance</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="status" class="form-label">Location</label>
            <?php
            echo '<select id="stationid" name="stationid" class="form-select">';
            while ($row = $result2->fetch_assoc()) {
                echo '<option value="' . $row['stationid'] . '">' . $row['stationname'] . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-primary" name="Submit" value="Add">
        </div>
    </form>
    <?php
    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $vehicleid = $_POST['vehicleid'];
        $vehicletype = $_POST['vehicletype'];
        $status = $_POST['status'];
        $stationid = $_POST['stationid'];
        // include database connection file
        include_once("../config.php");
        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO vehicle(vehicleid,vehicletype,status,stationid) VALUES('$vehicleid','$vehicletype','$status','$stationid')");
        // Show message when user added
        echo "Vehicle added successfully.<br> <a href='vehiclelist.php' class=\"btn btn-primary\">View Vehicle</a>";
    }
    ?>
</div>
<?php include '../admin/include/footer.php'; ?>