<?php

require_once 'OrderModel.php';

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $this->orderModel = new OrderModel($db);
    }

    // Function to search for orders
    public function searchOrders($productName) {
        // Call the OrderModel to perform the order search
        return $this->orderModel->searchOrders($productName);
    }
}


$orderController = new OrderController($db);


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'search':
            // Handle the order search form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productName = $_POST['productName'];

                $orders = $orderController->searchOrders($productName);

                // Process the search results as needed
            }
        break;
 
    }
}
?>
