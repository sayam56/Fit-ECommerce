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
          $user_id=$_GET['user_id'];                    

          try{
               $up_sql = "UPDATE notifications SET seen='1' WHERE user_id='$user_id' "  ;
               $up_obj = $conn->prepare($up_sql)->execute();

               ?>
               <li id="shoppingC" ><a style="cursor: pointer;"><i class="fa fa-bell"></i> <span>0</span></a></li>
              <?php 

               echo "<script>console.log('INSERT SUCCESSFULL!!!!');</script>";
          }
          catch(PDOException $ex1){
               echo $ex1;
               
          }
     }

?>