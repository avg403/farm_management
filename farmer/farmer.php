<?php
require 'config.php';

class Farmer extends Database
{
    public function insertFarmer($f_name, $f_mail, $f_address, $f_pass, $f_phone, $f_pin, $f_status)
    {
        $pass = md5($f_pass);
        $stmt = $this->connection->prepare("INSERT INTO farmer ( f_name, f_mail, f_address, f_pass, f_phone, f_pin,f_status) VALUES (?, ?, ?, ?, ?, ?,?)");

        if ($stmt) {
            $stmt->bind_param("ssssisi", $f_name, $f_mail, $f_address, $pass, $f_phone, $f_pin, $f_status);

            if ($stmt->execute()) {
                echo '<script>
                alert("Your request has been sent");
                window.location.href = "farmer_login_form.php";
            </script>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in the SQL statement: " . $this->connection->error;
        }
    }

    public function loginFarmer($f_name, $f_pass)
    {
        $stmt = $this->connection->prepare("SELECT f_id, f_name, f_status FROM farmer WHERE f_name = ? AND f_pass = ?");

        if ($stmt) {
            $stmt->bind_param("ss", $f_name, $f_pass);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($f_id, $f_name, $f_status);
                $stmt->fetch();

                return array('f_id' => $f_id, 'f_name' => $f_name, 'f_status' => $f_status);
            }
        }

        return false;
    }



    public function insertProduct($p_name, $p_price, $p_quantity, $p_image, $p_descript, $c_id, $f_id)
    {
        $stmt = $this->connection->prepare("INSERT INTO product (p_name, p_price, p_quantity, p_image, p_descript, c_id,f_id) VALUES (?, ?, ?, ?, ?, ?,?)");

        if ($stmt) {
            $stmt->bind_param("siissii", $p_name, $p_price, $p_quantity, $p_image, $p_descript, $c_id, $f_id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

            $stmt->close();
        } else {
            return false;
        }
    }


    public function fetchcategory()
    {
        $query = "SELECT c_id, c_name FROM category";
        $result = $this->connection->query($query);
        if ($result) {
            echo '<label for="c_id">Category:</label>';
            echo '<select name="c_id"  required style="height:40px; background-color:#4682b4; color:#f0fff0 ; font-size:17px;"  required>';

            while ($row = $result->fetch_assoc()) {
                $id = $row['c_id'];
                $name = $row['c_name'];
                echo "<option value=\"$id\">$name</option>";
            }

            echo '</select><br>';
        } else {

            echo "Error: " . $this->connection->error;
        }
    }


    public function editProducts()
    {
        session_start(); // Start the session
        if (isset($_SESSION['f_id'])) {
            $f_id = $_SESSION['f_id'];
            $query = "SELECT p.p_id, p.p_name, p.p_price, p.p_quantity, p.p_image, p.p_descript, c.c_name 
                  FROM product p
                  JOIN category c ON p.c_id = c.c_id where f_id=$f_id";

            $result = $this->connection->query($query);

            if ($result->num_rows > 0) {
                echo "<h2 style='color: #14f5d4;font-family : Trebuchet MS;'>Products List</h2>";
                echo "<table class='table table-striped'>";
                echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Quantity</th><th>Image</th><th>Description</th><th>Category</th><th>Action</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['p_id'] . "</td>";
                    echo "<td>" . $row['p_name'] . "</td>";
                    echo "<td>" . $row['p_price'] . "</td>";
                    echo "<td>" . $row['p_quantity'] . "</td>";
                    echo "<td><img src='product_images/" . $row['p_image'] . "' height='100'></td>";
                    echo "<td>" . $row['p_descript'] . "</td>";
                    echo "<td>" . $row['c_name'] . "</td>";
                    echo "<td><a href='delete_product.php?p_id=" . $row['p_id'] . "' style='color: red;'>Delete</a> | <a href='update_product.php?p_id=" . $row['p_id'] . "' style='color: lime;'>Update</a></td>";

                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No products found.";
            }
        }
    }




    public function deleteProduct($p_id)
    {
        $p_id = $this->connection->real_escape_string($p_id);


        $queryDeleteOrders = "DELETE FROM orders WHERE p_id = $p_id";
        $resultDeleteOrders = $this->connection->query($queryDeleteOrders);

        if ($resultDeleteOrders) {

            $queryDeleteCart = "DELETE FROM cart WHERE p_id = $p_id";
            $resultDeleteCart = $this->connection->query($queryDeleteCart);

            if ($resultDeleteCart) {

                $queryDeleteProduct = "DELETE FROM product WHERE p_id = $p_id";
                $resultDeleteProduct = $this->connection->query($queryDeleteProduct);

                return $resultDeleteProduct;
            } else {
                echo '<script>alert("Failed to delete cart records.");</script>';
                echo '<script>window.location = "delete_product.php";</script>';
            }
        } else {
            echo '<script>alert("Failed to delete orders.");</script>';
            echo '<script>window.location = "delete_product.php";</script>';
        }
    }










    public function getProductDetails($p_id)
    {
        $stmt = $this->connection->prepare("SELECT p_id, p_name, p_price, p_quantity, p_image, p_descript, c_id FROM product WHERE p_id = ?");
        $stmt->bind_param("i", $p_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $productDetails = $result->fetch_assoc();
        $stmt->close();

        return $productDetails;
    }

    public function updateProduct($p_id, $p_name, $p_price, $p_quantity, $p_image, $p_descript, $c_id)
    {
        $stmt = $this->connection->prepare("UPDATE product SET p_name = ?, p_price = ?, p_quantity = ?, p_image = ?, p_descript = ?, c_id = ? WHERE p_id = ?");
        $stmt->bind_param("siissii", $p_name, $p_price, $p_quantity, $p_image, $p_descript, $c_id, $p_id);

        if ($stmt->execute()) {

            $stmt->close();
            return true;
        } else {

            $stmt->close();
            return false;
        }
    }


    public function getCategories()
    {
        $query = "SELECT c_id, c_name FROM category";
        $result = $this->connection->query($query);

        $categories = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        return $categories;
    }


    public function getProducts()
    {
        session_start();
        if (isset($_SESSION['f_id'])) {
            $f_id = $_SESSION['f_id'];
            $query = "SELECT p.p_name, p.p_price, p.p_image, p.p_descript,c.c_name FROM product p INNER JOIN category c ON p.c_id = c.c_id where p.f_id=$f_id;";

            $result = $this->connection->query($query);

            if (!$result) {
                die("Query failed: " . $this->connection->error);
            }

            $products = [];

            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            return $products;
        }
    }






    public function displayStock()
    {
        session_start();
        if (isset($_SESSION['f_id'])) {
            $f_id = $_SESSION['f_id'];
            $query = "SELECT p_id, p_name, p_image, p_quantity FROM product where f_id=$f_id";
            $result = $this->connection->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<div class="card-header">';
                    echo '<img src="product_images/' . $row['p_image'] . '" alt="' . $row['p_name'] . '" width="" height="">';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<span class="tag tag-teal">' . $row['p_name'] . '</span>';
                    echo '<h4>Quantity: <span style="color:rgb(195 42 250 / 84%);">' . $row['p_quantity'] . '</span></h4>';

                    echo '<form method="POST" action="stock_management.php">';
                    echo '<input type="number" name="product_id" value="' . $row['p_id'] . '" style="display: none;">';
                    echo '<input type="number" name="new_stock" placeholder="Enter new stock" required>';
                    echo '<br>';
                    echo '<input type="submit" class="btn btn-info" name="update_stock" value="Update Stock">';
                    echo '</form>';

                    echo '</div>';

                    echo '</div>';
                }
            }
        }
    }


    public function updateStock($product_id, $new_stock)
    {

        $product_id = $this->connection->real_escape_string($product_id);
        $new_stock = $this->connection->real_escape_string($new_stock);

        $query = "SELECT p_id, p_name, p_image, p_quantity FROM product where p_id=$product_id";
        $result = $this->connection->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $old_stock = $row['p_quantity'];
            }
        }
        $new_stock1 = $new_stock + $old_stock;




        $query = "UPDATE product SET p_quantity = '$new_stock1' WHERE p_id = $product_id";
        $result = $this->connection->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }



    public function displayProfile()
    {
        session_start();
        if (isset($_SESSION['f_id'])) {
            $f_id = $_SESSION['f_id'];

            $query = "SELECT f_id, f_name, f_mail, f_address, f_phone, f_pin FROM farmer WHERE f_id = $f_id";
            $result = $this->connection->query($query);

            if ($result) {
                echo '<table>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>ID : </td>';
                    echo '<td>' . $row['f_id'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>NAME : </td>';
                    echo '<td>' . $row['f_name'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>MAIL : </td>';
                    echo '<td>' . $row['f_mail'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>ADDRESS : &nbsp&nbsp&nbsp </td>';
                    echo '<td>' . $row['f_address'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>PHONE : </td>';
                    echo '<td>' . $row['f_phone'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>PIN : </td>';
                    echo '<td>' . $row['f_pin'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    }





    public function getOrders($f_id)
    {
        $query = "SELECT o.order_id, o.b_id, o.p_id, o.quantity, o.status, o.c_date , b.b_name, b.b_address, b.b_phone, b.b_pin, b.b_mail, p.p_name, p.p_price 
              FROM orders o
              JOIN buyer b ON o.b_id = b.b_id
              JOIN product p ON o.p_id = p.p_id
              WHERE o.f_id = $f_id AND o.status = 0";
        $result = $this->connection->query($query);

        if (!$result) {
            die("Query failed: " . $this->connection->error);
        }

        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        return $orders;
    }

    public function processOrder($order_id)
    {
        $query = "UPDATE orders SET status = 1 WHERE order_id = $order_id";
        $result = $this->connection->query($query);

        if (!$result) {
            die("Query failed: " . $this->connection->error);
        }

        echo "Order processed successfully!";
    }

    public function getProcessedOrders($f_id, $selectedMonth, $selectedDay, $selectedYear)
    {
        $query = "SELECT o.order_id, o.b_id, o.p_id, o.quantity, o.status, o.c_date, b.b_name, b.b_address, b.b_phone, b.b_pin, b.b_mail, p.p_name, p.p_price 
                  FROM orders o
                  JOIN buyer b ON o.b_id = b.b_id
                  JOIN product p ON o.p_id = p.p_id
                  WHERE o.f_id = $f_id AND o.status = 1
                  AND MONTH(o.c_date) = $selectedMonth
                  AND DAY(o.c_date) = $selectedDay
                  AND YEAR(o.c_date) = $selectedYear";

        $result = $this->connection->query($query);

        if (!$result) {
            die("Query failed: " . $this->connection->error);
        }

        $processedOrders = [];

        while ($row = $result->fetch_assoc()) {
            $processedOrders[] = $row;
        }

        return $processedOrders;
    }











    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
