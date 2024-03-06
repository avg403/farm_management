<?php
require 'farmer.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Product</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleee.css">
</head>

<body>
    <div class="login-box">
        <h2>Add Product</h2>
        <form method="POST" action="insert_product.php" enctype="multipart/form-data">
            <div class="user-box">


                <input type="text" name="p_name" required>
                <label for="p_name">Product Name:</label>


            </div>

            <div class="user-box">
                <input type="number" step="0.01" name="p_price" required>
                <label for="p_price">Price:</label>


            </div>

            <div class="user-box">
                <input type="number" name="p_quantity" required>
                <label for="p_quantity">Quantity:</label>

            </div>

            <div class="user-box">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="p_image" required style="color:#4682b4;">
                <label for="p_image">Image:</label>


            </div>



            <div class="user-box">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type='text' name="p_descript" required></input>
                <label for="p_descript">Description:</label>


            </div>


            <div class="user-box">

                <label for="c_id">Category:</label>
                <br><br>
                <?php
                $farmer = new Farmer();
                $farmer->fetchcategory();
                ?>



            </div>






            <a class="btn__submit" href="#" onclick="submitForm()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </a>


            <div>
                <a class="btn__submit" href="farmer_home.php">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    HOME
                </a>

            </div>



        </form>
    </div>

    <script>
        function submitForm() {
            document.querySelector('form').submit(); // Trigger the form submission
        }
    </script>
</body>

</html>