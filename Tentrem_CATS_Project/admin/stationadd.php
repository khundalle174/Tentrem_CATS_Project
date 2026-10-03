<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}
?>
<div class="wrapper">
    <br>
    <h2>Add New Station</h2><br>

    <form class="row g-3" action="stationadd.php" method="post" name="form1">
        <div class="col-md-6">
            <label for="stationid" class="form-label">Station ID</label>
            <input type="text" class="form-control" required name="stationid" id="stationid">
        </div>
        <div class="col-md-6">
            <label for="stationname" class="form-label">Station Name</label>
            <input type="text" class="form-control" required name="stationname" id="stationname">
        </div>
        <div class="col-12">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" required name="location" id="location">
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-primary" name="Submit" value="Add">
        </div>
    </form>
    <?php
    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $stationid = $_POST['stationid'];
        $stationname = $_POST['stationname'];
        $location = $_POST['location'];
        // include database connection file
        include_once("../config.php");
        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO stations(stationid,stationname,location) VALUES('$stationid','$stationname','$location')");
        // Show message when user added
        echo "Station added successfully.<br> <a href='stationlist.php' class=\"btn btn-primary\">View Station</a>";
    }
    ?>
</div>
<?php include '../admin/include/footer.php'; ?>