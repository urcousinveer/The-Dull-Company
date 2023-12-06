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
            return true;
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
            return true; 
        } else {
            $stmt->close();
            return $stmt->error;
        }
    }

    public function getProductDetails($itemName) {
        $query = "SELECT itemName AS itemName, listPrice AS listPrice FROM items WHERE itemName = ?";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt) {
            die("Error in preparing the statement: " . $this->db->error);
        }
    
        $stmt->bind_param("s", $itemName);
        $stmt->execute();
    
        if ($stmt->error) {
            die("Error in executing the statement: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $productDetails = $result->fetch_assoc();
        $stmt->close();
    
        return $productDetails;
    }

    // Insert a new order and return the order ID
    public function insertOrder($userID, $orderTotal) {
        
        $query = "INSERT INTO orders (userID, orderTotal) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $userID, $orderTotal);

        if ($stmt->execute()) {
            //$orderID = $stmt->insert_id;
            $stmt->close();

            return true;//$orderID;
        } else {
            $stmt->close();
            return $stmt->error; 
            //error_log("Error in executing insertOrder statement: " . $stmt->error);
            //$stmt->close();
            //die("Error in executing the statement: " . $stmt->error);
        }
    }

    public function getItemIDByName($itemName) {
        $query = "SELECT itemID FROM items WHERE itemName = ?";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt) {
            die("Error in preparing the statement: " . $this->db->error);
        }
    
        $stmt->bind_param("s", $itemName);
        $stmt->execute();
    
        if ($stmt->error) {
            die("Error in executing the statement: " . $stmt->error);
        }
        $result = $stmt->get_result();

        $itemID = null;
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $itemID = $row['itemID'];
        }
    
        $stmt->close();
    
        return $itemID;
    }
    
    // Insert a new order item
    public function insertOrderItem($orderID, $itemID, $quantity) {
        
        $query = "INSERT INTO orderItems (orderID, itemID, quantity) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $orderID, $itemID, $quantity);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }else{
            error_log("Error in executing insertOrder statement: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    
}
?>
