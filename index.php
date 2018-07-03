<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
 header("Location: admin.php");
 exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

 // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

 if(empty($email)){
  $error = true;
  $emailError = "<div class='alert alert-danger' role='alert'>
                  Please enter your email address.
                </div>";

 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "<div class='alert alert-danger' role='alert'>
                  Please enter valid email address.
                </div>";
 }

 if(empty($pass)){
  $error = true;
  $passError = "<div class='alert alert-danger' role='alert'>
                  Please enter your password.
                </div>";
 }

 // if there's no error, continue to login
 if (!$error) {

  $password = hash('sha256', $pass); // password hashing

  $res=mysqli_query($conn, "SELECT user_ID, userName, userPassword FROM user WHERE userEmail='$email'");
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

  if( $count == 1 && $row['userPassword']==$password ) {
   $_SESSION['user'] = $row['user_ID'];
   header("Location: admin.php");
  } else {
    $errMSG =   "<div class='alert alert-danger' role='alert'>
                  Incorrect Credentials, Try again...
                </div>";

  }

 }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Codereview 10 Welcome to your big library</title>
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!-- GENERAL CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- HEADER CONTAINER -->
  <div class="container-fluid" id="header">
    <!-- OVERLAY -->
    <div class="overlay">
      <!-- NAVBAR -->
      <nav class="navbar navbar-expand-lg navbar-transparent bg-nav">
        <a href="index.html" id="logo-link">
          <img id="logo" src="images/centennialLibraryLogo.png" alt="Logo" class="logo">
          Welcome to your giant library
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </nav> <!-- /NAVBAR -->

      <div class="row row-fix">
        <div class="offset-lg-4 col-lg-4 offset-lg-4 mx-auto login-fix">
          <div class="offset-lg-2 col-lg-6 offset-lg-2 mx-auto text-center">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form">
            <h2 class="text-center heading heading-color">Sign In.</h2>
              <?php
              if ( isset($errMSG) ) {
              echo $errMSG;
              }?>

            <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
            <span class="text-danger"><?php echo $emailError; ?></span>
            <br>
            <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>
            <button type="submit" name="btn-login" class="btn btn-md btn-ice2">Sign In</button>
          </form>
          </div>
          
          <a href="register.php" class="link-style">Please Sign Up Here</a>
        </div>
      </div>
    </div> <!-- /OVERLAY -->
  </div><!-- /HEADER CONTAINER -->
  <div class="container-fluid footer text-center">
    <div class="row pad2">
      <div class="col-lg-12">
        <p class="copyright">&copy;Copyright by Kathrin Renz | All rights reserved</p>
      </div>
    </div>
  </div>
  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- GENERAL JS -->
  <script src="./js/script.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>