<?php
 //echo "console.log('next page SUCCESSFULL!!!!');";

     try{
          $conn=new PDO("mysql:host=localhost;dbname=fit_ecommerce;",'root','');
          echo "<script>console.log('connection successful');</script>";
          
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }
     catch(PDOException $e){
          echo "<script>window.alert('connection error');</script>";
     }


     if(isset($_GET['productID']) ){
          $productID=$_GET['productID'];  
          $user_id=$_GET['user_id']; 
          $product_price=$_GET['product_price'];                      

          try{
               $sql= "INSERT INTO cart (user_id, product_id, product_qty, total_price) VALUES ('".$user_id."','".$productID."','0','0')";
               $object=$conn->query($sql);

               $sql2= "SELECT * FROM `cart` WHERE user_id='".$user_id."'";
               $object2=$conn->query($sql2);
               $cartCount=$object2->rowCount();
                    
              ?>
               <li><a href="#"><i class="fa fa-shopping-bag"></i> <span><?php echo $cartCount; ?></span></a></li>
              <?php            
               
               echo "<script>console.log('INSERT SUCCESSFULL!!!!');</script>";
          }
          catch(PDOException $ex1){
               echo $ex1;
               
          }
     }

?>