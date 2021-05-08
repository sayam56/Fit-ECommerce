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


     if(isset($_GET['user_id']) ){
               
          $user_id= $_GET['user_id'];
          $sum=0;

          try{
               $sql= "SELECT * FROM `cart` WHERE user_id='".$user_id."'";
               $object=$conn->query($sql);
               $cartTable= $object->fetchAll();
               foreach ($cartTable as $cart) {
                    $sum+=$cart[4];
                    try{
                         $consql= "INSERT INTO admin_orders (cart_id, user_id, product_id, product_qty,individual_total, total_price, approved) VALUES ('".$cart[0]."','".$cart[1]."','".$cart[2]."','".$cart[3]."','".$cart[4]."','".$sum."','0')";
                         $conobject=$conn->query($consql);
                         $total_priceTable= $conobject->fetchAll();
                    }catch(PDOException $e){
                         echo $e;
                    }
               }
               $delsql="DELETE FROM cart WHERE user_id='".$user_id."' ";
	          $delobj = $conn->query($delsql);

               
               echo "<script>console.log('Update SUCCESSFULL!!!!');</script>";
          }
          catch(PDOException $ex1){
               echo $ex1;
               
          }
     }

?>