
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


               
               echo "<script>console.log('Update SUCCESSFULL!!!!');</script>";
          }
          catch(PDOException $ex1){
               echo $ex1;
               
          }
     }

?>