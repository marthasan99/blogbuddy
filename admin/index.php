<?php 
  include "inc/connection.php";
  ob_start();
  session_start();

  if(!empty($_SESSION['u_id'])){
    header('Location: dashboard.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login!</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="assets/images/logo.svg" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>

            <form method='POST'>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
              </div>
              <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="Login">
            </form>
            <?php 
              if(isset($_POST['login'])){
                $email = mysqli_real_escape_string($db, $_POST['email']);
                $password = mysqli_real_escape_string($db, $_POST['password']);

                if(empty($email)){
                  echo "<span class='alert alert-danger'>Email can't be empty.</span>";
                }
                if(empty($password)){
                  echo "<span class='alert alert-danger'>Password can't be empty.</span>";
                }
                if(!empty($email) && !empty($password)){
                  include "inc/connection.php";
                  $hasspassword = sha1($password);
                  $loginQuery = "SELECT * FROM users WHERE u_email='$email'";
                  $loginResult = mysqli_query($db, $loginQuery);
                  while($row = mysqli_fetch_assoc($loginResult)){
                    $_SESSION['u_id']      = $row['u_id'];
                    $_SESSION['u_name']    = $row['u_name'];
                    $_SESSION['u_photo']   = $row['u_photo'];
                    $_SESSION['u_email']   = $row['u_email'];
                    $u_pass                = $row['u_pass'];
                    $_SESSION['u_phone']   = $row['u_phone'];
                    $_SESSION['u_address'] = $row['u_address'];
                    $_SESSION['u_gender']  = $row['u_gender'];
                    $_SESSION['u_dob']     = $row['u_dob'];
                    $_SESSION['u_biodata'] = $row['u_biodata'];
                    $_SESSION['u_role']    = $row['u_role'];
                    $_SESSION['u_status']  = $row['u_status'];
                  }
                  if ($email == $_SESSION['u_email'] && $hasspassword == $u_pass ){
                    header('location: dashboard.php');
                  }else if($email != $_SESSION['u_email'] || $hasspassword != $u_pass ){
                    header('location: index.php');
                  }else{
                    header('location: index.php');
                  }
                }
              }
            ?>
            <a href="#!" class="forgot-password-link">Forgot password?</a>
            <p class="login-wrapper-footer-text">Don't have an account? <a href="registration.php" class="text-reset">Register here</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <?php 
    ob_end_flush();
  ?>
</body>
</html>
