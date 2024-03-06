<?php
require 'Buyer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_name = $_POST["b_name"];
    $b_mail = $_POST["b_mail"];
    $b_address = $_POST["b_address"];
    $b_pass = $_POST["b_pass"];
    $b_phone = $_POST["b_phone"];
    $b_pin = (int)$_POST["b_pin"];

    
    if (empty($b_name) || empty($b_mail) || empty($b_pass) || empty($b_address) || empty($b_phone) || empty($b_pin)) {
        echo '<script>alert("Please fill in all required fields.");</script>';
        echo '<script>window.location = "buyer_login_form.php";</script>';
    } elseif (!filter_var($b_mail, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email address.");</script>';
        echo '<script>window.location = "buyer_login_form.php";</script>';
    } elseif (!preg_match("/^[6-9]\d{9}$/", $b_phone)) {
        echo '<script>alert("Invalid phone number.");</script>';
        echo '<script>window.location = "buyer_login_form.php";</script>';
    } elseif (!preg_match("/^\d{6}$/", $b_pin)) {
        echo '<script>alert("Invalid PIN code.");</script>';
        echo '<script>window.location = "buyer_login_form.php";</script>';
    } else {
        $buyer = new Buyer();
        $buyer->insertBuyer( $b_name, $b_mail, $b_address, $b_pass, $b_phone, $b_pin);
    }
}
