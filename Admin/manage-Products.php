<?php
session_start();
include('includes/config.php');
error_reporting(0);
if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: http://localhost/Clean_food_healthy_life_ecom/login.php");
}
 else {
    if ($_GET['action'] == 'del' && $_GET['scid']) {
        $id = intval($_GET['scid']);
        $query = mysqli_query($con, "update  product set Is_Active='0' where id='$id'");
        $msg = "Product deleted ";
    }
    // Code for restore
    if ($_GET['resid']) {
        $id = intval($_GET['resid']);
        $query = mysqli_query($con, "update  product set Is_Active='1' where id='$id'");
        $msg = "Product restored successfully";
    }

    // Code for Forever deletionparmdel
    if ($_GET['action'] == 'perdel' && $_GET['scid']) {
        $id = intval($_GET['scid']);
        $query = mysqli_query($con, "delete from   product  where id='$id'");
        $delmsg = "Product deleted forever";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title> CleanFood&FitLife | Manage Products</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                                    <h4 class="page-title">Manage Products</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Products </a>
                                        </li>
                                        <li class="active">
                                            Manage Products
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
                                            <a href="add-Products.php">
                                                <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Category</th>
                                                        <th>Product Name</th>
                                                        <th>Product Price</th>
                                                        <th>Product Quantity</th>
                                                        <th>Product Image</th>
                                                        <th>Short Description</th>
                                                        <th>Product Detail</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select product.categories_id ,product.product_name,product.id as P_id,product.product_price,product.qty as Quantity,product.image,product.short_desc,product.product_details,categories.categories,categories.id from product INNER join categories on product.categories_id=categories.id AND product.Is_Active=1");
                                                    $cnt = 1;
                                                    $rowcount = mysqli_num_rows($query);
                                                    if ($rowcount == 0) {
                                                    ?>
                                                        <tr>

                                                            <td colspan="9" style="text-align:center;">
                                                                <h3 style="color:red">No record
                                                                    found</h3>
                                                            </td>
                                                        <tr>
                                                            <?php
                                                        } else {

                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>


                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['categories']); ?></td>
                                                            <td><?php echo htmlentities($row['product_name']); ?></td>
                                                            <td><?php echo htmlentities($row['product_price']); ?></td>
                                                            <td><?php echo htmlentities($row['Quantity']); ?></td>
                                                            <td> <div class="tdwrap"><iframe class="frame" src="<?php echo htmlentities($row['image']); ?>" frameborder="0" scrolling="no" ></iframe></div></td>
                                                            <td><?php echo htmlentities($row['short_desc']); ?></td>
                                                            <td><?php echo htmlentities($row['product_details']); ?></td>
                                                            
                                                            <td>
                                                                <a href="edit-Products.php?scid=<?php echo htmlentities($row['P_id']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                                &nbsp;<a href="manage-Products.php?scid=<?php echo htmlentities($row['P_id']); ?>&&action=del">
                                                                    <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php
                                                                $cnt++;
                                                            }
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

                                            <h4><i class="fa fa-trash-o"></i> Deleted Products</h4>

                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-danger">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Category</th>
                                                        <th>Product Name</th>
                                                        <th>Product Price</th>
                                                        <th>Product Quantity</th>
                                                        <th>Product Image</th>
                                                        <th>Short Description</th>
                                                        <th>Product Detail Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select product.categories_id ,product.product_name,product.id as P_id,product.product_price,product.qty as Quantity,product.image,product.short_desc,product.product_details,categories.categories,categories.id from product INNER join categories on product.categories_id=categories.id AND product.Is_Active=0");
                                                    $cnt = 1;
                                                    $rowcount = mysqli_num_rows($query);
                                                    if ($rowcount == 0) {
                                                    ?>
                                                        <tr>

                                                            <td colspan="7" align="center">
                                                                <h3 style="color:red">No record
                                                                    found</h3>
                                                            </td>
                                                        <tr>
                                                            <?php
                                                        } else {

                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['categories']); ?></td>
                                                            <td><?php echo htmlentities($row['product_name']); ?></td>
                                                            <td><?php echo htmlentities($row['product_price']); ?></td>
                                                            <td><?php echo htmlentities($row['Quantity']); ?></td>
                                                            <td> <div class="tdwrap"><iframe class="frame" src="<?php echo htmlentities($row['image']); ?>" frameborder="0" scrolling="no" ></iframe></div></td>
                                                            <td><?php echo htmlentities($row['short_desc']); ?></td>
                                                            <td><?php echo htmlentities($row['product_details']); ?></td>
                                                            
                                                            <td>
                                                                <a href="manage-Products.php?resid=<?php echo htmlentities($row['P_id']); ?>"><i class="ion-arrow-return-right" title="Restore this Product"></i></a>
                                                                &nbsp;<a href="manage-Products.php?scid=<?php echo htmlentities($row['P_id']); ?>&&action=perdel">
                                                                    <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php
                                                                $cnt++;
                                                            }
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