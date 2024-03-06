<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <title>Admin Home</title>
</head>

<body>
    <h1>Welcome Admin</h1>


    <div class="container">
        <button class="btn-1" onclick="window.location.href='admin_profile.php';">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp View Profile &nbsp &nbsp &nbsp &nbsp &nbsp </button>
        <button class="btn-2" onclick="window.location.href='accept_farmer.php';"> Accept Farmer Request</button>
        <button class="btn-3" onclick="window.location.href='accept_buyer.php';">&nbsp Accept Buyer Request</button>
        <button class="btn-4" onclick="window.location.href='remove_farmer.php';">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Remove Farmer &nbsp &nbsp &nbsp</button>
        <button class="btn-5" onclick="window.location.href='remove_buyer.php';"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Remove Buyer &nbsp &nbsp &nbsp &nbsp </button>
        <button onclick="window.location.href='../index.php?logout=1'">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspLog Out &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</button>
    </div>
    <script src="app.js"></script>

    <?php
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit;
    }
    ?>

</body>

</html>