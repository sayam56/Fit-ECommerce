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


?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Available</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //getting the categories

                            try{
                                $cartsql = "SELECT * FROM `cart` WHERE user_id='".$user_id."' ";
                                $cartObj = $conn->query($cartsql);
                                $catrTab = $cartObj->fetchAll();
                                foreach ($catrTab as $key) {
                                   //key[2] contains the product id
                                   try{
                                    //get product info with the product ID
                                    $productsql = "SELECT * FROM `product` WHERE id='".$key[2]."' ";
                                    $productObj = $conn->query($productsql);
                                    $productTab = $productObj->fetchAll();

                                    foreach ($productTab as $productInfo) {
                                        ?>
                                        <tr id="cartRow<?php echo $key[2]; ?>">
                                            <td class="shoping__cart__item shopping_cart_img">
                                                <img src="<?php echo $productInfo[5]; ?>" alt="">
                                                <h5><?php echo $productInfo[2]; ?></h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                $<?php echo $productInfo[3]; ?>
                                            </td>
                                            <td class="shoping__cart__price" id="availableQTY<?php echo $key[2]; ?>">
                                            <!-- available quantity -->
                                            <?php echo $productInfo[4]; ?>pcs
                                            </td>
                                            <td class="shoping__cart__quantity">
                                            <!-- purchasing  quantity -->
                                                <div class="quantity">
                                                    <input class="qtyInput" id="qtyInput<?php echo $key[2]; ?>" type="number" value="<?php echo $key[3]; ?>" min="0" max="<?php echo $productInfo[4]; ?>">                                                  
                                                </div>
                                                <button id="qtyBTN<?php echo $key[2]; ?>" class="qtyBTN" onclick="updateTotal(<?php echo $key[2]; ?>,<?php echo $productInfo[3]; ?>, <?php echo $key[4]; ?>, <?php echo $productInfo[4]; ?>)">Update</button>
                                            </td>
                                            <td class="shoping__cart__total" id="qtyWiseTotal<?php echo $key[2]; ?>">
                                            $<?php echo $key[4]; ?>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <span class="icon_close" onclick="deleteCartItem(<?php echo $key[2]; ?>, <?php echo $productInfo[4]; ?>);"></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                   }catch(PDOException $e2){
                                       echo "<script> console.log('<?php echo $e2; ?>'); </script>";
                                   }
                                }
                            }
                            catch(PDOException $e){
                                echo "<script>console.log('category fetch error');</script>";
                            }
                            
                            
                            ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a class="primary-btn cart-btn cart-btn-right" onclick="updateCartPage()">Update Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul id="CartTotal">
                            <li>Total <span >$0</span></li>
                        </ul>
                        <a style="cursor: pointer;" onclick="confirmOrder();" class="primary-btn">Confirm Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

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

    var user_id = "<?php echo $user_id; ?>"

        function updateTotal(product_id,unitPrice,prevPrice,availableQTY){
            let updateQtyVal=0;
            let updatedTotalPrice = 0;
            updateQtyVal=document.getElementById("qtyInput"+product_id).value;

            console.log(updateQtyVal);

            updatedTotalPrice = (parseInt(unitPrice) * parseInt(updateQtyVal))+parseInt(prevPrice);

            updatedAvailableQty = parseInt(availableQTY)-parseInt(updateQtyVal);

            document.getElementById("qtyWiseTotal"+product_id).innerHTML = "$"+updatedTotalPrice;

            document.getElementById("availableQTY"+product_id).innerHTML = updatedAvailableQty + "pcs";

            console.log(updatedTotalPrice);
            console.log(updatedAvailableQty);


            var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","updateCartVal_Ajax.php?productID="+product_id+"&updatedTotalPrice="+updatedTotalPrice+"&updatedAvailableQty="+updatedAvailableQty+"&purchasedQtyVal="+updateQtyVal+"&user_id="+user_id );
                //console.log(member.id);
                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {

                            console.log('cart and product DB is now updated');

                            //document.getElementById("qtyInput"+product_id).innerHTML=0;

                             var response=ajaxreq.responseText;
                            
                             var divelm=document.getElementById('shoppingBag');
                            
                             divelm.innerHTML=response;
                        }
                }
                
                ajaxreq.send(); 

            //console.log(updatedTotalPrice);
        }


        function updateCartPage(){
         
            var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","finalCartCalc_ajax.php?user_id="+user_id );
                //console.log(member.id);
                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {

                            //console.log('INSIDE ajax');
                             var response=ajaxreq.responseText;
                            
                             var divelm=document.getElementById('CartTotal');

                            //console.log(divelm);
                            
                             divelm.innerHTML=response;
                        }
                }
                
                ajaxreq.send();
        }


    function confirmOrder(){
        var res= confirm("Are you sure you want to submit the order?");

        if(res == true){
            var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","confirmOrder_ajax.php?user_id="+user_id );
                //console.log(member.id);
                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {


                            window.location.replace("index.php");
                            //console.log('INSIDE ajax');
                             //var response=ajaxreq.responseText;

                             //console.log(response);
                            
                             //var divelm=document.getElementById('CartTotal');

                            //console.log(divelm);
                            
                             /* divelm.innerHTML=response; */
                        }
                }
                
                ajaxreq.send();
        }
        
    }



    function deleteCartItem(product_id, availableQty){
        var res= confirm("Are you sure you want to delete the item?");

        if(res == true){
            var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","deleteCartItem_ajax.php?product_id="+product_id+"&user_id="+user_id );
                //console.log(member.id);
                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {


                            //window.location.replace("index.php");
                            $('#cartRow'+product_id).hide("slow");
                            //console.log('INSIDE ajax');
                             //var response=ajaxreq.responseText;

                             //console.log(response);
                            
                             //var divelm=document.getElementById('CartTotal');

                            //console.log(divelm);
                            
                             /* divelm.innerHTML=response; */
                        }
                }
                
                ajaxreq.send();
        }
        
    }
    </script>

</body>

</html>