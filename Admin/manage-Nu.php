<?php
session_start();
$msg = "";
$error = "";
$delmsg = "";
$con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');

if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: http://localhost/Clean_food_healthy_life_ecom/login.php");
} else {
    if (isset($_GET['action']) && $_GET['action'] == 'del' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "update users set Is_Active='0' where user_id='$id' AND usertype=2");
        $msg = "Nutritionist deleted ";
    }
    // Code for restore
    if (isset($_GET['resid'])) {
        $id = intval($_GET['resid']);
        $query = mysqli_query($con, "update users set Is_Active='1' where user_id='$id' AND usertype=2");
        $msg = "Nutritionist restored successfully";
    }

    // Code for Forever deletionparmdel
    if (isset($_GET['action']) && $_GET['action'] == 'parmdel' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "delete from  users  where user_id='$id' AND usertype=2");
        $delmsg = "Nutritionist deleted forever";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>CleanFood&FitLife | Manage Nutritionist List</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!--        <link href="assets/css/materialdesignicons.css.map" rel="stylesheet" type="text/css"/>-->
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

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Manage Nutritionist</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Nutritionist </a>
                                        </li>
                                        <li class="active">
                                            Manage Nutritionist
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($delmsg); ?>
                                    </div>
                                <?php } ?>


                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <a href="add-Nu.php">
                                                <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>Phone No</th>
                                                        <th>Address</th>
                                                        <th>Education</th>
                                                        <th>Experience</th>
                                                        <th>User type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select * from  users where Is_Active=1 AND usertype=2");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['name']); ?></td>
                                                            <td><?php echo htmlentities($row['email']); ?></td>
                                                            <td><?php echo htmlentities($row['username']); ?></td>
                                                            <td><?php echo htmlentities($row['password']); ?></td>
                                                            <td><?php echo htmlentities($row['phone']); ?></td>
                                                            <td><?php echo htmlentities($row['address']); ?></td>
                                                            <td><?php echo htmlentities($row['nutrition_edu']); ?></td>
                                                            <td><?php echo htmlentities($row['nutri_experience']); ?></td>
                                                            <td><?php echo htmlentities($row['usertype']); ?></td>
                                                            <td><?php echo htmlentities($row['Is_Active']); ?></td>
                                                            <td>
                                                                <a href="edit-nu.php?cid=<?php echo ($row['user_id']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                                &nbsp;<a href="manage-Nu.php?rid=<?php echo htmlentities($row['user_id']); ?>&&action=del">
                                                                    <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>


                                    </div>

                                </div>


                            </div>
                            <!--- end row -->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">

                                            <h4><i class="fa fa-trash-o"></i> Deleted Nutritionist</h4>

                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-danger">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>Phone No</th>
                                                        <th>Address</th>
                                                        <th>Education</th>
                                                        <th>Experience</th>
                                                        <th>User type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select * from  users where Is_Active=0");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['name']); ?></td>
                                                            <td><?php echo htmlentities($row['email']); ?></td>
                                                            <td><?php echo htmlentities($row['username']); ?></td>
                                                            <td><?php echo htmlentities($row['password']); ?></td>
                                                            <td><?php echo htmlentities($row['phone']); ?></td>
                                                            <td><?php echo htmlentities($row['address']); ?></td>
                                                            <td><?php echo htmlentities($row['nutrition_edu']); ?></td>
                                                            <td><?php echo htmlentities($row['nutri_experience']); ?></td>
                                                            <td><?php echo htmlentities($row['usertype']); ?></td>
                                                            <td><?php echo htmlentities($row['Is_Active']); ?></td>
                                                            <td>
                                                                <a href="manage-Nu.php?resid=<?php echo htmlentities($row['user_id']); ?>"><i class="ion-arrow-return-right" title="Restore this category"></i></a>
                                                                &nbsp;<a href="manage-Nu.php?rid=<?php echo htmlentities($row['user_id']); ?>&&action=parmdel" title="Delete forever"> <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>


                                    </div>

                                </div>


                            </div>


                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

            </div>
            <!-- END wrapper -->


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
<?php } ?>