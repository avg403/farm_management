<?php
require 'Farmer.php';

$farmer = new Farmer();

if (isset($_GET['logout'])) {
    $farmer->logout();
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <title>Farmer Home</title>
</head>

<body>
    <h1>Welcome Farmer</h1>


    <div class="container">
        <button class="btn-1" onclick="window.location.href='farmer_profile.php';">&nbsp &nbsp &nbsp View Profile &nbsp</button>
        <button class="btn-2" onclick="window.location.href='product_form.php';"> &nbsp Insert Product</button>
        <button class="btn-3" onclick="window.location.href='stock_management.php';">&nbsp &nbsp Update Stock &nbsp</button>
        <button class="btn-4" onclick="window.location.href='edit_products.php';">&nbsp &nbsp Edit Products &nbsp</button>
        <button class="btn-5" onclick="window.location.href='display_products.php';"> Display Products </button>
        <button class="btn-2" onclick="window.location.href='order_process.php';"> &nbsp &nbspProcess Order&nbsp &nbsp </button>
        <button class="btn-2" onclick="window.location.href='display_processed.php';"> &nbsp&nbsp&nbsp &nbsp &nbsp &nbsp &nbspHISTORY&nbsp&nbsp &nbsp &nbsp &nbsp&nbsp&nbsp </button>


        <button class="btn-1" onclick="window.location.href='../index.php?logout=1';">&nbsp &nbsp &nbsp &nbsp &nbsp &nbspLog Out &nbsp &nbsp &nbsp &nbsp &nbsp</button>


    </div>
    <script src="app.js"></script>
</body>

</html>