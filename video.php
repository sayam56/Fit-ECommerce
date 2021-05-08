<?php
session_start();

$user_id = $_SESSION['user_id'];
// print($user_id);

$msg = "";
$name = "";
$con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');
if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: http://localhost/Clean_food_healthy_life_ecom/");
} else {
    if (isset($_POST['submitV'])) {
        $Video_Tittle = $_POST['Video_Tittle'];
        $link = $_POST['link'];
        $active = 1;
        $Calories = $_POST['cal'];
        $des = $_POST['des'];
        $query = mysqli_query($con, "INSERT INTO `videos` (`Customer_ID`,`calorie`,`video_link`,`Video_description`,`Tiitle`,`active`) VALUES ('$user_id','$Calories','$link',' $des','$Video_Tittle','$active')");
        print($query);
        if ($query) {
            $msg = "Video Added ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }
?>

    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Ogani Template">
        <meta name="keywords" content="Ogani, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>CleanFood&FitLife</title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>

    <body>
        <?php include('Humberger.php') ?>
        <div class="navbar navbar-default " role="navigation" style="background-color: lawngreen;width: 100%">
            <div class="navbar navbar-default" role="navigation">
                <div class="container">


                    <!-- Navbar-left -->
                    <p style="float: left; padding:20px; display: inline ; margin-right: 10px ">
                        <a href="http://localhost/Clean_food_healthy_life_ecom/index.php" class="logo" "><span>Home<span>Page</span></span><i class=" mdi mdi-layers"></i></a>

                        <a href="#About" class="logo" style="padding-left: 20px;"><span>ABOUT<span>US</span></span><i class="mdi mdi-layers"></i></a>

                        <a href="http://localhost/Clean_food_healthy_life_ecom" class="logo" style="padding-left: 20px;"><span>Log<span>OUT</span></span><i class="mdi mdi-layers"></i></a>
                    </p>
                    <!-- Right(Notification) -->
                    <ul class="nav navbar-nav navbar-right">

                        <div style="float: right" style="padding-right: 20px;">
                            <button class="button-menu-mobile open-right waves-effect" onclick="openForm()" style="padding-left: 20px;">
                                ADD
                            </button>
                        <div class="form-popup" id="myForm">
                            <form action="video.php" class="form-container" method="post">
                                <!-- <h1>ADD video</h1> -->
                                <label for="email"><b>Video Tittle</b></label>
                                <input type="text" placeholder="Tittle" name="Video_Tittle" required>

                                <label for="psw"><b>Video Link</b></label>
                                <input type="text" placeholder="Enter You Tube Link" name="link" required>

                                <label for="psw"><b>Calories</b></label>
                                <input type="number" placeholder="Calories" name="cal" required>

                                <label for="psw"><b>Video Description</b></label>
                                <input type="text" placeholder="Video Description" name="des" required>


                                <button type="submit" class="btn" name="submitV">ADD</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
                        </div>

                        <script>
                            function openForm() {
                                document.getElementById("myForm").style.display = "block";
                            }

                            function closeForm() {
                                document.getElementById("myForm").style.display = "none";
                            }
                        </script>
                        </div>

                    </ul>

                </div>
            </div>
        </div>
        <div class="section-title">
            <h2>Recepie Videos</h2>
        </div>

        <div class="container py-5" style="margin-top: 20px">

            <div class="row mt-4">
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');
                //   $query="SELECT * FROM  Videos ";
                $query = "SELECT Videos.Video_id, Videos.Customer_ID, Videos.video_link,Videos.Video_description,Videos.Tiitle,Videos.calorie, users.username FROM `Videos` INNER JOIN users ON Videos.Customer_ID=users.user_id";
                $result = mysqli_query($con, $query);
                $check_video = mysqli_num_rows($result) > 0;
                if ($check_video) {
                    while ($row = mysqli_fetch_array($result)) {
                        $url = str_replace("watch?v=", "embed/", $row['video_link']);
                ?>

                        <div class="col-md-3">
                            <div class="card">

                                <div class="card-body">
                                    <h2 class="card-tittle"><?php echo $row['Tiitle']; ?></h2>
                                    <iframe class="card-img-top" src="<?php echo $url; ?>">
                                    </iframe>
                                    <?php

                                    ?>
                                    <h3 class="card-tittle"> Posted by : <?php echo $row['username']; ?></h3>
                                    <h3 class="card-tittle"> Calories : <?php echo $row['calorie']; ?></h3>
                                    <!-- <h3 class="card-tittle"> <?php echo $row['Tiitle']; ?></h3> -->
                                    <!-- <h3 class="card-tittle"> <?php echo $row['Video_description']; ?></h3> -->
                                    <!-- <p class="card-text"><?php echo $row['Video_description']; ?></p> -->
                                </div>

                            </div>
                        </div>
                <?php
                        // echo $row[0];
                    }
                } else {
                    echo "No record Found";
                }
                ?>

            </div>

        </div>
        <a name="About"></a>
        <?php include('fotor.php') ?>

        <!-- Js Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>


    </body>

    </html>
<?php } ?>