       <!-- Header Section Begin -->
       <header class="header">
           <!-- <div class="header__top">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-6 col-md-6">
                           <div class="header__top__left">
                               <ul>
                                   <li><i class="fa fa-envelope"></i> CleanFood&FitLife@colorlib.com</li>
                                   
                               </ul>
                           </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <div class="header__top__right">
                               <div class="header__top__right__social">
                                   <a href="#"><i class="fa fa-facebook"></i></a>
                                   <a href="#"><i class="fa fa-twitter"></i></a>
                                   <a href="#"><i class="fa fa-linkedin"></i></a>
                                   <a href="#"><i class="fa fa-pinterest-p"></i></a>
                               </div>
                               <div class="header__top__right__language">
                                   <img src="img/language.png" alt="">
                                   <div>English</div>
                                   <span class="arrow_carrot-down"></span>
                                   <ul>
                                       <li><a href="#">Spanis</a></li>
                                       <li><a href="#">English</a></li>
                                   </ul>
                               </div>
                               <div class="header__top__right__auth">
                                   <a href="login.php"><i class="fa fa-user"></i> Login</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div> -->
           <div class="container">
           
            <div class="header__top__right"> 
                    <div class="header__top__right__auth">
                        <?php 
                        if($is_loggedIn==0){
                            ?>
                                <a href="login.php"><i class="fa fa-user"></i> Login</a>
                            <?php
                        }else{
                            ?> 
                            <a href="./Admin/includes/logout.php">Welcome <?php echo $username?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-user">&nbsp;&nbsp;&nbsp;Logout</i> 
                            </a>
                            <?php
                        }
                        ?>
                        
                    </div>
            </div>

               <div class="row">
                   <div class="col-lg-3">
                       <div class="header__logo">
                           <a href="index.php"><img src="img\logo.png" alt=""></a>
                           <p style="font: 30px solid bolad; color:green">CleanFood&HealthyLife</p>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <nav class="header__menu">
                           <ul>
                               <!-- <li class="active"><a href="index.php">Home</a></li> -->
                               <li><a href="#">Pages</a>
                                   <ul class="header__menu__dropdown">
                                       <li><a href="product-detail.php">Product Details</a></li>
                                       <li><a href="shoping-cart.php">Shopping Cart</a></li>
                                   </ul>
                               </li>
                               <li><a href="contact.php">Contact Us</a></li>
                               <li><a href="video.php">Receipes</a></li>
                               <li><a href="chat.php">Nutritionist</a></li>
                           </ul>
                       </nav>
                   </div>
                   <div class="col-lg-3">
                       <div class="header__cart">
                           <ul id="shoppingBag" onclick="redirect();">
                           <!-- here you will increment the count from mysql db-->
                               <li id="shoppingC" ><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo $cartCount; ?></span></a></li>
                           </ul>
                           <!-- #<div class="header__cart__price">item: <span>$150.00</span></div> -->
                       </div>
                   </div>
               </div>
               <div class="humberger__open">
                   <i class="fa fa-bars"></i>
               </div>
           </div>
       </header>
       <!-- Header Section End -->

       <script>
        function redirect(){
            window.location.href = "shoping-cart.php";
        }
       </script>