<?php
include 'dbConnect.php';
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
    public function addProduct($categoryName, $itemName, $itemDescription, $listPrice, $quantity) {

        $connection = $this->db->getConnection();

        $query = "INSERT INTO items (categoryName, itemName, itemDescription, listPrice, quantity)
        VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss",$categoryName, $itemName, $itemDescription, $listPrice, $quantity);

        if($stmt->execute()){
            $stmt->close;
            return true; //product added
        }else{
            $stmt->close();
            return $stmt->error;
        }
        
    }

    // upload image
    public function checkImageUpload ($itemName, $itemImage){

        $targetDirectory = "../img/";
        $targetFile = $targetDirectory . $itemName . ".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($itemImage["name"], PATHINFO_EXTENSION));

        // Check if it is, in fact, an image
        $check = getimagesize($itemImage["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow only JPG files
        if ($imageFileType != "jpg") {
            echo "Sorry, only JPG files are allowed.";
            $uploadOk = 0;
        }
        
        else {
            
            if (move_uploaded_file($itemImage["tmp_name"], $targetFile)) {
                echo "Your photo has been uploaded ". basename($itemImage["name"]). " has been uploaded.";
                return $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }
        

    // Remove a product
    public function removeProduct($itemName) {
        $connection = $this->db->getConnection();
    
        $query = "DELETE FROM items WHERE itemName = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $itemName);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true; // product removed
        } else {
            $stmt->close();
            return $stmt->error;
        }    
        
    }

    // Update inventory for a product
    public function updateInventory($itemName, $updateAmount) {
        $query = "UPDATE items SET quantity = quantity + ? WHERE itemName = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $updateAmount, $itemName);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true; // product updated successfully
        } else {
            $stmt->close();
            return $stmt->error;
        }
    }
    
}
?>
