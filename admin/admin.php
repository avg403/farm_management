<?php
require 'config.php';

class Admin extends Database
{

    public function loginAdmin($a_name, $a_pass)
    {
        $stmt = $this->connection->prepare("SELECT a_id, a_name FROM admin WHERE a_name = ? AND a_pass = ?");

        if ($stmt) {
            $stmt->bind_param("ss", $a_name, $a_pass);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($a_id, $a_name);
                $stmt->fetch();
                return array('a_id' => $a_id, 'a_name' => $a_name);
            }
        }

        return false;
    }


    public function displayProfile()
    {

        if (isset($_SESSION['a_id'])) {
            $a_id = $_SESSION['a_id'];
        }

        $query = "SELECT a_id, a_name, a_mail FROM admin WHERE a_id = $a_id";
        $result = $this->connection->query($query);

        if ($result) {
            echo '<table>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>ID : </td>';
                echo '<td>' . $row['a_id'] . '</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>NAME : </td>';
                echo '<td>' . $row['a_name'] . '</td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>MAIL : </td>';
                echo '<td>' . $row['a_mail'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }



    public function getAdminImage()
    {
        session_start();
        if (isset($_SESSION['a_id'])) {
            $a_id = $_SESSION['a_id'];
        }
        $query = "SELECT a_image FROM admin WHERE a_id = $a_id"; // Adjust the query to your database structure
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['a_image'];
        } else {

            return 'profile.png';
        }
    }




    public function displayFarmersStatus()
    {
        $query = "SELECT f_id, f_name, f_mail, f_address, f_phone, f_pin, f_status FROM farmer WHERE f_status = 0";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Address</th>';
            echo '<th>Phone</th>';
            echo '<th>PIN</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['f_id'] . '</td>';
                echo '<td>' . $row['f_name'] . '</td>';
                echo '<td>' . $row['f_mail'] . '</td>';
                echo '<td>' . $row['f_address'] . '</td>';
                echo '<td>' . $row['f_phone'] . '</td>';
                echo '<td>' . $row['f_pin'] . '</td>';
                echo '<td>';
                echo '<a href="accept_farmer.php?action=accept&f_id=' . $row['f_id'] . '">Accept</a> | ';
                echo '<a href="accept_farmer.php?action=reject&f_id=' . $row['f_id'] . '"style="color:red;">Reject</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {

            echo '<h4 class="text-center text-danger">There are currently no new farmer requests.</h4>';
        }
    }


    public function updateStatusFarmer($f_id, $newStatus)
    {

        $f_id = $this->connection->real_escape_string($f_id);
        $newStatus = $this->connection->real_escape_string($newStatus);


        $query = "UPDATE farmer SET f_status = $newStatus WHERE f_id = $f_id";
        $result = $this->connection->query($query);

        return $result;
    }




    public function displayBuyersStatus()
    {
        $query = "SELECT b_id, b_name, b_mail, b_address, b_phone, b_pin, b_status FROM buyer WHERE b_status = 0";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Address</th>';
            echo '<th>Phone</th>';
            echo '<th>PIN</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['b_id'] . '</td>';
                echo '<td>' . $row['b_name'] . '</td>';
                echo '<td>' . $row['b_mail'] . '</td>';
                echo '<td>' . $row['b_address'] . '</td>';
                echo '<td>' . $row['b_phone'] . '</td>';
                echo '<td>' . $row['b_pin'] . '</td>';
                echo '<td>';
                echo '<a href="accept_buyer.php?action=accept&b_id=' . $row['b_id'] . '">Accept</a> | ';
                echo '<a href="accept_buyer.php?action=reject&b_id=' . $row['b_id'] . '" style="color:red;">Reject</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {


            echo '<h4 class="text-center text-danger">There are currently no new buyer requests.</h4>';
        }
        echo '</table>';
    }



    public function updateStatusBuyer($b_id, $newStatus)
    {

        $b_id = $this->connection->real_escape_string($b_id);
        $newStatus = $this->connection->real_escape_string($newStatus);


        $query = "UPDATE buyer SET b_status = $newStatus WHERE b_id = $b_id";
        $result = $this->connection->query($query);

        return $result;
    }


    public function displayCurrentFarmers($status)
    {
        $query = "SELECT f_id, f_name, f_mail, f_address, f_phone, f_pin, f_status FROM farmer WHERE f_status = $status";
        $result = $this->connection->query($query);

        if ($result) {
            echo '<table class="table table-striped">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Address</th>';
            echo '<th>Phone</th>';
            echo '<th>PIN</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['f_id'] . '</td>';
                echo '<td>' . $row['f_name'] . '</td>';
                echo '<td>' . $row['f_mail'] . '</td>';
                echo '<td>' . $row['f_address'] . '</td>';
                echo '<td>' . $row['f_phone'] . '</td>';
                echo '<td>' . $row['f_pin'] . '</td>';
                echo '<td>';
                echo '<a href="remove_farmer.php?action=remove&f_id=' . $row['f_id'] . '" style="color:red;">Remove</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        }
    }


    public function removeFarmer($f_id)
    {
        $f_id = $this->connection->real_escape_string($f_id);


        $queryCheckOrders = "SELECT COUNT(*) AS orderCount FROM orders WHERE f_id = $f_id AND (status = 0 OR status = 1)";
        $resultCheckOrders = $this->connection->query($queryCheckOrders);
        $orderCount = $resultCheckOrders->fetch_assoc()['orderCount'];

        if ($orderCount > 0) {
            $queryCheckOrders1 = "SELECT COUNT(*) AS orderCount1 FROM orders WHERE f_id = $f_id AND status = 0";
            $resultCheckOrders1 = $this->connection->query($queryCheckOrders1);
            $orderCount1 = $resultCheckOrders1->fetch_assoc()['orderCount1'];
            if ($orderCount1 > 0) {
                echo '<script>alert("Farmer has existing orders to process. Cannot delete.");</script>';
                echo '<script>window.location = "remove_farmer.php";</script>';
                return false;
            }

            $queryDeleteProcessedOrder = "DELETE FROM orders WHERE f_id = $f_id AND status = 1";
            $resultDeleteProcessedOrder = $this->connection->query($queryDeleteProcessedOrder);

            if ($resultDeleteProcessedOrder) {

                $queryDeleteProducts = "DELETE FROM product WHERE f_id = $f_id";
                $resultDeleteProducts = $this->connection->query($queryDeleteProducts);

                if ($resultDeleteProducts) {

                    $queryDeleteFarmer = "DELETE FROM farmer WHERE f_id = $f_id";
                    $resultDeleteFarmer = $this->connection->query($queryDeleteFarmer);

                    return $resultDeleteFarmer;
                } else {
                    echo '<script>alert("Failed to delete products.");</script>';
                    echo '<script>window.location = "remove_farmer.php";</script>';
                    return false;
                }
            } else {
                echo '<script>alert("Failed to delete processed order.");</script>';
                echo '<script>window.location = "remove_farmer.php";</script>';
                return false;
            }
        } else {

            $queryDeleteProducts = "DELETE FROM product WHERE f_id = $f_id";
            $resultDeleteProducts = $this->connection->query($queryDeleteProducts);

            if ($resultDeleteProducts) {

                $queryDeleteFarmer = "DELETE FROM farmer WHERE f_id = $f_id";
                $resultDeleteFarmer = $this->connection->query($queryDeleteFarmer);

                return $resultDeleteFarmer;
            } else {
                echo '<script>alert("Failed to delete products.");</script>';
                echo '<script>window.location = "remove_farmer.php";</script>';
                return false;
            }
        }
    }



    public function displayCurrentBuyers($status)
    {
        $query = "SELECT b_id, b_name, b_mail, b_address, b_phone, b_pin, b_status FROM buyer WHERE b_status = $status";
        $result = $this->connection->query($query);

        if ($result) {

            echo '<table class="table table-striped">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Address</th>';
            echo '<th>Phone</th>';
            echo '<th>PIN</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['b_id'] . '</td>';
                echo '<td>' . $row['b_name'] . '</td>';
                echo '<td>' . $row['b_mail'] . '</td>';
                echo '<td>' . $row['b_address'] . '</td>';
                echo '<td>' . $row['b_phone'] . '</td>';
                echo '<td>' . $row['b_pin'] . '</td>';
                echo '<td>';
                echo '<a href="remove_buyer.php?action=remove&b_id=' . $row['b_id'] . '" style="color:red;">Remove</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        }
    }


    public function removeBuyer($b_id)
    {
        $b_id = $this->connection->real_escape_string($b_id);


        $queryDeleteCart = "DELETE FROM cart WHERE b_id = $b_id";
        $resultDeleteCart = $this->connection->query($queryDeleteCart);

        if ($resultDeleteCart) {

            $queryDeleteOrders = "DELETE FROM orders WHERE b_id = $b_id";
            $resultDeleteOrders = $this->connection->query($queryDeleteOrders);

            if ($resultDeleteOrders) {

                $queryDeleteBuyer = "DELETE FROM buyer WHERE b_id = $b_id";
                $resultDeleteBuyer = $this->connection->query($queryDeleteBuyer);

                return $resultDeleteBuyer;
            } else {
                echo '<script>alert("Failed to delete orders.");</script>';
                echo '<script>window.location = "remove_buyer.php";</script>';
            }
        } else {
            echo '<script>alert("Failed to delete cart records.");</script>';
            echo '<script>window.location = "remove_buyer.php";</script>';
        }
    }
}
