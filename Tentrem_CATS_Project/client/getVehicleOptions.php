<?php
@include '../config.php';

if (isset($_POST['stationID']) && isset($_POST['vehicleType'])) {
    $stationID = $_POST['stationID'];
    $vehicleType = $_POST['vehicleType'];

    // Fetch Vehicle IDs based on the selected Station and Vehicle Type with 'Ready' status
    $result = mysqli_query($conn, "SELECT vehicleid FROM vehicle WHERE stationid = '$stationID' AND vehicletype = '$vehicleType' AND status = 'Ready'");

    $options = '<option value="">Choose Your Vehicle ID</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['vehicleid'] . '">' . $row['vehicleid'] . '</option>';
    }

    echo $options;
} else {
    echo 'Invalid request.';
}
?>