<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../loginmenu/loginindex.php');
}

if (isset($_POST['Submit'])) {
    $fullname = $_SESSION['user_name'];
    $vehicleid = $_POST['vehicleid'];
    $vehicletype = $_POST['vehicletype'];
    $stationid = $_POST['stationid'];

    include_once("../config.php");
    
    $query = "SELECT userid FROM users WHERE fullname = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $fullname);
    $stmt->execute();
    $result = $stmt->get_result();
    $fullname = $result->fetch_object();

    $userid = $fullname->userid;
    // Check if the user has an ongoing rental
    $checkRentalQuery = "SELECT * FROM rentals WHERE userid = ? AND status = 'IN Use'";
    $stmtCheckRental = $conn->prepare($checkRentalQuery);
    $stmtCheckRental->bind_param('s', $userid);
    $stmtCheckRental->execute();
    $resultCheckRental = $stmtCheckRental->get_result();

    if ($resultCheckRental->num_rows > 0) {
        // User has an ongoing rental, echo response for JavaScript alert
        echo "ongoing_rental";
    } else {
        // User doesn't have an ongoing rental, proceed with starting a new rent

        // Update the vehicle status to 'In Use'
        $updateStatusQuery = "UPDATE vehicle SET status = 'IN Use' WHERE vehicleid = ?";
        $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
        $stmtUpdateStatus->bind_param('s', $vehicleid);
        $stmtUpdateStatus->execute();

        $result = mysqli_query($conn, "INSERT INTO rentals(userid,vehicletype,vehicleid,stationid,starttime) VALUES('$userid', '$vehicletype','$vehicleid','$stationid',NOW())");

        $lastRentalID = mysqli_insert_id($conn);

        $updateStatusQuery = "UPDATE rentals SET Status = 'IN Use' WHERE Rentalid = $lastRentalID";
        $result5 = mysqli_query($conn, $updateStatusQuery);

        // Echo response for JavaScript alert
        echo "success";
    }
}
