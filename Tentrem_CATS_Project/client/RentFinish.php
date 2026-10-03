<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../loginmenu/loginindex.php');
}
$result1 = mysqli_query($conn, "SELECT * FROM stations ORDER BY stationid DESC");
$result2 = mysqli_query($conn, "SELECT * FROM rentals ORDER BY starttime DESC");
?>

<?php
// include database connection file
include_once("../config.php");
if (isset($_POST['update'])) {
    $rentalid = $_POST['rentalid'];
    $vehicleid = $_POST['vehicleid'];
    $vehicletype = $_POST['vehicletype'];
    $stationid = $_POST['stationid'];
    $statusv = $_POST['statusv'];
    $statusr = $_POST['statusr'];
    // Update the vehicle
    $result = mysqli_query($conn, "UPDATE vehicle SET vehicletype='$vehicletype',stationid='$stationid',status='$statusv' WHERE vehicleid=$vehicleid");


    $result = mysqli_query($conn, "UPDATE rentals SET vehicletype='$vehicletype',stationid='$stationid' ,status='$statusr' WHERE rentalid=$rentalid");
    $updateEndTimeQuery = "UPDATE rentals SET endtime = NOW(), Status = 'Completed' WHERE rentalid = $rentalid";
    $result = mysqli_query($conn, $updateEndTimeQuery);
   
    // Redirect to homepage to display updated user in list
    header("Location: RentHistory.php");
}
?>

<?php
// Display selected station data based on id
// Getting id from url
$rentalid = $_GET['rentalid'];
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM rentals WHERE rentalid=$rentalid");
while ($rental_data = mysqli_fetch_array($result)) {
    $vehicletype = $rental_data['vehicletype'];
    $vehicleid = $rental_data['vehicleid'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin home</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><img src="../img/Logo.png" alt="" class="img" /></div>
            <div class="menu">
                <ul>
                    <li><a href="../client/home.php">Home</a></li>
                    <li><a href="../client/home.php">How To Use</a></li>
                    <li><a href="../client/home.php">Start Rent</a></li>
                    <li><a href="../client/home.php">Reviews</a></li>
                    <li><a href="../client/RentHistory.php">Rent History</a></li>
                    <li><a href="../loginmenu/logout.php" class="tbl-pink">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <h2 id="Rent">Finish Your Rent</h2>
        <section>
            <div class="rent">
                <form class="row g-3" name="update_rent" method="post" action="RentFinish.php">
                    <div class="col-md-12">
                        <label for="stationid" class="form-label">Final Station Location</label>
                        <?php
                        echo '<select id="stationid" name="stationid" class="form-select">';
                        while ($row = $result1->fetch_assoc()) {
                            $stationValue = $row['stationid'];
                            $stationText = $row['stationname'] . ' - ' . $row['location'];
                            echo '<option value="' . $stationValue . '">' . $stationText . '</option>';
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicletype" class="form-label">Vehicle Type</label>
                        <input type="text" class="form-control" name="vehicletype" value="<?php echo $vehicletype; ?>" id="vehicletype" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleid" class="form-label">Vehicle ID</label>
                        <input type="text" class="form-control" name="vehicleid" value="<?php echo $vehicleid; ?>" id="vehicleid" readonly>
                    </div>

                    <input type="hidden" name="statusv" value="Ready">
                    <input type="hidden" name="statusr" value="Finish">
                    <input type="hidden" name="rentalid" value=<?php echo $_GET['rentalid']; ?>>
                    <input type="submit" class="btn btn-primary" name="update" value="Finish Renting">

                </form>
            </div>

        </section>

    </div>
    <?php include '../client/includes/footer.php'; ?>