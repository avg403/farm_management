<?php
require 'Farmer.php';

$farmer = new Farmer();

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    $productDetails = $farmer->getProductDetails($p_id);

    if ($productDetails) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $p_name = $_POST['p_name'];
            $p_price = $_POST['p_price'];
            $p_quantity = $_POST['p_quantity'];
            $p_descript = $_POST['p_descript'];
            $c_id = $_POST['c_id'];
            $old_image = $_POST['old_image'];

            if (isset($_FILES['p_image']) && !empty($_FILES['p_image']['name'])) {
                $newImage = $_FILES['p_image'];

                $targetDirectory = 'product_images/';

                $newImageName = uniqid() . '_' . $newImage['name'];

                $newImagePath = $targetDirectory . $newImageName;

                if (move_uploaded_file($newImage['tmp_name'], $newImagePath)) {
                    $oldImagePath = 'product_images/' . $productDetails['p_image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }

                    $p_image = $newImageName;
                } else {
                    echo "Image upload failed.";
                }
            } else {

                $p_image = $old_image;
            }

            $updateSuccess = $farmer->updateProduct($p_id, $p_name, $p_price, $p_quantity, $p_image, $p_descript, $c_id);

            if ($updateSuccess) {
                header("Location: edit_products.php");
            } else {
                echo "Product update failed.";
            }
        }
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID is missing.";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Product</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleee.css">
</head>

<body>
    <div class="login-box">
        <h2>Update Product</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="user-box">


                <input type="text" name="p_name" value="<?php echo $productDetails['p_name']; ?>" required><br>
                <label for="p_name">Product Name:</label>


            </div>

            <div class="user-box">
                <input type="number" name="p_price" value="<?php echo $productDetails['p_price']; ?>" required><br>
                <label for="p_price">Price:</label>


            </div>

            <div class="user-box">
                <input type="number" name="p_quantity" value="<?php echo $productDetails['p_quantity']; ?>" required><br>
                <label for="p_quantity">Quantity:</label>

            </div>

            <div class="user-box">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="p_image">
                <img src="product_images/<?php echo $productDetails['p_image']; ?>" height="100"><br>
                <input type="text" name="old_image" value="<?php echo $productDetails['p_image']; ?>" hidden>

                <label for="p_image">Image:</label>

            </div>



            <div class="user-box">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <textarea name="p_descript" required><?php echo $productDetails['p_descript']; ?></textarea><br>
                <label for="p_descript">Description:</label>


            </div>


            <div class="user-box">

                <label for="c_id">Category:</label>
                <br><br>
                <select name="c_id" required>
                    <?php
                    $categories = $farmer->getCategories();
                    foreach ($categories as $category) {
                        $selected = ($category['c_id'] == $productDetails['c_id']) ? 'selected' : '';
                        echo "<option value=\"{$category['c_id']}\" $selected>{$category['c_name']}</option>";
                    }
                    ?>
                </select><br>



            </div>






            <a class="btn__submit" href="#" onclick="submitForm()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                UPDATE
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