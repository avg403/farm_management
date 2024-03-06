<?php

require 'Farmer.php';


$farmer = new Farmer();

$products = $farmer->getProducts();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <title>PRODUCT LIST</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styl.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body>
    <h1>Products</h1>
    <div class="container">
        <?php
        foreach ($products as $product) {

            echo '<div class="card">';
            echo '<div class="card-header">';
            echo '<img src="product_images/' . $product['p_image'] . '" alt="' . $product['p_name'] . '" width="" height="">';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<span class="tag tag-teal">' . $product['p_name'] . '</span>';
            echo '<h4>Price: ₹ ' . $product['p_price'] . '</h4>';
            echo '<h4>Catogory: ' . $product['c_name'] . '</h4>';
            echo '<p>' . $product['p_descript'] . '</p>';

            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <br>
    <center><button class="btn btn-dark" onclick=" window.location.href = 'farmer_home.php'">HOME</button></center><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>