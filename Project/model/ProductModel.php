<?php
class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Function to search for products based on a keyword
    public function searchProducts($keyword) {
        // Perform the product search based on the keyword
        $query = "SELECT * FROM products WHERE name LIKE ?";
        $stmt = $this->db->prepare($query);
        $keyword = '%' . $keyword . '%';
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Process and return the search results
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to add a new product
    public function addProduct($productName, $productDescription, $productPrice, $productQuantity, $productImage) {
        // Perform any necessary validation

        // Insert product information into the 'products' table
        $query = "INSERT INTO products (product_name, description, price, Qty) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssdiss", $productName, $productDescription, $productPrice, $productQuantity, $productImage);

        if ($stmt->execute()) {
            return true; // Product added successfully
        } else {
            return false; // Product addition failed
        }
    }

    // Function to remove a product
    public function removeProduct($productId) {
        // Perform the product removal from the 'products' table
        $query = "DELETE FROM products WHERE productID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $productId);

        return $stmt->execute();
    }

    // Function to update inventory for a product
    public function updateInventory($productId, $quantity) {
        // Perform the inventory update for the specified product
        $query = "UPDATE products SET quantity = quantity + ? WHERE productID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $quantity, $productId);

        return $stmt->execute();
    }
}
?>