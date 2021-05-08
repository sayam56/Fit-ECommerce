<?php
include('includes/config.php');
if (!empty($_POST["catid"])) {
    $id = intval($_POST['catid']);
    $query = mysqli_query($con, "SELECT * FROM product WHERE categories_id=$id and Is_Active=1");
?>
    <option value="">Select Category</option>
    <?php
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['product_name']); ?></option>
<?php
    }
}
?>