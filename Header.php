       <!-- Header Section Begin -->
       <header class="header">
    
           <div class="container">

               <div class="header__top__right">
                   <div class="header__top__right__auth">
                       <?php
                        if ($is_loggedIn == 0) {
                        ?>
                           <a href="login.php"><i class="fa fa-user"></i> Login</a>
                       <?php
                        } else {
                        ?>
                           <a href="./Admin/includes/logout.php">Welcome <?php echo $username ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                   <div class="col-lg-6" style="padding-left: 50px;">
                       <nav class="header__menu">
                           <ul>
                               <!-- <li class="active"><a href="index.php">Home</a></li> -->
                               <li><a href="http://localhost/Clean_food_healthy_life_ecom/index.php">Home</a></li>
                               <li><a href="video.php">Recipes</a></li>
                               <li><a href="contact.php">Contact Us</a></li>
                               <li><a href="./Chat/index.php">Nutritionist</a></li>

                               <!-- <li><a href="chat.php">Nutritionist</a></li> -->
                           </ul>
                       </nav>
                   </div>
                   <div class="col-lg-3">
                       <div class="header__cart">
                           <ul id="bellIcon" onclick="openModal(),updateNoti();">
                               <!-- here you will increment the count from mysql db-->
                               <li id="shoppingC"><a style="cursor: pointer;"><i class="fa fa-bell"></i> <span><?php echo $notiCount; ?></span></a></li>
                           </ul>
                           <ul id="shoppingBag" onclick="redirect();">
                               <!-- here you will increment the count from mysql db-->
                               <li id="shoppingC"><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo $cartCount; ?></span></a></li>
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
           function redirect() {
               window.location.href = "shoping-cart.php";
           }
       </script>