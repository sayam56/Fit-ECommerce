<?php
$conn = mysqli_connect("localhost", "root", "", "fit_ecommerce") or die(mysqli_error($conn));
session_start();

//db connection
// try {
//   $conn = new PDO("mysql:host=localhost;dbname=fit_ecommerce;", 'root', '');
//   echo "<script>console.log('connection successful');</script>";

//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//   echo "<script>window.alert('Database connection error');</script>";
// }

$productCount = 0;

//o by default means not logged in, 1 means logged in
$is_loggedIn = 0;
$username = '';
$user_id = '';
$cartCount = 0;
$notiCount = 0;

if ((isset($_SESSION['user_id']))) {
  $user_id = $_SESSION['user_id'];
}

// print($user_id);
//check if logged in
if (isset($_SESSION['username'])) {
  $is_loggedIn = 1;
  $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat System</title>
  <!-- external stylesheets -->
  <link rel="stylesheet" href="assets/css/chats.css">
  <link rel="stylesheet" href="assets/css/snackbar.css">
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body onLoad="myFunction()">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Consultation With Nutritionist</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Admin/includes/logout.php">Logout</a>
        </li>
        <?php
        $getUser = "SELECT * FROM users WHERE user_id = '$user_id'";
        $getUserStatus = mysqli_query($conn, $getUser) or die(mysqli_error($conn));
        $getUserRow = mysqli_fetch_assoc($getUserStatus);
        ?>
        <li class="nav-item" style="padding-left: 20px;">
          <img src="./dp/profile.png" alt="Profile image" width="40" class="dropdown" />
          <p><span><?php echo $getUserRow['name']; ?></span></p>
        </li>
    </div>
  </nav>

  <!-- chats section -->
  <div class="container mt-4">
    <?php
    include "common/snackbar.php";
    ?>
    <div class="card">
      <div class="card-title text-center">
        <form class="form-inline mt-4" style="display : inline-block" method="POST" action="scripts/search-users.php">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
      <div class="card-body mb-4">
        <?php
        $lastMessage = "SELECT DISTINCT sent_by FROM messages WHERE received_by ='$user_id'";
        $lastMessageStatus = mysqli_query($conn, $lastMessage) or die(mysqli_error($conn));
        if (mysqli_num_rows($lastMessageStatus) > 0) {
          while ($lastMessageRow = mysqli_fetch_assoc($lastMessageStatus)) {
            $sent_by = $lastMessageRow['sent_by'];
            // print($sent_by);
            $getSender = "SELECT * FROM users WHERE user_id='$sent_by'";
            $getSenderStatus = mysqli_query($conn, $getSender) or die(mysqli_error($conn));
            $getSenderRow = mysqli_fetch_assoc($getSenderStatus);
        ?>
            <div class="card">
              <div class="card-body">
                <h6><strong><img src="./dp/profile.png" alt="dp" width="40" /> <?= $lastMessageRow['sent_by']; ?></strong><a href="./message.php?receiver=<?= $sent_by ?>" class="btn btn-outline-primary" style="float:right">Send message</a></h6>
              </div>
            </div><br />
          <?php
          }
        } else {
          ?>
          <div class="card-body text-center">
            <h6><strong>No conversations yet!</strong></h6>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <!-- Scripts -->
  <script src="assets/js/snackbar.js"></script>
</body>

</html>