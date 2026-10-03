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

$result = mysqli_query($conn, "SELECT * FROM reviews WHERE userid = $userid ORDER BY reviewdate DESC");
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
        <h2>Previous Review</h2><br>
        <a href="../client/review.php" type="button" class="btn btn-primary">+ Add More Review</a>
        <!-- untuk home -->
        <section>
            <div class="tengah">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Review ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Review Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($review_data = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<th scope=\"row\">" . $review_data['reviewid'] . "</th>";
                            echo "<td>" . $review_data['userid'] . "</td>";
                            echo "<td>" . $review_data['rating'] . "</td>";
                            echo "<td>" . $review_data['comment'] . "</td>";
                            echo "<td>" . $review_data['reviewdate'] . "</td>";
                            echo "<td><a href='reviewdelete.php?reviewid=$review_data[reviewid]' class=\"btn btn-danger\">Delete</a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
    <?php include '../client/includes/footer.php'; ?>