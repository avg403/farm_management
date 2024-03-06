<?php
require_once 'config.php';

class Cart extends Database
{
    public function myCart($buyerId)
    {
        $query = "SELECT p.p_id, p.p_name, p.p_price, p.p_descript, s.quantity
                FROM cart s
                JOIN product p ON s.p_id = p.p_id
                WHERE s.b_id = $buyerId";
        $result = $this->connection->query($query);

        $cartProducts = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cartProducts[] = $row;
            }
        }

        return $cartProducts;
    }

    public function addToCart($buyerId, $productId, $quantity)
    {

        $existingStmt = $this->connection->prepare("SELECT quantity FROM cart WHERE b_id = ? AND p_id = ?");
        $existingStmt->bind_param("ii", $buyerId, $productId);
        $existingStmt->execute();
        $existingStmt->store_result();

        if ($existingStmt->num_rows > 0) {

            $existingStmt->bind_result($existingQuantity);
            $existingStmt->fetch();

            $newQuantity = $existingQuantity + $quantity;

            $updateStmt = $this->connection->prepare("UPDATE cart SET quantity = ? WHERE b_id = ? AND p_id = ?");
            $updateStmt->bind_param("iii", $newQuantity, $buyerId, $productId);

            if ($updateStmt->execute()) {
                echo '<script>alert("Product quantity updated successfully!");</script>';
            } else {
                echo "Error: " . $updateStmt->error;
            }

            $updateStmt->close();
        } else {

            $insertStmt = $this->connection->prepare("INSERT INTO cart (b_id, p_id, quantity) VALUES (?, ?, ?)");

            if ($insertStmt) {
                $insertStmt->bind_param("iii", $buyerId, $productId, $quantity);

                if ($insertStmt->execute()) {
                    echo '<script>alert("Product added to the cart successfully!");</script>';
                } else {
                    echo "Error: " . $insertStmt->error;
                }

                $insertStmt->close();
            } else {
                echo "Error in the SQL statement: " . $this->connection->error;
            }
        }

        $existingStmt->close();
    }




    public function insertOrder($buyerId, $productId, $quantity)
    {
        $stmt = $this->connection->prepare("INSERT INTO `orders` (b_id, p_id, quantity, f_id, c_date) VALUES (?, ?, ?, ?, ?)");
        $stmt1 = $this->connection->prepare("SELECT f_id FROM product WHERE p_id = ?");
        $stmt1->bind_param("i", $productId);
        $stmt1->execute();
        $stmt1->bind_result($f_id);
        // Fetch the result
        $stmt1->fetch();
        $stmt1->close();
        if ($stmt) {
            $currentDate = date("Y-m-d");
            $stmt->bind_param("iiiis", $buyerId, $productId, $quantity, $f_id,$currentDate);

            if ($stmt->execute()) {
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in the SQL statement: " . $this->connection->error;
        }
    }

    public function deleteCartItem($buyerId, $productId)
    {
        $stmt = $this->connection->prepare("DELETE FROM cart WHERE b_id = ? AND p_id = ?");

        if ($stmt) {
            $stmt->bind_param("ii", $buyerId, $productId);

            if ($stmt->execute()) {
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in the SQL statement: " . $this->connection->error;
        }
    }


    public function updateCartItemQuantity($buyerId, $productId, $quantity)
    {
        $stmt = $this->connection->prepare("UPDATE cart SET quantity = ? WHERE b_id = ? AND p_id = ?");

        if ($stmt) {
            $stmt->bind_param("iii", $quantity, $buyerId, $productId);

            if ($stmt->execute()) {
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in the SQL statement: " . $this->connection->error;
        }
    }

    public function getProductQuantity($productId)
    {
        $sql = "SELECT p_quantity FROM product WHERE p_id = $productId";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productQuantity = $row["p_quantity"];
        } else {

            $productQuantity = -1;
        }
        return $productQuantity;
    }

    public function updateProductQuantityAfterPurchase($productId, $quantity)
    {

        $sql = "SELECT p_quantity FROM product WHERE p_id = $productId";
        $result = $this->connection->query($sql);

        if (!$result) {
            echo "Error in SQL query: " . $this->connection->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentQuantity = $row["p_quantity"];


            $newQuantity = $currentQuantity - $quantity;


            $updateSql = "UPDATE product SET p_quantity = $newQuantity WHERE p_id = $productId";
            if ($this->connection->query($updateSql) === TRUE) {
                //echo "Product quantity updated successfully after individual purchase.";
            } else {
                echo "Error updating product quantity: " . $this->connection->error;
            }
        } else {
            echo "Product not found.";
        }
    }

    public function updateProductQuantitiesAfterTotalPurchase($cartProducts)
    {
        echo '<script>alert("reached updateProductQuantitiesAfterTotalPurchase");</script>';
        foreach ($cartProducts as $product) {
            $productId = $product['p_id'];
            $quantity = $product['quantity'];

            $sql = "SELECT p_quantity FROM product WHERE p_id = $productId";
            $result = $this->connection->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentQuantity = $row["p_quantity"];


                $newQuantity = $currentQuantity - $quantity;


                $updateSql = "UPDATE product SET p_quantity = $newQuantity WHERE p_id = $productId";
                if ($this->connection->query($updateSql) === TRUE) {
                    echo "Product quantity updated successfully after total purchase.";
                } else {
                    echo "Error updating product quantity: ";
                }
            } else {
                echo "Product not found.";
            }
        }
    }


    public function calculateTotalAmount($cartProducts)
    {
        $totalAmount = 0;
        foreach ($cartProducts as $product) {
            $totalAmount += $product['p_price'] * $product['quantity'];
        }
        return $totalAmount;
    }

    public function checkTotalPurchaseAvailability($cartProducts, $buyerId)
    {
        foreach ($cartProducts as $product) {
            $productId = $product['p_id'];
            $quantity = $product['quantity'];
            $val = $this->validateQuantity($buyerId, $productId, $quantity);
            if (!$val) {
                return false;
            }
        }
        return true;
    }


    public function validateQuantity($buyerId, $productId, $newQuantity)
    {
        $availableQuantity = $this->getProductQuantity($productId);

        if ($newQuantity <= $availableQuantity) {
            return true;
        } else {
            // echo '<script>alert("Not enough quantity available!");</script>';
            return false;
        }
    }
}
