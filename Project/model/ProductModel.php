<?php
class ProductModel {

    // Connect to database
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        $query = "SELECT * FROM items";
        $result = $this->db->query($query);

        $products = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;

    }

    // Function to search for products based on a keyword
    public function searchProducts($keyword) {
        $query = "SELECT * FROM items WHERE categoryName LIKE '%$keyword%' OR itemName LIKE '%$keyword%'";
        $result = $this->db->query($query);
        
        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
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
