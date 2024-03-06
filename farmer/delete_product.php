<?php
require 'Farmer.php';


$farmer = new Farmer();

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    $success = $farmer->deleteProduct($p_id);

    if ($success) {
        header("Location: edit_products.php"); 
    } else {
        echo "Product deletion failed.";
    }
} else {
    echo "Product ID is missing.";
}
?>
