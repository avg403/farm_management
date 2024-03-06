<?php
require 'farmer.php';

$farmer = new Farmer();
session_start(); // Start the session
if (isset($_SESSION['f_id'])) {
    $f_id = $_SESSION['f_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedMonth = $_POST['month'];
        $selectedDay = $_POST['day'];
        $selectedYear = $_POST['year'];

        // Display already processed orders for the selected date
        $processedOrders = $farmer->getProcessedOrders($f_id, $selectedMonth, $selectedDay, $selectedYear);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>

    <link rel="stylesheet" href="styl.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1>Order History</h1>

    <!-- Form for selecting the date -->
    <form method="POST" action="">
        <label for="month">Month:</label>
        <select class="form-select" size="3" aria-label="Size 3 select example" name="month" required>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

        <label for="day">Day:</label>
        <select class="form-select" size="3" aria-label="Size 3 select example" name="day" required>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

        <label for="year">Year:</label>
        <select class="form-select" size="3" aria-label="Size 3 select example" name="year" required>
            <?php
            for ($i = date("Y"); $i >= 2020; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

        <input type="submit" class="btn btn-dark" value="Show Processed Orders">
    </form>

    <?php if (!empty($processedOrders)) : ?>
        <!-- Display processed orders in a table -->
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
                <th>Order Date</th>
            </tr>

            <?php foreach ($processedOrders as $processedOrder) : ?>
                <tr>
                    <td><?php echo $processedOrder['order_id']; ?></td>
                    <td><?php echo $processedOrder['b_name']; ?></td>
                    <td><?php echo $processedOrder['b_address']; ?></td>
                    <td><?php echo $processedOrder['b_phone']; ?></td>
                    <td><?php echo $processedOrder['b_pin']; ?></td>
                    <td><?php echo $processedOrder['b_mail']; ?></td>
                    <td><?php echo $processedOrder['p_name']; ?></td>
                    <td><?php echo $processedOrder['quantity']; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($processedOrder['c_date'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No processed orders for the selected date.</p>
    <?php endif; ?>

    <center><button class="btn btn-dark" onclick="window.location.href = 'farmer_home.php'">HOME</button></center><br><br>
</body>

</html>