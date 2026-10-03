<?php
// include database connection file
include_once("../config.php");
// Get id from URL to delete that user
$stationid = $_GET['stationid'];
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM stations WHERE stationid=$stationid");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:stationlist.php");
?>