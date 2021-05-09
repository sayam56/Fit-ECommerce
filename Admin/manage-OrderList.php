<?php
session_start();
$msg = "";
$error = "";
$delmsg = "";
$con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');

//db connection
try{
    $conn=new PDO("mysql:host=localhost;dbname=fit_ecommerce;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('Database connection error');</script>";
}


if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../../login.php");
} else {
    // if (isset($_GET['action']) && $_GET['action'] == 'del' && $_GET['rid']) {
    //     $id = intval($_GET['rid']);
    //     $query = mysqli_query($con, "update categories set Is_Active='0' where id='$id'");
    //     $msg = "Category deleted ";
    // }
    // // Code for restore
    // if (isset($_GET['resid'])) {
    //     $id = intval($_GET['resid']);
    //     $query = mysqli_query($con, "update categories set Is_Active='1' where id='$id'");
    //     $msg = "Category restored successfully";
    // }

    // // Code for Forever deletionparmdel
    // if (isset($_GET['action'])&&$_GET['action'] == 'parmdel' && $_GET['rid']) {
    //     $id = intval($_GET['rid']);
    //     $query = mysqli_query($con, "delete from  categories  where id='$id'");
    //     $delmsg = "Category deleted forever";
    // }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>CleanFood&FitLife | Manage Order List</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!--        <link href="assets/css/materialdesignicons.css.map" rel="stylesheet" type="text/css"/>-->
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Manage Order List</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Order List </a>
                                        </li>
                                        <li class="active">
                                            Manage Order List
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($delmsg); ?>
                                    </div>
                                <?php } ?>


                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer Name</th>
                                                        <th>Product Name</th>
                                                        <th>Purchased Qty</th>
                                                        <th>Ind. Total</th>
                                                        <th>Ledger Total</th>
                                                        <th>Approaved</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try{
                                                        $sql= "Select * from admin_orders";
                                                        $cnt = 1;
                                                        $adminobject=$conn->query($sql);
                                                        $adminTab= $adminobject->fetchAll();
                                                        foreach($adminTab as $key){
                                                            $usersql = "SELECT username FROM `users` WHERE user_id='".$key[2]."'";
                                                            $userobject=$conn->query($usersql);
                                                            $userTab= $userobject->fetchAll();
                                                            foreach($userTab as $username){
                                                                $prdcsql = "SELECT product_name FROM `product` WHERE id='".$key[3]."'";
                                                                $prdcObject=$conn->query($prdcsql);
                                                                $prdcTab= $prdcObject->fetchAll();
                                                                foreach($prdcTab as $productName){
                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                                        <td><?php echo $username[0]; ?></td> <!-- customer name -->
                                                                        <td><?php echo $productName[0]; ?></td> <!-- product Name -->
                                                                        <td><?php echo $key[4]; ?>pcs</td>
                                                                        <td>$<?php echo $key[5]; ?></td>
                                                                        <td>$<?php echo $key[6]; ?></td>
                                                                        <td id="updateApprvVal<?php echo $key[0]; ?>">
                                                                        <?php
                                                                        if($key[7] == 0){
                                                                            echo 'No'; 
                                                                        }else {
                                                                            echo 'Yes';
                                                                        }
                                                                         
                                                                         
                                                                         ?></td> <!-- apprv -->
                                                                        <td>
                                                                            <a style="cursor: pointer;" onclick="statusUpdate(1,<?php echo $key[0]; ?>)"><i class="fa fa-check" style="color: #3AF629;"></i></a>
                                                                            &nbsp;
                                                                            <a style="cursor: pointer;" onclick="statusUpdate(0,<?php echo $key[0]; ?>)"><i class="fa fa-times" style="color: #f05050"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php

                                                                } /* product name */
                                                                
                                                            } /* username */
                                                            
                                                        $cnt++;
                                                        }/* admin orders */
                                                    }catch(PDOException $err){
                                                        echo $err;
                                                    }

                                                    ?>

                                                </tbody>

                                            </table>
                                        </div>


                                    </div>

                                </div>


                            </div>
                            <!--- end row -->


                            


                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

            </div>
            <!-- END wrapper -->


<script>
    var resizefunc = [];
    
    function statusUpdate(updateVal,admin_orderID){
        var ajaxreq=new XMLHttpRequest();
        ajaxreq.open("GET","updateApprv_ajax.php?updateVal="+updateVal+"&admin_orderID="+admin_orderID );
        //console.log(member.id);
        ajaxreq.onreadystatechange=function ()
        {
        if(ajaxreq.readyState==4 && ajaxreq.status==200)
                {


                    var response=ajaxreq.responseText;
                    
                    var divelm=document.getElementById('updateApprvVal'+admin_orderID);

                    if(updateVal == 0){
                        divelm.innerHTML='No';
                        divelm.style.color = "Red";
                    }
                    if(updateVal == 1)
                    {
                        divelm.innerHTML='Yes';
                        divelm.style.color = "#00FF40";
                    }

                    
                    
                }
        }
        
        ajaxreq.send();
    }
</script>

            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>