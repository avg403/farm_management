<?php
require 'config.php';

class Buyer extends Database
{
    public function insertBuyer($b_name, $b_mail, $b_address, $b_pass, $b_phone, $b_pin)
    {
        $pass = md5($b_pass);
        $stmt = $this->connection->prepare("INSERT INTO buyer ( b_name, b_mail, b_address, b_pass, b_phone, b_pin) VALUES ( ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sssssi", $b_name, $b_mail, $b_address, $pass, $b_phone, $b_pin);

            if ($stmt->execute()) {
                echo '<script>
                alert("Your request has been sent");
                window.location.href = "buyer_login_form.php";
            </script>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in the SQL statement: " . $this->connection->error;
        }
    }

    public function displayProfile()
    {
        session_start();
        if (isset($_SESSION['b_id'])) {
            $b_id = $_SESSION['b_id'];

            $query = "SELECT b_id, b_name, b_mail, b_address, b_phone, b_pin FROM buyer WHERE b_id = $b_id";
            $result = $this->connection->query($query);

            if ($result) {
                echo '<table>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>ID : </td>';
                    echo '<td>' . $row['b_id'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>NAME : </td>';
                    echo '<td>' . $row['b_name'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>MAIL : </td>';
                    echo '<td>' . $row['b_mail'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>ADDRESS : &nbsp&nbsp&nbsp </td>';
                    echo '<td>' . $row['b_address'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>PHONE : </td>';
                    echo '<td>' . $row['b_phone'] . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td>PIN : </td>';
                    echo '<td>' . $row['b_pin'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    }

    public function loginBuyer($b_name, $b_pass)
    {
        $stmt = $this->connection->prepare("SELECT b_id, b_name, b_status FROM buyer WHERE b_name = ? AND b_pass = ?");

        if ($stmt) {
            $stmt->bind_param("ss", $b_name, $b_pass);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($b_id, $b_name, $b_status);
                $stmt->fetch();

                return array('b_id' => $b_id, 'b_name' => $b_name, 'b_status' => $b_status);
            }
        }

        return false;
    }



    public function getProducts()
    {
        $query = "SELECT p.p_id, p.p_name, p.p_price, p.p_image, p.p_descript, c.c_name, f.f_name
              FROM product p
              JOIN category c ON p.c_id = c.c_id
              JOIN farmer f ON p.f_id = f.f_id";

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
