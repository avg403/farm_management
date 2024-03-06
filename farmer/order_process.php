<?php
require 'farmer.php';

$farmer = new Farmer();
session_start(); // Start the session
if (isset($_SESSION['f_id'])) {
    $f_id = $_SESSION['f_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['process_order'])) {
        $order_id = $_POST['order_id'];
        $farmer->processOrder($order_id);
    }
}
$orders = $farmer->getOrders($f_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Order</title>

    <link rel="stylesheet" href="styl.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <h1>Process Order</h1>

    <?php if (!empty($orders)) : ?>
        <table class='table table-striped'>
            <tr>
                <th>Order ID</th>
                <th>Buyer Name</th>
                <th>Buyer Address</th>
                <th>Buyer Phone</th>
                <th>Buyer PIN</th>
                <th>Buyer Email</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <td>Order Date</td>

                <th>Action</th>

            </tr>

            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['b_name']; ?></td>
                    <td><?php echo $order['b_address']; ?></td>
                    <td><?php echo $order['b_phone']; ?></td>
                    <td><?php echo $order['b_pin']; ?></td>
                    <td><?php echo $order['b_mail']; ?></td>
                    <td><?php echo $order['p_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['c_date']; ?></td>

                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <input type="submit" name="process_order" value="Process">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No orders to display.</p>
    <?php endif; ?>

    <center><button class="btn btn-dark" onclick="window.location.href = 'farmer_home.php'">HOME</button></center><br><br>

</body>

</html>