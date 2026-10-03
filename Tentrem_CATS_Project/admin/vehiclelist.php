<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}

$result = mysqli_query($conn, "SELECT * FROM vehicle ORDER BY vehicleid DESC");
$result2 = mysqli_query($conn, "SELECT * FROM stations ORDER BY stationid DESC");
?>
<div class="wrapper">
    <br>
    <h2>Vehicle List</h2><br>
    <a href="../admin/vehicleadd.php" type="button" class="btn btn-primary">+ Add More Vehicle</a>
    <!-- untuk home -->
    <section>
        <div class="tengah">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Vehicle ID</th>
                        <th scope="col">Vehicle Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last Location</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($vehicle_data = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $vehicle_data['vehicleid'] . "</th>";
                        echo "<td>" . $vehicle_data['vehicletype'] . "</td>";
                        echo "<td>" . $vehicle_data['status'] . "</td>";
                        $stationId = $vehicle_data['stationid'];
                        $stationQuery = "SELECT stationname FROM stations WHERE stationid = ?";
                        $stmt = $conn->prepare($stationQuery);
                        $stmt->bind_param('i', $stationId);
                        $stmt->execute();
                        $resultStation = $stmt->get_result();
                        $stationData = $resultStation->fetch_assoc();
                        $stationName = $stationData['stationname'];

                        echo "<td>" . $stationName . "</td>";

                        echo "<td><a href='vehicleedit.php?vehicleid=$vehicle_data[vehicleid]' class=\"btn btn-primary\">Edit</a> <a href='vehicledelete.php?vehicleid=$vehicle_data[vehicleid]' class=\"btn btn-danger\">Delete</a></td></tr>";   
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include '../admin/include/footer.php'; ?>