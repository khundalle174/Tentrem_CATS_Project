<?php
// include database connection file
include_once("../config.php");
// Get id from URL to delete that user
$reviewid = $_GET['reviewid'];
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM reviews WHERE reviewid=$reviewid");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:dashboard.php");
?>