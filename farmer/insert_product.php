<?php
require 'farmer.php';

session_start();

if (isset($_SESSION['f_id'])) {
    $f_id = $_SESSION['f_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $p_name = $_POST["p_name"];
        $p_price = (float)$_POST["p_price"];
        $p_quantity = (int)$_POST["p_quantity"];
        $p_descript = $_POST["p_descript"];
        $c_id = (int)$_POST["c_id"];

        $p_image = $_FILES["p_image"]["name"];
        $target_dir = "product_images/";
        $target_file = $target_dir . basename($p_image);

        // Image Validation
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if ($_FILES["p_image"]["error"] !== UPLOAD_ERR_OK) {
            echo '<script>alert("File upload failed. Please try again.");</script>';
            echo '<script>window.location.href = "product_form.php";</script>';
        } else {
            $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $fileSize = $_FILES["p_image"]["size"];

            if (!in_array($fileExtension, $allowedExtensions)) {
                echo '<script>alert("Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF.");</script>';
                echo '<script>window.location.href = "product_form.php";</script>';
            } elseif ($fileSize > $maxFileSize) {
                echo '<script>alert("Image file size exceeds the maximum allowed size (5MB).");</script>';
                echo '<script>window.location.href = "product_form.php";</script>';
            } elseif (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) {
                $farmer = new Farmer();
                if ($farmer->insertProduct($p_name, $p_price, $p_quantity, $p_image, $p_descript, $c_id, $f_id)) {
                    echo '<script>alert("Product added successfully!");</script>';
                    echo '<script>window.location.href = "farmer_home.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("Product insertion failed. Please check your data.");</script>';
                    echo '<script>window.location.href = "product_form.php";</script>';
                }
            } else {
                echo '<script>alert("File upload failed. Please try again.");</script>';
                echo '<script>window.location.href = "product_form.php";</script>';
            }
        }
    }
}
?>
