<?php
session_start();

require 'Cart.php';
$cart = new Cart();

if (isset($_GET['redirected']) && $_GET['redirected'] == 'true') {
    // Display the message
    if (isset($_GET['message'])) {
        $message = urldecode($_GET['message']);
        echo '<script>alert("' . $message . '");</script>';
    }
    //header("Location: myCart.php");
}

$buyerId = isset($_SESSION['b_id']) ? $_SESSION['b_id'] : null;

$cartProducts = $cart->myCart($buyerId);
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-color:#fff  ">
    <h1>My Cart</h1>
    <?php
    if (empty($cartProducts)) {
        echo '<p>Your cart is empty.</p>';
    } else {
        echo '<table class="table table-striped" >';
        echo '<tr>';
        echo '<th>Product Name</th>';
        echo '<th>Price</th>';
        echo '<th>Description</th>';
        echo '<th>Update Quantity</th>';
        echo '<th>Delete Item</th>';
        echo '<th>Individual Purchase</th>';
        echo '</tr>';

        foreach ($cartProducts as $product) {
            echo '<tr>';
            echo '<td>' . $product['p_name'] . '</td>';
            echo '<td>₹' . $product['p_price'] . '</td>';
            echo '<td>' . $product['p_descript'] . '</td>';


            echo '<td>';
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="product_id" value="' . $product['p_id'] . '">';
            echo '<input type="number" name="quantity" value="' . $product['quantity'] . '" min="1">';
            echo '<input type="submit" class="btn btn-light" name="update_quantity" value="Update Quantity">';
            echo '</form>';
            echo '</td>';


            echo '<td>';
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="product_id" value="' . $product['p_id'] . '">';
            echo '<input type="submit" class="btn btn-light" name="delete_item" value="Delete Item">';
            echo '</form>';
            echo '</td>';


            echo '<td>';
            echo '<form method="POST" action="purchase_details.php">';
            echo '<input type="hidden" name="product_id" value="' . $product['p_id'] . '">';
            echo '<input type="hidden" name="quantity" value="' . $product['quantity'] . '">';
            echo '₹' . ($product['p_price'] * $product['quantity']);
            echo '<input type="submit" class="btn btn-light" name="individual_purchase" value="Purchase">';
            echo '</form>';
            echo '</td>';

            echo '</tr>';
        }


        echo '<tr>';
        echo '<td colspan="5">Total Purchase:</td>';
        echo '<td>';
        echo '<form method="POST" action="purchase_details.php">';
        echo '<input type="hidden" name="total_purchase" value="1">';
        echo '₹' . $cart->calculateTotalAmount($cartProducts);
        echo '<input type="submit"  class="btn btn-light" name="total_purchase_button" value="Purchase All">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';

        echo '</table>';
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update_quantity'])) {
            $productId = $_POST['product_id'];
            $newQuantity = $_POST['quantity'];
            $val = $cart->validateQuantity($buyerId, $productId, $newQuantity);
            if ($val) {
                $cart->updateCartItemQuantity($buyerId, $productId, $newQuantity);
                header("Location: myCart.php");
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                $availableQuantity = $cart->getProductQuantity($productId);
                echo '<script>alert("Not enough quantity available! Available Quantity is ' . $availableQuantity . '");</script>';
            }
        } elseif (isset($_POST['delete_item'])) {
            $cart->deleteCartItem($buyerId, $_POST['product_id']);
            echo '<meta http-equiv="refresh" content="0">';
        }
    }

    ?>
    <button type="button" class="btn btn-dark" onclick=" window.location.href = 'buyer_home.php'">HOME</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>