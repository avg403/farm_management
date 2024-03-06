<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <title>STOCK</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styl.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body>
    <h1>Stock Information</h1>


    <div class="container">
        <?php

        require 'farmer.php';

        $farmer = new Farmer();

        if (isset($_POST['update_stock'])) {
            $product_id = $_POST['product_id'];
            $new_stock = $_POST['new_stock'];

            $success = $farmer->updateStock($product_id, $new_stock);
            if ($success) {
                echo '<script>alert("Stock updated successfully.");</script>';
            } else {
                echo '<script>alert("Stock update failed.");</script>';
            }
        }

        $farmer->displayStock();
        ?>
    </div>
    <br> <br>
    <center> <button class="btn btn-dark" onclick=" window.location.href = 'farmer_home.php'">HOME</button></center><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>