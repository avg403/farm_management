<?php
session_start();

require 'Buyer.php';
require 'Cart.php';
require 'Payment.php';

$cart = new Cart();
$buyer = new Buyer();
$payment = new Payment();

$buyerId = isset($_SESSION['b_id']) ? $_SESSION['b_id'] : null;
$cartProducts = $cart->myCart($buyerId);

if (!$buyerId) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_quantity'])) {
        $productId = $_POST['product_id'];
        $newQuantity = $_POST['quantity'];
        $val = $cart->validateQuantity($buyerId, $productId, $newQuantity);
        if ($val) {
            $cart->updateCartItemQuantity($buyerId, $productId, $newQuantity);
            echo '<meta http-equiv="refresh" content="0">';
        } else {
            $availableQuantity = $cart->getProductQuantity($productId);
            echo '<script>alert("Not enough quantity available! Available Quantity is ' . $availableQuantity . '");</script>';
        }
    } elseif (isset($_POST['delete_item'])) {
        $cart->deleteCartItem($buyerId, $_POST['product_id']);
        echo '<meta http-equiv="refresh" content="0">';
    } elseif (isset($_POST['individual_purchase'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $val = $cart->validateQuantity($buyerId, $productId, $quantity);
        if ($val) {
            $cart->updateProductQuantityAfterPurchase($productId, $quantity);
        } else {
            $availableQuantity = $cart->getProductQuantity($productId);
            $message = 'Not enough quantity available! Available Quantity is ' . $availableQuantity;
            header("Location: myCart.php?message=" . urlencode($message) . "&redirected=true");
            exit();
        }
    } elseif (isset($_POST['total_purchase_button'])) {
        $available = $cart->checkTotalPurchaseAvailability($cartProducts, $buyerId);
        if ($available) {
            foreach ($cartProducts as $product) {
                $cart->updateProductQuantityAfterPurchase($product['p_id'], $product['quantity']);
            }
        } else {
            $message = 'Not enough quantity available for total purchase! ';
            header("Location: myCart.php?message=" . urlencode($message) . "&redirected=true");
            exit();
        }
    }
}

$payment->processPurchase();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-color:#fff ">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <button type="button" class="btn btn-dark" onclick=" window.location.href = 'buyer_home.php'">HOME</button>

</body>

</html>