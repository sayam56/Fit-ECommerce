<?php
session_start();

$productCount=0;

//o by default means not logged in, 1 means logged in
$is_loggedIn=0; 
$username='';
$user_id='';
$cartCount=0;

if ((isset($_SESSION['user_id'])) ) {
    $user_id=$_SESSION['user_id'];
}


//check if logged in
if (isset($_SESSION['username']) ) {
    $is_loggedIn=1;
    $username=$_SESSION['username'];
}

//db connection
try{
    $conn=new PDO("mysql:host=localhost;dbname=fit_ecommerce;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('Database connection error');</script>";
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


?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fit and Nutrition">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fit E-Commerce</title>

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
                        <h2>Clean Food Healthy Life</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                            <?php
                            //getting the categories

                            try{
                                $catsql = "SELECT categories FROM categories ";
                                $catObj = $conn->query($catsql);
                                $catTab = $catObj->fetchAll();
                                foreach ($catTab as $key) {
                                   ?>
                                   <li><a href="#"><?php echo $key[0] ?></a></li>
                                   <?php
                                }
                            }
                            catch(PDOException $e){
                                echo "<script>console.log('category fetch error');</script>";
                            }
                            
                            
                            ?>
                            </ul>
                               
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                
                <?php
                            //getting the products

                            try{
                                $prsql = "SELECT * FROM product ";
                                $prObj = $conn->query($prsql);
                                //$productCount = $prObj->fetchColumn();
?>

                                <div class="filter__item">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5">
                                            <!-- <div class="filter__sort">
                                                <span>Sort By</span>
                                                <select>
                                                    <option value="0">Default</option>
                                                    <option value="0">Default</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        
                                    </div>
                                </div>
                            <div class="row">
                               
<?php
                                $prTab = $prObj->fetchAll();
                                foreach ($prTab as $key) {
                                   ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="<?php echo $key[5]?>">
                                                <ul class="product__item__pic__hover">
                                                    <li>
                                                        <!-- <button ></button> -->
                                                        <a style="cursor: pointer;" onclick="promtLogin(<?php echo $key[0] ?>, <?php echo $key[3] ?>);"><i class="fa fa-shopping-cart"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><a ><?php echo $key[2]?></a></h6>
                                                <h5>$<?php echo $key[3]?></h5>
                                            </div>
                                        </div>
                                    </div>
                                   
                           
                                   <?php
                                   $productCount++;
                                }
                            }
                            catch(PDOException $e){
                                echo "<script>console.log('product fetch error');</script>";
                            }
                            
                            
                            ?>
                            
                    
                    </div><!-- row ends -->
                    
                </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="filter__found">
                            <h6><span><?php echo $productCount; ?></span> Products found</h6>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

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

    <script> 
    var is_loggedIn="<?php echo $is_loggedIn ?>";
    var user_id="<?php echo $user_id ?>";

        function promtLogin(productID, productPrice){
            if(is_loggedIn == 0){
                //which means the user is not logged in, then promt the user to log in

                window.alert('Please Log In First!');
                

            }
            else{
                //just add the product to the card through ajax
                
                var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","insertToCart_Ajax.php?productID="+productID+"&user_id="+user_id+"&product_price="+productPrice );
                //console.log(member.id);
                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {

                             var response=ajaxreq.responseText;
                            
                             var divelm=document.getElementById('shoppingBag');

                            
                             divelm.innerHTML=response;
                        }
                }
                
                ajaxreq.send();
            }
        }
    
    
    </script>


</body>

</html>


