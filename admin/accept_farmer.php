<!DOCTYPE html>
<html>

<head>
    <title>Accept Farmer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-color:#fff ">
    <h1>Admin Panel - Farmer Approval</h1>

    <?php
    require 'Admin.php';

    $admin = new Admin();

    if (isset($_GET['action'])) {
        $f_id = $_GET['f_id'];
        $action = $_GET['action'];

        if ($action === 'accept') {
            $admin->updateStatusFarmer($f_id, 1);
        } elseif ($action === 'reject') {
            $admin->updateStatusFarmer($f_id, 2);
        }
    }

    $admin->displayFarmersStatus();
    ?>
    <br>
    <center><button type="button" class="btn btn-dark" onclick=" window.location.href = 'admin_home.php'">HOME</button></center><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>