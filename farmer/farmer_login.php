<?php
require 'Farmer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = $_POST["f_name"];
    $f_pass = $_POST["f_pass"];
    $pass = md5($f_pass);

    $farmer = new Farmer();
    $result = $farmer->loginFarmer($f_name, $pass);

    if ($result) {

        if ($result['f_status'] == 0) {
            echo '<script>alert("Approval from admin is still pending.");</script>';
            echo '<script>window.location.href = "../index.php";</script>';
            exit;
        } elseif ($result['f_status'] == 1) {
           
session_start();
$_SESSION['f_id'] = $result['f_id'];

            header("Location: farmer_home.php");
            exit;
        } elseif ($result['f_status'] == 2) {
            echo '<script>alert("Admin rejected the request.");</script>';
            echo '<script>window.location.href = "../index.php";</script>';
            exit;
        }
    } else {
        header("Location: farmer_login_form.php");
    }
}
