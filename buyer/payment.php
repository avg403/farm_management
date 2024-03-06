<?php
require_once 'config.php';

class Payment extends Database
{
    public function generateBill($cartProducts)
    {
        echo "<div class='card' style='width: 18rem;'>";
        echo "<div class='card-header'>";
        echo " Purchase confirmed!";
        echo "</div>";

        if (!empty($cartProducts)) {
            echo "<ul class='list-group list-group-flush'>";

            foreach ($cartProducts as $product) {
                echo "<li class='list-group-item'>{$product['p_name']}</li>";
                echo "<li class='list-group-item'>Quantity:{$product['quantity']}</li>";
                echo "<li class='list-group-item'>Item Total: $" . ($product['p_price'] * $product['quantity']) .  "</li>";
            }
            
            echo "</ul>";
        } else {
            echo "<p>No items in the cart.</p>";
        }
    }

    public function processPurchase()
    {
        // echo '<script>alert("processPurchase");</script>';
        global $buyer, $cart;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['total_purchase_button']) && $_POST['total_purchase_button'] == 'Purchase All') {

            //echo "<p>Total purchase confirmed!</p>";
            $buyerId = $_SESSION['b_id']; // Add this line
            $cartProducts = $cart->myCart($buyerId);
            $this->generateBill($cartProducts);

            $totalAmount = 0;

            foreach ($cartProducts as $product) {
                $cart->insertOrder($buyerId, $product['p_id'], $product['quantity']);
                $totalAmount += $product['p_price'] * $product['quantity'];
                $cart->deleteCartItem($buyerId, $product['p_id']);
            }
            echo "<li class='list-group-item'> Total Amount: $" . $totalAmount . "</li>";
            $expectedDeliveryDate = date('Y-m-d', strtotime("+5 days"));
            echo "<p>Expected Delivery Date: " . $expectedDeliveryDate . "</p>";
            echo  "</ul>";
            echo "</div>";

            //$cart->clearCart($buyerId);


        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['individual_purchase']) && $_POST['individual_purchase'] == 'Purchase') {
            //echo '<script>alert("payment");</script>';

            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];


            $productQuery = "SELECT p_name, p_price FROM product WHERE p_id = ?";
            $productStmt = $this->connection->prepare($productQuery);

            if ($productStmt) {
                $productStmt->bind_param("i", $productId);
                $productStmt->execute();
                $productStmt->store_result();

                if ($productStmt->num_rows > 0) {
                    $productStmt->bind_result($productName, $productPrice);
                    $productStmt->fetch();
                    $buyerId = $_SESSION['b_id'];
                    $cart->insertOrder($buyerId, $productId, $quantity);
                    echo "<div class='card' style='width: 18rem;'>";
                    echo "<div class='card-header'>";
                    echo "Individual purchase confirmed!";
                    echo "</div>";
                    echo "<ul class='list-group list-group-flush'>";
                    echo "<li class='list-group-item'>{$productName}</li>";
                    echo "<li class='list-group-item'>Quantity: $quantity</li>";
                    echo "<li class='list-group-item'>Item Total: $" . ($productPrice * $quantity) . "</li>";
                    $expectedDeliveryDate = date('Y-m-d', strtotime("+5 days"));
                echo "<p>Expected Delivery Date: " . $expectedDeliveryDate . "</p>";
                    echo  "</ul>";
                    echo "</div>";


                    $cart->deleteCartItem($buyerId, $productId);
                } else {
                    echo "<p>Product not found.</p>";
                }

                $productStmt->close();
            } else {
                echo "Error in the SQL statement ";
            }
        }
    }
}
