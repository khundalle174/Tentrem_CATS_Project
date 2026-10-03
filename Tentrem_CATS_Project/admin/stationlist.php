<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}

$result = mysqli_query($conn, "SELECT * FROM stations ORDER BY stationid DESC");
?>
<div class="wrapper">
    <br>
    <h2>Station List</h2><br>
    <a href="../admin/stationadd.php" type="button" class="btn btn-primary">+ Add More Station</a>
    <!-- untuk home -->
    <sectio>
        <div class="tengah">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Station ID</th>
                        <th scope="col">Station name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($station_data = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $station_data['stationid'] . "</th>";
                        echo "<td>" . $station_data['stationname'] . "</td>";
                        echo "<td>" . $station_data['location'] . "</td>";
                        echo "<td><a href='stationedit.php?stationid=$station_data[stationid]' class=\"btn btn-primary\">Edit</a>  <a href='stationdelete.php?stationid=$station_data[stationid]' class=\"btn btn-danger\">Delete</a></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </section>
</div>

<?php include '../admin/include/footer.php'; ?>