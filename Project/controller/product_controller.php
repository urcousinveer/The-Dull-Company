<?php

require_once 'ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new ProductModel($db);
    }

    // Function to add a new product
    public function addProduct($productName, $productDescription, $productPrice, $productQuantity, $productImage) {
        return $this->productModel->addProduct($productName, $productDescription, $productPrice, $productQuantity, $productImage);
    }

    // Function to remove a product
    public function removeProduct($productId) {
        return $this->productModel->removeProduct($productId);
    }

    // Function to update inventory for a product
    public function updateInventory($productId, $quantity) {
        return $this->productModel->updateInventory($productId, $quantity);
    }
}


$productController = new ProductController($db);


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'add':
            // Handle the product addition form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productName = $_POST['productName'];
                $productDescription = $_POST['productDescription'];
                $productPrice = $_POST['productPrice'];
                $productQuantity = $_POST['productQuantity'];
                //$productImage = $_FILES['productImage']['name']; 

                $result = $productController->addProduct($productName, $productDescription, $productPrice, $productQuantity, $productImage);

                if ($result) {
                    // Product added successfully
                    header('Location: admin_view.php'); // Redirect to admin dashboard
                } else {
                    // Handle error, display an error message, etc.
                }
            }
        break;

        case 'remove':
            // Handle the product removal form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productIdRemove = $_POST['productIdRemove'];

                $result = $productController->removeProduct($productIdRemove);

                if ($result) {
                    // Product removed successfully
                    header('Location: admin_view.php'); // Redirect to admin dashboard
                } else {
                    // Handle error, display an error message, etc.
                }
            }
        break;

        case 'update':
            // Handle the inventory update form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productIdUpdate = $_POST['productIdUpdate'];
                $quantityUpdate = $_POST['quantityUpdate'];

                $result = $productController->updateInventory($productIdUpdate, $quantityUpdate);

                if ($result) {
                    // Inventory updated successfully
                    header('Location: admin_view.php'); // Redirect to admin dashboard
                } else {
                    // Handle error, display an error message, etc.
                }
            }
        break;

        
    }
}
?>
