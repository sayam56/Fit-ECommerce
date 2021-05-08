$db = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');
<?php

$con = mysqli_connect('localhost', 'root', '', 'Fit_ecommerce');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>