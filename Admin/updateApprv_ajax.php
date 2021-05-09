
<?php
 echo "console.log('next page SUCCESSFULL!!!!');";

     try{
          $conn=new PDO("mysql:host=localhost;dbname=fit_ecommerce;",'root','');
          echo "<script>console.log('connection successful');</script>";
          
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }
     catch(PDOException $e){
          echo "<script>window.alert('connection error');</script>";
     }


     if(isset($_GET['updateVal']) ){
               
          $updateVal= $_GET['updateVal'];
          $admin_orderID= $_GET['admin_orderID'];


          try{

               $upd_sql = "UPDATE admin_orders SET approved='$updateVal' WHERE id='$admin_orderID' "  ;
               $upd_obj = $conn->prepare($upd_sql)->execute();

               if($updateVal == 1){
                    //approved items will be sent for notifications
                    $sql= "SELECT * FROM `admin_orders` WHERE id='".$admin_orderID."' AND approved='1' ";
                    $object=$conn->query($sql);
                    $orderTab=$object-> fetchAll();
                    foreach($orderTab as $ordrTab){
                         $inssql= "INSERT INTO notifications (user_id, admin_order_id, product_id, product_qty, total_price, seen) VALUES ('".$ordrTab[2]."','".$ordrTab[0]."','".$ordrTab[3]."','".$ordrTab[4]."','".$ordrTab[5]."','0' )";
                         $insobject=$conn->query($inssql);
                    }
               }

               
               echo "<script>console.log('Update SUCCESSFULL!!!!');</script>";
          }
          catch(PDOException $ex1){
               echo $ex1;
               
          }
     }

?>