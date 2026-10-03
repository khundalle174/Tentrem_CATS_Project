<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:../loginmenu/loginindex.php');
}

$result1 = mysqli_query($conn, "SELECT * FROM reviews ORDER BY reviewdate DESC");
$result2 = mysqli_query($conn, "SELECT * FROM stations ORDER BY stationid DESC");
$result3 = mysqli_query($conn, "SELECT * FROM vehicle ORDER BY vehicleid DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin home</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><img src="../img/Logo.png" alt="" class="img" /></div>
            <div class="menu">
                <ul>
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#How">How To Use</a></li>
                    <li><a href="#Rent">Start Rent</a></li>
                    <li><a href="#Review">Reviews</a></li>
                    <li><a href="../client/RentHistory.php">Rent History</a></li>
                    <li><a href="../loginmenu/logout.php" class="tbl-pink">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">

        <section id="Home">
            <div class="jumbotron">
                <b class="hometext" style="font-size: 1.2em;">WELCOME TO</b>
                <h1 class="hometext"><b>CAMPUS TRANSPORTATION SYSTEM</b></h1>
                <b class="hometext" style="font-size: 1.2em;">Hello <?php echo $_SESSION['user_name'] ?></b><br><br>
                <p><a href="#How" class="tbl-biru">Get Started</a></p>
            </div>

        </section>

        <section id="How">
            <div class="tengah">
                <div class="kolom">
                    <h2>How To Use</h2>
                    <p>Pay Attention To This Guide To use our App Correctly!</p>
                </div>

                <div class="tutor-list">
                    <div class="kartu-tutor">
                        <p class="par">#1</p>
                        <img class="pic" src="../client/img/station.png" />
                        <p class="deskripsi">Choose Station near at you</p>
                    </div>
                    <div class="kartu-tutor">
                        <p class="par">#2</p>
                        <img class="pic" src="../client/img/Scooter-Bike.png" />
                        <p class="deskripsi">Choose Vehicle Type you want to use</p>
                    </div>
                    <div class="kartu-tutor">
                        <p class="par">#3</p>
                        <img class="pic" src="../client/img/available.png" />
                        <p class="deskripsi">Choose The Available Vehicle</p>
                    </div>
                    <div class="kartu-tutor">
                        <p class="par">#4</p>
                        <img class="pic" src="../client/img/person.png" />
                        <p class="deskripsi">Take Your Vehilce At the Station</p>
                    </div>
                </div>
            </div>
        </section>
        <h2 id="Rent">Start Your Rent</h2>
        <section>

            <div class="rent">
                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="stationid" class="form-label">Choose Station Location</label>
                        <?php
                        echo '<select id="stationid" name="stationid" class="form-select" onchange="updateVehicleIDs()">';
                        echo '<option>Choose Your Station</option>';
                        while ($rowe = $result2->fetch_assoc()) {
                            $stationValue = $rowe['stationid'];
                            $stationText = $rowe['stationname'] . ' - ' . $rowe['location'];
                            echo '<option value="' . $stationValue . '">' . $stationText . '</option>';
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicletype" class="form-label"> Choose Vehicle Type</label>
                        <select id="vehicletype" name="vehicletype" class="form-select" onchange="updateVehicleIDs()">
                            <option>Choose Your Vehicle Type</option>
                            <option>E-Scooter</option>
                            <option>Bike</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleid" class="form-label">Choose Vehicle ID</label>
                        <select id="vehicleid" name="vehicleid" class="form-select"></select>
                    </div>

                    <input type="button" class="btn btn-primary" id="startRent" value="Start Rent">

                </form>
            </div>
            <script>
                $(document).ready(function() {
                    // Handle the change event of the Station and Vehicle Type dropdowns
                    $('#stationid, #vehicletype').change(function() {
                        // Fetch the relevant Vehicle IDs based on the selected Station and Vehicle Type
                        updateVehicleOptions();
                    });

                    // Handle the click event of the Start Rent button
                    $('#startRent').click(function() {
                        // Your existing code for starting the rent
                        // ...
                        // Make an AJAX request to start_rent.php
                        $.ajax({
                            type: 'POST',
                            url: 'start_rent.php', // Adjust the path if needed
                            data: {
                                Submit: true,
                                vehicleid: $('#vehicleid').val(),
                                vehicletype: $('#vehicletype').val(),
                                stationid: $('#stationid').val()
                            },
                            // Inside your AJAX success function
                            success: function(response) {
                                if (response === 'success') {
                                    // Update the Vehicle ID options after starting the rent
                                    updateVehicleOptions();

                                    // Display a success message or perform any other actions
                                    alert('Rent started successfully! To Finish Go To Rent History!');
                                } else if (response === 'ongoing_rental') {
                                    // Display an alert for ongoing rental
                                    alert('You Already Rent a vehicle, to Finish Go To Rent History!');
                                } else {
                                    // Handle other responses or errors
                                    console.error('Error starting rent:', response);
                                }
                            },
                            error: function(error) {
                                console.error('AJAX error:', error);
                            }
                        });
                    });

                    // Function to fetch and update Vehicle ID options based on selected Station and Vehicle Type
                    function updateVehicleOptions() {
                        var stationID = $('#stationid').val();
                        var vehicleType = $('#vehicletype').val();

                        // Fetch Vehicle IDs based on the selected Station and Vehicle Type
                        $.ajax({
                            url: 'getVehicleOptions.php', // Create a new PHP file to handle the AJAX request
                            type: 'POST',
                            data: {
                                stationID: stationID,
                                vehicleType: vehicleType
                            },
                            success: function(data) {
                                // Update the Vehicle ID dropdown with the fetched options
                                $('#vehicleid').html(data);
                            }
                        });
                    }
                });
            </script>
        </section>

        <section id="Review">
            <div class="row">
                <div class="tengah">
                    <h2>Review Form Users</h2>
                    <p>Dont Forget To Give Us Review So We Can Improve Our Service! :D</p>
                    <p><a href="../client/review.php" class="tbl-biru">Create A Review</a> <a href="../client/reviewhistory.php" class="tbl-biru">See Your Review</a></p>

                </div>
                <?php
                $i = 0;
                while ($review = mysqli_fetch_array($result1)) {
                    if ($i >= 3) {
                        break;
                    } else {
                        echo "<div class=\"col-sm-4\">";
                        echo "<div class=\"card\">";
                        echo "<div class=\"card-body\">";
                        echo "<h5 class=\"card-title\">RATE: " . $review['rating'] . "/5</h5>";
                        echo "<p class=\"card-text\">From ID: " . $review['userid'] . "</p>";
                        echo "<p class=\"card-text\">" . $review['comment'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $i++;
                    }
                }

                ?>

            </div>
        </section>

    </div>
    <?php include '../client/includes/footer.php'; ?>