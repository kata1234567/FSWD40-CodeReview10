<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['user'])!="" ){
 header("Location: admin.php"); // redirects to admin.php
}
include_once 'dbconnect.php';
$error = false;
if ( isset($_POST['btn-signup']) ) {

 // sanitize user input to prevent sql injection
 $name = trim($_POST['name']);
 $name = strip_tags($name);
 $name = htmlspecialchars($name);

 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);

 // basic name validation
 if (empty($name)) {
  $error = true;
  $nameError = "<div class='alert alert-danger' role='alert'>
                  Please enter your full name.
                </div>";
 } else if (strlen($name) < 3) {
  $error = true;
  $nameError = "<div class='alert alert-danger' role='alert'>
                  Name must have at least 3 characters.
                </div>";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  $error = true;
  $nameError = "<div class='alert alert-danger' role='alert'>
                  Name must contain alphabets and space.
                </div>";
 }

 //basic email validation
 if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "<div class='alert alert-danger' role='alert'>
                  Please enter valid email address.
                </div>";
 } else {
  // check whether the email exist or not
  $query = "SELECT userEmail FROM user WHERE userEmail='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);
  if($count!=0){
   $error = true;
   $emailError = "<div class='alert alert-danger' role='alert'>
                  Provided Email is already in use.
                </div>";
  }
 }
 // password validation
 if (empty($pass)){
  $error = true;
  $passError = "<div class='alert alert-danger' role='alert'>
                  Please enter your privat password.
                </div>";
 } else if(strlen($pass) < 6) {
  $error = true;
  $passError = "<div class='alert alert-danger' role='alert'>
                  Your choosen password must have at least 6 characters.
                </div>";
 }

 // password hashing for security
$password = hash('sha256', $pass);

 // if there's no error, continue to signup
 if( !$error ) {

  $query = "INSERT INTO user(userName,userEmail,userPassword) VALUES ('$name','$email','$password')";
  $res = mysqli_query($conn, $query);

  if ($res) {
   $errTyp = "success";
   $errMSG = "<div class='alert alert-danger' role='alert'>
                  Welcome. You are loged in. 
                </div>";
   unset($name);
   unset($email);
   unset($pass);
   header("location: index.php");
  } else {
   $errTyp = "danger";
   $errMSG = "<div class='alert alert-danger' role='alert'>
                  Sorry a failure occure. We will work on it. Please try it again.
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
  <title>Codereview 10_Welcome to your big library</title>
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
            <h2 class="text-center heading heading-color">Sign Up.</h2>
              <?php
              if ( isset($errMSG) ) {
              }?>
              <div class="alert alert-<?php echo $errTyp ?>">
                <?php echo $errMSG; ?>
              </div>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
            <span class="text-danger"><?php echo $nameError; ?></span>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"><?php echo $emailError; ?></span>
            <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>
            <button type="submit" name="btn-signup" class="btn btn-md btn-ice2">Sign Up</button>
          </form>
          </div>
          
          <a href="index.php" class="link-style">Sign in Here...</a>
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

