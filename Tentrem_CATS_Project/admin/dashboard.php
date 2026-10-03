<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}
$result1 = mysqli_query($conn, "SELECT * FROM reviews ORDER BY reviewdate");

// Fetch data and store it in PHP arrays
$date = [];
$rate = [];

while ($review_data1 = mysqli_fetch_array($result1)) {
    $date[] = date('M d, H:i', strtotime($review_data1['reviewdate'])); // Format the date to display only the month
    $rate[] = $review_data1['rating'];
}

// Convert PHP arrays to JavaScript-readable format
$date = json_encode($date);
$rate = json_encode($rate);


$result2 = mysqli_query($conn, "SELECT * FROM maintenance ORDER BY maintenanceid DESC");
$result3 = mysqli_query($conn, "SELECT * FROM reviews ORDER BY reviewdate DESC");
?>
<div class="wrapper">
    <!-- untuk home -->
    <section>
        <div class="tengah">
            <p class="deskripsi">Reviews Chart</p>
            <canvas style="width: 100%; height: 300px; margin-top: 50px; margin-bottom: 20px;" id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');
            const date = <?php echo $date; ?>;
            const rate = <?php echo $rate; ?>;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: date,
                    datasets: [{
                        label: '# of Reviews',
                        data: rate,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </section>


    <section>
            <div class="tengah">
                <p class="deskripsi">Reviews Details</p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Review ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($review_data = mysqli_fetch_array($result3)) {
                            echo "<tr>";
                            echo "<th scope=\"row\">" . $review_data['reviewid'] . "</th>";
                            echo "<td>" . $review_data['userid'] . "</td>";
                            echo "<td>" . $review_data['rating'] . "</td>";
                            echo "<td>" . $review_data['comment'] . "</td>";
                            echo "<td>" . $review_data['reviewdate'] . "</td>";
                            echo "<td> <a href='reviewdelete.php?reviewid=$review_data[reviewid]' class=\"btn btn-danger\">Delete</a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </section>
    

    <!-- untuk courses -->
    <section>
        <div class="tengah">
            <p class="deskripsi">Mantenance List</p>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Maintenance ID</th>
                        <th scope="col">Vehicle Type</th>
                        <th scope="col">VehicleID</th>
                        <th scope="col">Maintenance Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($maintenance_data = mysqli_fetch_array($result2)) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $maintenance_data['maintenanceid'] . "</th>";
                        echo "<td>" . $maintenance_data['vehicletype'] . "</td>";
                        echo "<td>" . $maintenance_data['vehicleid'] . "</td>";
                        echo "<td>" . $maintenance_data['maintenancedate'] . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include '../admin/include/footer.php'; ?>