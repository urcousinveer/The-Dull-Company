<?php
class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Function to search for orders by product name
    public function searchOrders($productName) {
        // Perform any necessary validation

        // Perform the order search based on the product name
        $query = "SELECT * FROM orders WHERE product_name LIKE ?";
        $stmt = $this->db->prepare($query);
        $productName = '%' . $productName . '%';
        $stmt->bind_param("s", $productName);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Process and return the search results
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
