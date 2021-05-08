<?php
session_start();

$con= mysqli_connect('localhost', 'root', '', 'fit_ecommerce');
error_reporting(0);

if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../../login.php");
} else {
    if (isset($_POST['submit'])) {
        $categoryid = $_POST['category'];
        $product_name = $_POST['pro_name'];
        $categoryid = $_POST['category'];
        $short_desc = $_POST['short_desc'];
        $Pro_description = $_POST['Pro_description'];
        $pro_qunty = $_POST['pro_qunty'];
        $price = $_POST['price'];
        $pro_img = $_POST['pro_img'];
        $Pro_id = intval($_GET['scid']);
        $categoryid = $_POST['category'];
        $query = mysqli_query($con, "update product set categories_id='$categoryid',product_name='$product_name',product_details='$Pro_description',short_desc='$short_desc',qty='$pro_qunty',image='$pro_img',product_price='$price' where id=' $Pro_id'");
        if ($query) {
            $msg = "Product Updated ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>CleanFood&FitLife | Edit Products</title>

        <!-- App css -->
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
                                    <h4 class="page-title">Add Product</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Category </a>
                                        </li>
                                        <li class="active">
                                            Product
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
                                    <h4 class="m-t-0 header-title"><b>Add Products </b></h4>
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

                                    <?php
                                    //fetching Category details
                                    $Pro_id = intval($_GET['scid']);
                                    $query = mysqli_query($con, "Select product.categories_id ,product.product_name,product.id,product.product_price,product.qty as Quantity,product.image,product.short_desc,product.product_details,categories.categories as catname,categories.id as catid from product INNER join categories on product.categories_id=categories.id AND product.Is_Active=1 AND product.id='$Pro_id'");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {

                                    ?>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal" name="Product" method="post">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Category</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control" name="category" required>
                                                                <option value="<?php echo htmlentities($row['catid']); ?>"><?php echo htmlentities($row['catname']); ?></option>
                                                                <?php
                                                                // Feching active categories
                                                                $ret = mysqli_query($con, "select id,categories from  categories where Is_Active=1");
                                                                while ($result = mysqli_fetch_array($ret)) {
                                                                ?>
                                                                    <option value="<?php echo htmlentities($result['id']); ?>"><?php echo htmlentities($result['categories']); ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Product Name</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['product_name']); ?>" name="pro_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Product Price</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['product_price']); ?>" name="price" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Product Quantity</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['Quantity']); ?>" name="pro_qunty" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Product Image
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" name="pro_img" required><?php echo htmlentities($row['image']); ?></textarea>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Product Detail
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" name="Pro_description" required><?php echo htmlentities($row['product_details']); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Product Short Detail
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" name="short_desc"><?php echo htmlentities($row['short_desc']); ?></textarea>
                                                        </div>
                                                    </div>

                                                <?php } ?>

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