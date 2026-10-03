<?php

@include '../config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:../loginmenu/loginindex.php');
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
    <br><h2 id="Rent">Send Your Review</h2><br>
    <section>

        <div class="rent">
        <form action="review.php" method="post" class="row g-3">
                    <div class="col-md-12">
                        <label for="rating" class="form-label">Rate out of 5</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="1">
                            <label class="form-check-label" for="rating">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="2">
                            <label class="form-check-label" for="rating">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="3">
                            <label class="form-check-label" for="rating">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="4">
                            <label class="form-check-label" for="rating">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="5">
                            <label class="form-check-label" checked for="rating">5</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="comment" class="form-label">Comment</label>
                        <input type="text" class="form-control" required name="comment" id="comment">
                    </div>

                    <div class="col-12">
                        <button type="submit" name="Submit" value="Add" class="btn btn-primary">Send Rate</button>
                    </div>

                    <?php
                    // Check If form submitted, insert form data into users table.
                    if (isset($_POST['Submit'])) {
                        $rating = $_POST['rating'];
                        $comment = $_POST['comment'];
                        $fullname = $_SESSION['user_name'];
                        // include database connection file
                        include_once("../config.php");

                        $query = "SELECT userid FROM users WHERE fullname = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('s', $fullname);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $fullname = $result->fetch_object();
                    
                        // Now you can access the user's ID
                        $userid = $fullname->userid;
                        // Insert user data into table
                        $result = mysqli_query($conn, "INSERT INTO reviews(userid, rating,comment,reviewdate) VALUES('$userid', '$rating','$comment',NOW())");
                        // Show message when user added
                        echo "Rate added successfully. <a href='../client/reviewhistory.php' class=\"btn btn-primary\">View reviewhistory</a>";
                    }
                    ?>
                </form>
        </div>

    </section>
    </div>
    <?php include '../client/includes/footer.php'; ?>