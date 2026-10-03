<?php include '../admin/include/header.php'; ?>
<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../loginmenu/loginindex.php');
}
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY userid DESC");
?>
<div class="wrapper">
    <br>
    <h2>Users Data</h2><br>
    <!-- untuk home -->
    <section>
        <div class="tengah">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $user_data['userid'] . "</th>";
                        echo "<td>" . $user_data['fullname'] . "</td>";
                        echo "<td>" . $user_data['role'] . "</td>";
                        echo "<td>" . $user_data['email'] . "</td>";
                        echo "<td><a href='userdelete.php?userid=$user_data[userid]' class=\"btn btn-danger\">Delete</a></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include '../admin/include/footer.php'; ?>