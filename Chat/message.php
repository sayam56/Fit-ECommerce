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

//o by default means not logged in, 1 means logged in
$is_loggedIn = 0;
$username = '';
$user_id = '';


if ((isset($_SESSION['user_id']))) {
    $user_id = $_SESSION['user_id'];
}


//check if logged in
if (isset($_SESSION['username'])) {
    $is_loggedIn = 1;
    $username = $_SESSION['username'];
}
$receiver = $_GET['receiver'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat system</title>
    <!-- external stylesheets -->
    <link rel="stylesheet" href="assets/css/chats.css">
    <link rel="stylesheet" href="assets/css/message.css">
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
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
                <li class="nav-item">
                    <img src="./dp/profile.png" alt="Profile image" width="40" class="dropdown" />
                </li>
        </div>
    </nav>
    <div class="container">
        <?php
        $getReceiver = "SELECT * FROM users WHERE user_id = '$receiver'";
        $getReceiverStatus = mysqli_query($conn, $getReceiver) or die(mysqli_error($conn));
        $getReceiverRow = mysqli_fetch_assoc($getReceiverStatus);
        $received_by = $getReceiverRow['user_id'];
        ?>
        <div class="card mt-4">
            <div class="card-header">
                <h6><img src="./dp/profile.png" alt="Profile image" width="40" /><strong> <?= $receiver ?></strong></h6>
            </div>
            <?php
            $getMessage = "SELECT * FROM messages WHERE sent_by = '$receiver' AND received_by = '$user_id' OR sent_by = '$user_id' AND received_by = '$receiver' ORDER BY createdAt asc";
            $getMessageStatus = mysqli_query($conn, $getMessage) or die(mysqli_error($conn));
            if (mysqli_num_rows($getMessageStatus) > 0) {
                while ($getMessageRow = mysqli_fetch_assoc($getMessageStatus)) {
                    $message_id = $getMessageRow['id'];
            ?>
                    <div class="card-body">
                        <h6 style="color: #007bff"><?= $getMessageRow['sent_by'] ?></h6>
                        <div class="message-box ml-4">
                            <p class="text-center"><?= $getMessageRow['message'] ?></p>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="card-body">
                    <p class="text-muted">No messages yet! Say 'Hi'</p>
                </div>
            <?php
            }
            ?>
            <div class="card-footer text-center">
                <form action="scripts/send.php" method="POST" style="display: inline-block">
                    <input type="hidden" name="sent_by" value="<?= $user_id ?>" />
                    <input type="hidden" name="received_by" value="<?= $receiver ?>" />
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" name="message" id="message" class="form-control" placeholder="Type your message here" required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>