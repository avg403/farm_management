<?php
require 'Admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a_name = $_POST["a_name"];
    $a_pass = $_POST["a_pass"];
    $pass=md5($a_pass);

    $admin = new Admin();
    $result = $admin->loginAdmin($a_name, $pass);

    if ($result) {
        session_start();
        $_SESSION['a_id'] = $result['a_id'];
        header("Location: admin_home.php");
    } else {
        header("Location: admin_login_form.php");
    }
}
