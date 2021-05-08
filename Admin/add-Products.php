<?php
session_start();
$msg="";
$error="";

$con= mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');
if ((!isset($_SESSION['username'])) || isset($_GET['logout'] )) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../../login.php");
}
if (isset($_POST['submitpro'])) {
                $category=$_POST['category'];
                $product_name = $_POST['pro_name'];
                $status = 1;
                $categoryid = $_POST['category'];
                $Pro_description = $_POST['Pro_description'];
                $pro_qunty=$_POST['pro_qunty'];
                $price=$_POST['price'];
                $pro_img=$_POST['pro_img'];
                $status = 1;
                $query = mysqli_query($con, "insert into product(categories_id,product_name,product_price,qty,image,product_details,status,Is_Active)
                values('$category','$product_name','$price','$pro_qunty','$pro_img','$Pro_description','$status','1')");
        if ($query) {
             $msg = "PRODUCT Added ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>CleanFood&FitLife | Add Products</title>

<!-- App css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/pages.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/menu.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
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
            <h4 class="page-title">Add Products</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="#">Admin</a>
                </li>
                <li>
                    <a href="#">Products </a>
                </li>
                <li class="active">
                    Add Products
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
            <hr/>


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
                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?></div>
            <?php } ?>


        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" name="category" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">Products</label>
                    <div class="col-md-10">
                        <select class="form-control" name="category" required>
                            <option value="">Select Category</option>
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
                        <input type="text" class="form-control" value=""
                            name="pro_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Price </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value=""
                            name="price" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Product Quantity</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value=""
                            name="pro_qunty" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Product images</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value=""
                            name="pro_img" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label">Product
                                                        Description</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5" name="Pro_description"
                                required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">&nbsp;</label>
                    <div class="col-md-10">

                        <button type="submit"
                                class="btn btn-custom waves-effect waves-light btn-md"
                                name="submitpro">
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
