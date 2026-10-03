<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:../loginmenu/loginindex.php');
}

$result = mysqli_query($conn, "SELECT * FROM rentals ORDER BY rentalid DESC");
?>
<div class="wrapper">
    <br>
    <h2>Rent History</h2><br>
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
                        echo "<th scope=\"row\">" . $rental_data['rentalid'] . "</th>";
                        echo "<td>" . $rental_data['userid'] . "</td>";
                        echo "<td>" . $rental_data['vehicletype'] . "</td>";
                        echo "<td>" . $rental_data['vehicleid'] . "</td>";
                        echo "<td>" . $rental_data['stationid'] . "</td>";
                        echo "<td>" . $rental_data['starttime'] . "</td>";
                        echo "<td>" . $rental_data['endtime'] . "</td>";
                        echo "<td>" . $rental_data['status'] . "</td>";
                        echo "<td><a href='renthistorydelete.php?rentalid=$rental_data[rentalid]' class=\"btn btn-danger\">Delete</a></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include '../admin/include/footer.php'; ?>