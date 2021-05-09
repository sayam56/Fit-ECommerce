<?php
session_start();

//db connection
try{
    $conn=new PDO("mysql:host=localhost;dbname=fit_ecommerce;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('Database connection error');</script>";
}

$productCount=0;

//o by default means not logged in, 1 means logged in
$is_loggedIn=0; 
$username='';
$user_id='';
$cartCount=0;
$notiCount=0;

if ((isset($_SESSION['user_id'])) ) {
    $user_id=$_SESSION['user_id'];
}


//check if logged in
if (isset($_SESSION['username']) ) {
    $is_loggedIn=1;
    $username=$_SESSION['username'];

    //checkNotifications
    try{
        $sql= "SELECT * FROM `notifications` WHERE user_id='".$user_id."' AND seen='0' ";
        $object=$conn->query($sql);
        $notiCount=$object->rowCount();

    }catch(PDOException $e){
        echo $ex1;
    }


}



if(isset($_SESSION['user_id'])){
    //if the user is logged in
    try{
        $sql2= "SELECT * FROM `cart` WHERE user_id='".$user_id."'";
        $object2=$conn->query($sql2);
        $cartCount=$object2->rowCount();

    }catch(PDOException $e){
        echo $ex1;
    }
}

$con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');
if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
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
            <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <?php include('Humberger.php') ?>
    <!-- Humberger End -->


    <?php include('Header.php') ?>


    
            <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Recipe Videos</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Recipe Videos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="m-b-30">
        <a style="cursor: pointer;">
            <button id="addToTable" onclick="openModal()" style="padding: 5px; margin-left:190px; margin-top: 20px; margin-bottom:-190px;" class="btn btn-success waves-effect waves-light">Add Videos<i class="mdi mdi-plus-circle-outline"></i></button>
        </a>
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
                            <div class="card" style="margin-bottom:35px;">

                                <div class="card-body">
                                    <h4 class="card-tittle"><?php echo $row['Tiitle']; ?></h4>
                                    <iframe class="card-img-top" src="<?php echo $url; ?>">
                                    </iframe>
                                    <?php

                                    ?>
                                    <h5 class="card-tittle"> Posted by : <?php echo $row['username']; ?></h5>
                                    <h5 class="card-tittle"> Calories : <?php echo $row['calorie']; ?></h5>
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
            <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <div id="animation" >
        <div class="modal-header">
            <span class="close">&times;</span>
            
        </div>
        <div class="modal-body">
        <ul class="nav navbar-nav navbar-right">

        <div style="padding-right: 20px;">
            
            <div class="form-popup" id="myForm" >
                <form action="video.php" class="form-container vidForm" method="post" style="text-align: center;">
                    <!-- <h1>ADD video</h1> -->
                    <label for="email"><b>Video Title: </b></label>
                    <input type="text" placeholder="Tittle" name="Video_Tittle" class="modalForm" required>
                        <br>
                    <label for="psw"><b>Video Link: </b></label>
                    <input type="text" placeholder="Enter You Tube Link" name="link" class="modalForm" required>
                    <br>
                    <label for="psw"><b>Calories: </b></label>
                    <input type="number" placeholder="Calories" name="cal" class="modalForm" required>
                    <br>
                    <label for="psw"><b>Video Description: </b></label>
                    <input type="text" placeholder="Video Description" name="des" class="modalForm" required>
                    <br>

                    <button type="submit" class="btn vidAddBtn" name="submitV" style="border: 2px solid black; background: #7fad39;">ADD</button>
                </form>
            </div>
        </div>

</ul>

            
        </div>

    </div><!-- animation -->
</div>

</div> <!-- mymodal ends -->
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

        <?php } ?>


<SCRIPT>
    function openModal(){
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 

        modal.style.display = "block";


        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";

        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    }

</SCRIPT>
    </body>

    </html>
