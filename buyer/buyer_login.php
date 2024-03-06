<?php
require 'Buyer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_name = $_POST["b_name"];
    $b_pass = $_POST["b_pass"];
    $pass = md5($b_pass);

    $buyer = new Buyer();
    $result = $buyer->loginBuyer($b_name, $pass);

    if ($result) {
        if ($result['b_status'] == 0) {
            echo '<script>alert("Approval from admin is still pending.");</script>';
            echo '<script>window.location.href = "../index.php";</script>';
            exit;
        } elseif ($result['b_status'] == 1) {
            session_start();
            $_SESSION['b_id'] = $result['b_id'];
            header("Location: buyer_home.php");
            exit;
        } elseif ($result['b_status'] == 2) {
            echo '<script>alert("Admin rejected the request.");</script>';
            echo '<script>window.location.href = "../index.php";</script>';
            exit;
        }
    } else {
        header("Location: buyer_login_form.php");
    }
}
?>
