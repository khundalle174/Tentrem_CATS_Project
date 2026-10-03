<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}
?>
<?php
// include database connection file
include_once("../config.php");
if (isset($_POST['update'])) {
    $stationid = $_POST['stationid'];
    $stationname = $_POST['stationname'];
    $location = $_POST['location'];
    // update station data
    $result = mysqli_query($conn, "UPDATE stations SET stationname='$stationname',location='$location' WHERE stationid=$stationid");
    // Redirect to homepage to display updated user in list
    header("Location: stationlist.php");
}
?>

<?php
// Display selected station data based on id
// Getting id from url
$stationid = $_GET['stationid'];
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM stations WHERE stationid=$stationid");
while ($station_data = mysqli_fetch_array($result)) {
    $stationname = $station_data['stationname'];
    $location = $station_data['location'];
}
?>

<div class="wrapper">
    <br>
    <h2>Edit Station</h2><br>

    <form class="row g-3" name="update_station" method="post" action="stationedit.php">
        <div class="col-md-6">
            <label for="stationid" class="form-label">Station ID</label>
            <input type="text" class="form-control" id="stationid" value="<?php echo $stationid; ?>" name="stationid" readonly>
        </div>
        <div class="col-md-6">
            <label for="stationname" class="form-label">Station Name</label>
            <input type="text" class="form-control" id="stationname" value="<?php echo $stationname; ?>" name="stationname">
        </div>
        <div class="col-12">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" value="<?php echo $location; ?>" id="location" name="location">
        </div>
        <div class="col-12">
            <input type="hidden" name="stationid" value=<?php echo $_GET['stationid']; ?>>
            <input type="submit" class="btn btn-primary" name="update" value="Confirm Change">
        </div>
    </form>
</div>
<?php include '../admin/include/footer.php'; ?>