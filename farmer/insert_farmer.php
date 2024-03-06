<?php
require 'Farmer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = $_POST["f_name"];
    $f_mail = $_POST["f_mail"];
    $f_address = $_POST["f_address"];
    $f_pass = $_POST["f_pass"];
    $f_phone = $_POST["f_phone"];
    $f_pin = $_POST["f_pin"];
    $f_status = 0;

    if (empty($f_name) || empty($f_mail) || empty($f_pass) || empty($f_address) || empty($f_phone) || empty($f_pin)) {
        echo '<script>alert("Please fill in all required fields.");</script>';
        echo '<script>window.location = "farmer_login_form.php";</script>';
    } elseif (!filter_var($f_mail, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email address.");</script>';
        echo '<script>window.location = "farmer_login_form.php";</script>';
    } elseif (!preg_match("/^[6-9]\d{9}$/", $f_phone)) {
        echo '<script>alert("Invalid phone number.");</script>';
        echo '<script>window.location = "farmer_login_form.php";</script>';
    } elseif (!preg_match("/^\d{6}$/", $f_pin)) {
        echo '<script>alert("Invalid PIN code.");</script>';
        echo '<script>window.location = "farmer_login_form.php";</script>';
    } else {
        $farmer = new Farmer();
        $farmer->insertFarmer( $f_name, $f_mail, $f_address, $f_pass, $f_phone, $f_pin,$f_status);
    }
}
?>
