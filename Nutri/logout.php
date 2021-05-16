<?php
session_start();
$_SESSION = array();
session_regenerate_id();

session_destroy();

?>

<script>
    location.assign('http://localhost/Clean_food_healthy_life_ecom/login.php');
</script>