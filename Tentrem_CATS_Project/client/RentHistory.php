<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../loginmenu/loginindex.php');
}
$fullname = $_SESSION['user_name'];

$query = "SELECT userid FROM users WHERE fullname = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $fullname);
$stmt->execute();
$result = $stmt->get_result();
$fullname = $result->fetch_object();

// Now you can access the user's ID
$userid = $fullname->userid;

$result = mysqli_query($conn, "SELECT * FROM rentals WHERE userid = $userid ORDER BY starttime DESC");
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
        <br>
        <h2>Your Rent History</h2><br>
        <!-- untuk home -->
        <section>
            <div class="tengah">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Rental ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Vehicle Type</th>
                            <th scope="col">Vehicle ID</th>
                            <th scope="col">Station ID</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rental_data = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $rental_data['rentalid'] . "</td>";
                            echo "<td>" . $rental_data['userid'] . "</td>";
                            echo "<td>" . $rental_data['vehicletype'] . "</td>";
                            echo "<td>" . $rental_data['vehicleid'] . "</td>";
                            echo "<td>" . $rental_data['stationid'] . "</td>";
                            echo "<td>" . date('H:i', strtotime($rental_data['starttime'])) . "</td>";
                            echo "<td>" . ($rental_data['endtime'] ? date('H:i', strtotime($rental_data['endtime'])) : '') . "</td>";
                            echo "<td>" . $rental_data['status'] . "</td>";

                            // Conditionally display the "Done" link based on the rental status
                            if ($rental_data['status'] == 'IN Use') {
                                echo "<td><a href='RentFinish.php?rentalid=$rental_data[rentalid]' class=\"btn btn-primary\">Done</a></td>";
                            } else {
                                echo "<td></td>"; // No action link for statuses other than "In Use"
                            }

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <?php include '../client/includes/footer.php'; ?>