<?php
include 'dbConnect.php';
class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Function to search for orders by product name
    public function searchOrders($itemName) {

        $query = "SELECT users.username, orders.orderTotal FROM items
            JOIN orderItems ON items.itemID = orderItems.itemID
            JOIN orders ON orderItems.orderID = orders.orderID
            JOIN users ON orders.userID = users.userID
            WHERE items.itemName LIKE ?";

        $stmt = $this->db->prepare($query);
        $itemName = "%" . $itemName . "%";
        $stmt->bind_param("s", $itemName);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            $stmt->close();
            return $orders;

        }
        else {
            $stmt->close();
            die("Error in executing the statement: " . $stmt->error);
        }
    }

    // Function to search for orders by customer name
    public function searchOrderItems($username){


        $query = "SELECT items.itemName, items.itemDescription, items.listPrice, items.quantity
            FROM users JOIN orders ON users.userID = orders.userID
            JOIN orderItems ON orders.orderID = orderItems.orderID
            JOIN items ON orderItems.itemID = items.itemID
            WHERE users.username = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {

            $result = $stmt->get_result();

            $items = [];

            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            $stmt->close();
            return $items;
        }
        else {
            $stmt->close();
            die("Error in executing the statement: " . $stmt->error);
        }

    }
}
?>
