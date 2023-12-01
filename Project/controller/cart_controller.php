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
                    case 'remove':
                        $this->removeFromCart();
                        break;
                    case 'increaseQuantity':
                        $this->increaseQuantity();
                        break;
                    case 'decreaseQuantity':
                        $this->decreaseQuantity();
                        break;
                    default:
                        echo "error!";
                        break;
                }
            }
        }
    }

    private function addToCart() {
        $itemName = $_POST['itemName'];

        // Retrieve product details based on $itemName and store it in the cart
        $productDetails = $this->productModel->getProductDetails($itemName);

        if ($productDetails) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check if the product is already in the cart
            $existingProduct = array_filter($_SESSION['cart'], function ($item) use ($itemName) {
                return $item['itemName'] == $itemName;
            });

            if (empty($existingProduct)) {
                // Add the product to the cart
                $_SESSION['cart'][] = [
                    'id' => $productDetails['id'],
                    'itemName' => $productDetails['itemName'],
                    'listPrice' => $productDetails['listPrice'],
                    'quantity' => 1,
                ];
            } else {
                // Increment quantity if the product is already in the cart
                $existingProductName = key($existingProduct);
                $_SESSION['cart'][$existingProductName]['quantity'] += 1;
            }

            // Redirect back to the browse_products.php page
            header('Location: ../controller/product_controller.php');
            exit();
        }
    }
    private function removeFromCart() {
        $itemName = $_POST['itemName'];

        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($itemName) {
            return $item['itemName'] !== $itemName;
        });

        // Redirect back to the cart.php page
        header('Location: ../View/cart.php');
        exit();
    }

    private function increaseQuantity() {
        $itemName = $_POST['itemName'];

        // Increase the quantity of the selected item in the cart
        foreach ($_SESSION['cart'] as $index => $cartItem) {
            if ($cartItem['itemName'] === $itemName) {
                $_SESSION['cart'][$index]['quantity']++;
                break; // Stop the loop once the quantity is increased
            }
        }

        // Redirect back to the cart.php page
        header('Location: ../View/cart.php');
        exit();
    }

    private function decreaseQuantity() {
        $itemName = $_POST['itemName'];

        foreach ($_SESSION['cart'] as $index => $cartItem) {
            if ($cartItem['itemName'] === $itemName) {

                // Ensure the quantity doesn't go below 1
                $_SESSION['cart'][$index]['quantity'] = max(1, $_SESSION['cart'][$index]['quantity'] - 1);
                break; // Stop the loop once the quantity is decreased
            }
        }

        // Redirect back to the cart.php page
        header('Location: ../View/cart.php');
        exit();
    }

    private function handleCheckout() {
        // Insert the order into the database
        $orderID = $this->productModel->insertOrder($_SESSION['userID'], $_SESSION['orderTotal']);
    
        // Insert order items into the database
        foreach ($_SESSION['cart'] as $cartItem) {
            $this->productModel->insertOrderItem($orderID, $cartItem['itemID'], $cartItem['quantity']);
        }
    
        // Clear the user's cart
        unset($_SESSION['cart']);
    
        // Display a confirmation message (you can customize this part based on your needs)
        echo 'Order placed successfully!';
    
        // Redirect to a thank you page or any other relevant page
        header('Location: ../View/checkout.php');
        exit();
    }


}

$db = new Database();
$cartController = new CartController($db);
$cartController->handleCartActions();
?>
