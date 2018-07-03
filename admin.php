
<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
// select logged-in users detail
$res=mysqli_query($conn, "SELECT * FROM user WHERE user_ID=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Codereview 10_Big Library</title>
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!-- GENERAL CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- HEADER CONTAINER -->
  <div class="container-fluid" id="header2">
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
              <a class="nav-link" href="logout.php?logout">Logout</a>
            </li>
          </ul>
        </div>
      </nav> <!-- /NAVBAR -->
    </div> <!-- /OVERLAY -->
  </div><!-- /HEADER CONTAINER -->
  <div class="container-fluid abstand">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2>Welcome <?php echo $userRow['userName']; ?></h2>
        <table class="table">
          <thead>
            <tr>
              <td>Image</td>
              <td>Title</td>
              <td>Type</td>
              <td>Description</td>
              <td>Status</td>
              <td>Publisher</td>
              <td>Author</td>
              <td>Genre</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = '
              SELECT media.mediaImage, media.mediaTitle, media.mediaType, media.mediaDescription, status.statusType, publisher.publisherName, author.authorFirstName, author.authorLastName, genre.genreType FROM media 
              LEFT JOIN status ON status.status_ID = media.fk_status_ID
              LEFT JOIN publisher ON publisher.publisher_ID = media.fk_publisher_ID
              LEFT JOIN author ON author.author_ID = media.fk_author_ID
              LEFT JOIN genre ON genre.genre_ID = media.fk_genre_ID';

              $result = mysqli_query( $conn, $sql );
               
              if(! $result ) {
                die('Could not get data: ' . mysqli_error());
              }
               
              while($row = mysqli_fetch_array($result)) {
                echo "<tr><td><img class='img-fix' src='" . $row['mediaImage'] . "'></td>".
                     "<td>" . $row['mediaTitle'] . "</td>".
                     "<td>" . $row['mediaType'] . "</td>".
                     "<td>" . $row['mediaDescription'] . "</td>".
                     "<td>" . $row['statusType'] . "</td>" . 
                     "<td>" . $row['publisherName'] . "</td>". 
                     "<td>" . $row['authorFirstName'] . " " .  $row['authorLastName'] . "</td>". 
                     "<td>" . $row['genreType'] . "</td>";}

              // Free result set
              mysqli_free_result($result);
              // Close connection
              mysqli_close($conn);
            ?>


          </tbody>
        </table>
      </div>
    </div>
  </div>
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