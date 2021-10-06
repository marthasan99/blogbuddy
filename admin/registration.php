<?php 
    include "inc/connection.php";
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
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
            <h1 class="login-title">Sign Up</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Type your full name*">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
                    </div>
                    <div class="form-group mb-4">
                        <label for="cpassword">Password</label>
                        <input type="password" name="confirmpassword" id="cpassword" class="form-control" placeholder="Confirm your password">
                    </div>
                    <input name="register" class="btn btn-block login-btn" type="submit" value="Register Now">
                </form>
                <?php 
                    if(isset($_POST['register'])){
                        $name            = mysqli_real_escape_string($db, $_POST['name']); 
                        $email           = mysqli_real_escape_string($db, $_POST['email']);
                        $password        = mysqli_real_escape_string($db, $_POST['password']);
                        $confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);

                        if($password==$confirmpassword){
                            include "inc/connection.php";
                            $hasspassword = sha1($password);
                            $regquery = "INSERT INTO users (u_name, u_email, u_pass) VALUES ('$name', '$email', '$hasspassword')";
                            $regresult = mysqli_query($db,$regquery);

                            if($regresult){
                                header('Location: index.php');
                            }else{
                                die('registration Error '.mysqli_error($db));
                            }                            
                        }else{
                            echo "<span class= 'alert alert-denger'>Password Not Matched!</span>";
                        }
                        
                    }
                ?>
            <p class="login-wrapper-footer-text">Already have an account? <a href="login.php" class="text-reset">Click here</a></p>
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
  <?php ob_end_flush(); ?>
</body>
<?php 

?>
</html>
