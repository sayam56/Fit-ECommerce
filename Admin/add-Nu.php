<?php

session_start();
$msg = "";
$error = "";
$con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');
if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: http://localhost/Clean_food_healthy_life_ecom/login.php");
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    // print($name);
    $email = $_POST['email'];
    // print($email);
    $phone = $_POST['phone'];
    // print($phone);
    $password = $_POST['password'];
    // print($password);
    $usertype = 2;
    // print($usertype);
    $address = $_POST['address'];
    // print($address);
    $nutrition_edu = $_POST['nutrition_edu'];
    // print($nutrition_edu);
    $nutri_experience = $_POST['nutri_experience'];
    // print($nutri_experience);
    $type_user_name = "Nutritionist";
    // print($type_user_name);
    $status = 1;
    //  print($status);
    $username = $_POST['username'];
    

    $query = mysqli_query($con, "insert into users(name,password,email,phone,usertype,address,nutrition_edu,nutri_experience,type_user_name,username,Is_Active) 
                             values('$name','$password','$email','$phone','$usertype','$address','$nutrition_edu','$nutri_experience','$type_user_name','$username','$status')");
    print($query);
   
    if ($query) {
        $msg = "Nutritionanist IS ADDED ";
    } else {
        $error = "Something went wrong . Please try again.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <title>CleanFood&FitLife | Add Category</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--    <link href="assets/css/materialdesignicons.css.map" rel="stylesheet" type="text/css"/>-->
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('includes/topheader.php'); ?>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Add Category</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li>
                                        <a href="#">Nutritionist</a>
                                    </li>
                                    <li class="active">
                                        Add Nutritionist
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Add Nutritionist </b></h4>
                                <hr />


                                <div class="row">
                                    <div class="col-sm-6">
                                        <!---Success Message--->
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success" role="alert">
                                                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                            </div>
                                        <?php } ?>

                                        <!---Error Message--->
                                        <?php if ($error) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>


                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="form-horizontal" name="Nutri" method="post">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="" name="name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="2" name="username" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Email</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="email" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="password" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Contact</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="phone" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Clinc Address</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="address" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Education Qualification</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="nutrition_edu" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Work Experience</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="nutri_experience" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">&nbsp;</label>
                                                <div class="col-md-10">

                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('includes/footer.php'); ?>

        </div>
    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>