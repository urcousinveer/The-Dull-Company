<?php

include ('../model/ProductModel.php');

class CartController {

    private $productModel;

    // connect to database
    public function __construct($db) {
        $this->productModel = new ProductModel($db);
    }

    public function handleCartActions() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                $action = $_POST['action'];

                switch ($action) {
                    case 'add':
                        $this->addToCart();
                        break;
                    default:
                        echo "error!"; // Handle invalid action
                        break;
                }
            }
        }
    }

    private function addToCart() {
        $itemName = $_POST['itemName'];

        // Retrieve product details based on $itemName and store it in the cart
        $productDetails = $this->getProductDetails($itemName);

        if ($productDetails) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check if the product is already in the cart
            $existingProduct = array_filter($_SESSION['cart'], function ($item) use ($itemName) {
                return $item['name'] == $itemName;
            });

            if (empty($existingProduct)) {
                // Add the product to the cart
                $_SESSION['cart'][] = [
                    'id' => $productDetails['id'],
                    'name' => $productDetails['name'],
                    'price' => $productDetails['price'],
                    'quantity' => 1,
                ];
            } else {
                // Increment quantity if the product is already in the cart
                $existingProductName = key($existingProduct);
                $_SESSION['cart'][$existingProductName]['quantity'] += 1;
            }

            // Redirect back to the browse_products.php page
            header('Location: ../View/browse_products.php');
            exit();
        }
    }

    private function getProductDetails($itemName) {
        return $this->productModel->getProductDetails($itemName);
    }
}

// Example of usage
$db = new Database();  // Assuming you have a Database class
$cartController = new CartController($db);
$cartController->handleCartActions();
?>
