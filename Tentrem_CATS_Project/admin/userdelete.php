<?php
// include database connection file
include_once("../config.php");
// Get id from URL to delete that user
$userid = $_GET['userid'];
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM users WHERE userid=$userid");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:userdata.php");
?>