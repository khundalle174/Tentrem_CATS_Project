<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}
$result2 = mysqli_query($conn, "SELECT * FROM stations ORDER BY stationid DESC");
?>

<?php
// include database connection file
include_once("../config.php");
if (isset($_POST['update'])) {
    $vehicleid = $_POST['vehicleid'];
    $vehicletype = $_POST['vehicletype'];
    $status = $_POST['status'];
    $stationid = $_POST['stationid'];
    // update station data
    $result = mysqli_query($conn, "UPDATE vehicle SET vehicletype='$vehicletype',status='$status',stationid='$stationid' WHERE vehicleid=$vehicleid");
    // Redirect to homepage to display updated user in list
    header("Location: vehiclelist.php");
}
?>

<?php
// Display selected station data based on id
// Getting id from url
$vehicleid = $_GET['vehicleid'];
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE vehicleid=$vehicleid");
while ($vehicle_data = mysqli_fetch_array($result)) {
    $vehicletype = $vehicle_data['vehicletype'];
}
?>

<div class="wrapper">
    <br>
    <h2>Edit Vehicle</h2><br>

    <form class="row g-3" name="update_station" method="post" action="vehicleedit.php">
        <div class="col-md-12">
            <label for="vehicleid" class="form-label">Vehicle ID</label>
            <input type="text" class="form-control" name="vehicleid" value="<?php echo $vehicleid; ?>" required id="vehicleid" readonly>
        </div>
        <div class="col-md-6">
            <label for="vehicletype" class="form-label">Vehicle Type</label>
            <input type="text" class="form-control" name="vehicletype" value="<?php echo $vehicletype; ?>" id="vehicletype" readonly>
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
            <label for="stationid" class="form-label">Location</label>
            <?php
            echo '<select id="stationid" name="stationid" class="form-select">';
            while ($row = $result2->fetch_assoc()) {
                echo '<option value="' . $row['stationid'] . '">' . $row['stationname'] . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="col-12">
            <input type="hidden" name="vehicleid" value=<?php echo $_GET['vehicleid']; ?>>
            <input type="submit" class="btn btn-primary" name="update" value="Confirm Change">
        </div>
    </form>

</div>
<?php include '../admin/include/footer.php'; ?>