<?php
class ProductModel {

    // Connect to database
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    // Get all products
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

    // Search for products based on a keyword
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


    // Add a new product
    public function addProduct($categoryName, $itemName, $itemDescription, $listPrice, $quantity, $itemImage) {

        $query = "INSERT INTO items (itemName, itemDescription, listPrice, quantity) VALUES (?, ?, ?, ?)";
        $this->db->query($query);

        // MORE CODE FOR SAVING PHOTO TO DIRECTORY AND ENSURING IT'S THE RIGHT FILE TYPE AND NAME
        
        
    }

    // Remove a product
    public function removeProduct($productId) {
        
        
        $query = "DELETE FROM items WHERE itemID = ?";
        $this->db->query($query);

        
    }

    // Update inventory for a product
    public function updateInventory($productId, $quantity) {
        
        $query = "UPDATE products SET quantity = quantity + ? WHERE productID = ?";
        $this->db->query($query);
   
    }
}
?>
