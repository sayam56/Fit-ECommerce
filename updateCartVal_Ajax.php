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
          $updatedTotalPrice=$_GET['updatedTotalPrice']; 
          $updatedAvailableQty=$_GET['updatedAvailableQty'];  
          $purchasedQtyVal=$_GET['purchasedQtyVal'];     
          $user_id= $_GET['user_id'];

          try{
               $up_sql = "UPDATE cart SET product_qty='$purchasedQtyVal', total_price='$updatedTotalPrice' WHERE user_id='$user_id' AND product_id='$productID' "  ;
               $up_obj = $conn->prepare($up_sql)->execute();

               $up_sqlPrd = "UPDATE product SET qty='$updatedAvailableQty' WHERE id='$productID' "  ;
               $up_objPrd = $conn->prepare($up_sqlPrd)->execute();
          
               
               echo "<script>console.log('Update SUCCESSFULL!!!!');</script>";
          }
          catch(PDOException $ex1){
               echo $ex1;
               
          }
     }

?>