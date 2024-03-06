<?php


require 'Buyer.php';
require 'Cart.php';

$cart = new Cart();
$buyer = new Buyer();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $buyerId = isset($_SESSION['b_id']) ? $_SESSION['b_id'] : null;
    $val = $cart->validateQuantity($buyerId, $productId, $quantity);
    if ($val) {
        $cart->addToCart($buyerId, $productId, $quantity);
    } else {
        $availableQuantity = $cart->getProductQuantity($productId);
        echo '<script>alert("Not enough quantity available! Available Quantity is ' . $availableQuantity . '");</script>';
    }
}

$products = $buyer->getProducts();
?>


<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styl.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



</head>

<body>
    <h1>Products</h1>
    <div class="container1">
        <?php
        foreach ($products as $product) {
            echo '<div class="card">';
            echo '<div class="card-header">';
            echo '<img src="../farmer/product_images/' . $product['p_image'] . '" alt="' . $product['p_name'] . '" width="" height="">';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h3>' . $product['p_name'] . '</h3>';
            echo '<p>Price: ₹' . $product['p_price'] . '</p>';
            echo '<p>Category: ' . $product['c_name'] . '</p>';
            echo '<p>Farmer: ' . $product['f_name'] . '</p>'; 
            echo '<p> ' . $product['p_descript'] . '</p>';
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="product_id" value="' . $product['p_id'] . '">';
            echo 'Quantity: <input type="number" name="quantity" value="1" min="1">';
            echo '<input type="submit" class="btn btn-info" value="Add to Cart">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }


        ?>
    </div>
    <center>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>