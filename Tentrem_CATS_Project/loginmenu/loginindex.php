<?php

@include '../config.php';

session_start();

if (isset($_POST['submit'])) {

  $userid = mysqli_real_escape_string($conn, $_POST['userid']);

  $password = md5($_POST['password']);


  $select = " SELECT * FROM users WHERE userid = '$userid' && password = '$password' ";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_array($result);

    if ($row['role'] == 'Staff') {

      $_SESSION['admin_name'] = $row['fullname'];
      header('location:../admin/dashboard.php');
    } elseif ($row['role'] == 'Student') {

      $_SESSION['user_name'] = $row['fullname'];
      header('location:../client/home.php');
    }
  } else {
    $error[] = 'incorrect email or password!';
  }
};

if (isset($_POST['submit1'])) {

  $userid = mysqli_real_escape_string($conn, $_POST['userid']);
  $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
  $role = $_POST['role'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = md5($_POST['password']);


  $select = " SELECT * FROM users WHERE userid = '$userid' && email = '$email' && password = '$password'  ";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    $error[] = 'user already exist!';
  } else {
    $insert = "INSERT INTO users(userid, fullname, role, email, password) VALUES('$userid','$fullname','$role','$email','$password')";
    mysqli_query($conn, $insert);
    header('location:loginindex.php');
  }
};?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tentrem Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../loginmenu/css/styles.css?v=<?php echo time(); ?>">
</head>

<body>
  <nav>
    <div class="wrapper">
      <div class="logo"><img src="../img/Logo.png" alt="" class="img" /></div>
      <div class="menu">
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../index.php">About</a></li>
          <li><a href="../index.php">Teams</a></li>
          <li><a href="../index.php">Sponsors</a></li>
          <li><a href="../index.php">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <form action="" method="post">
                        <h4 class="mb-4 pb-3" style="color: #364f6b">Log In</h4>
                        <?php
                        if (isset($error)) {
                          foreach ($error as $error) {
                            echo '<span class="error-msg">' . $error . '</span>';
                          };
                        };
                        ?>
                        <div class="form-group">
                          <input type="text" class="form-style" name="userid" required placeholder="ID number">
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="password" class="form-style" name="password" required placeholder="Password">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <input type="submit" name="submit" value="login" class="btn mt-2">
                      </form>
                    </div>
                  </div>
                </div>

                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <form action="" method="post">
                        <h4 class=" mt-3" style="color: #364f6b">Sign Up</h4>
                        <div class="form-group">
                          <input type="text" class="form-style" name="userid" required placeholder="ID number">
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="text" class="form-style" name="fullname" required placeholder="Full Name">
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <select class="form-style" id="role" name="role" required>
                            <option selected>Select Role</option>
                            <option>Student</option>
                            <option>Staff</option>
                          </select>
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="email" class="form-style" name="email" required placeholder="Email">
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="password" class="form-style" name="password" required placeholder="Password">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <input type="submit" name="submit1" value="Register" class="btn mt-2">
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="contact">
    <div class="wrapper">
      <div class="footer">
        <div class="footer-section">
          <h3>CATS.</h3>
          <p>A name we choose because we like cats and compatible for our project :D</p>
        </div>
        <div class="footer-section">
          <h3>About</h3>
          <p>Tentrem is a team created from informatics IP class to create a web based application.</p>
        </div>
        <div class="footer-section">
          <h3>Contact</h3>
          <p>Kaliurang St No.Km. 14,5, Krawitan, Umbulmartani, Ngemplak, Sleman Regency, DIYogyakarta</p>
          <p>Post Code: 55584</p>
        </div>
        <div class="footer-section">
          <h3>Social</h3>
          <p><b>Instagram: </b>@Tentrem_ProjectTeam</p>
        </div>
      </div>
    </div>
  </div>

  <div id="copyright">
    <div class="wrapper">
      &copy; 2023. <b>Tentrem.</b> All Rights Reserved.
    </div>
  </div>

</body>

</html>