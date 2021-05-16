<?php
session_start();

//db connection
try {
    $con = new PDO("mysql:host=localhost;dbname=fit_ecommerce;", 'root', '');
    echo "<script>console.log('connection successful');</script>";

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<script>window.alert('Database connection error');</script>";
}

$productCount = 0;
$productName = "";
$product_price = "";
$qty = "";
$image = "";
$product_details = "";

//o by default means not logged in, 1 means logged in
$productID = $_GET["prdID"];
// print($productID);
$is_loggedIn = 0;
$username = '';
$user_id = '';
$cartCount = 0;
$notiCount = 0;

if ((isset($_SESSION['user_id']))) {
    $user_id = $_SESSION['user_id'];
}


//check if logged in
if (isset($_SESSION['username'])) {
    $is_loggedIn = 1;
    $username = $_SESSION['username'];

    //checkNotifications
    try {
        $sql = "SELECT * FROM `notifications` WHERE user_id='" . $user_id . "' AND seen='0' ";
        $object = $con->query($sql);
        $notiCount = $object->rowCount();
    } catch (PDOException $e) {
        echo $ex1;
    }
}



if (isset($_SESSION['user_id'])) {
    //if the user is logged in
    try {
        $sql2 = "SELECT * FROM `cart` WHERE user_id='" . $user_id . "'";
        $object2 = $con->query($sql2);
        $cartCount = $object2->rowCount();
    } catch (PDOException $e) {
        echo $ex1;
    }
}


try {
    $prosql = "SELECT product.id,product.short_desc,product.product_name,product.product_price,product.product_details,product.qty,product.image,categories.categories  FROM product inner join categories where product.id='$productID' And categories.id=product.categories_id";
    $proObj = $con->query($prosql);
    $proTab = $proObj->fetchAll();
    foreach ($proTab as $key) {
        $productName = $key['product_name'];
        $product_price = $key['product_price'];
        $qty = $key['qty'];
        $image = $key['image'];
        $product_details = $key['product_details'];
        $category_name = $key['categories'];
        $short_desc = $key['short_desc'];
    }
} catch (PDOException $e) {
    echo "<script>console.log('Product Error fetch error');</script>";
}



?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

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

    <!-- Header Section Begin -->
    <?php include('Header.php') ?>
    <!-- Header Section End -->



    <!-- Breadcrumb Section Begin -->

    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?php echo $productName ?></h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Category</a>
                            <a href="./index.html"><?php echo $category_name ?></a>
                            <span><?php echo $productName ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?php echo $image  ?>" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg" src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg" src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg" src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg" src="img/product/details/thumb-4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $productName ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price"><?php echo $product_price ?> .000 BDT</div>
                        <p><?php echo $short_desc ?></p>
                        <!-- <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div> -->
                        <!-- <a href="#" class="primary-btn">ADD TO CARD</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                        <ul>
                            <li><b>Availability</b> <span><?php echo $qty ?></span></li>
                            <li><b>Category</b> <span><?php echo $category_name ?></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/Fresh-Fruits-Pictures-278400038963092/"><i class="fa fa-facebook"></i></a>
                                    <a href="https://twitter.com/marketfood?lang=en"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/fruitsandveggies/?hl=en"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.pinterest.com/eatingwell/best-diet-recipes-for-weight-loss/"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h1 align="center">Nutrition Facts</h6>
                                        <div style="padding-top: 20px;display: flex;justify-content: center;">
                                            <img src="<?php echo $product_details ?>" alt="">
                                        </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
 
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php include('fotor.php') ?>
    <!-- Footer Section End -->

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