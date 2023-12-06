<?php

require_once '../model/OrderModel.php';

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $this->orderModel = new OrderModel($db);
    }

    public function searchForm() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['action'])) {
                $action = $_POST['action'];

                switch ($action) {
                    case 'userSearch':
                        $this->userSearch();
                        break;
                    case 'itemSearch';
                        $this->itemSearch();
                        break;
                    default:
                        echo "error in form submission!";
                        break;
                    }
            }
        }
                    
    }

    public function userSearch(){

        $username = $_POST['username'];

        $orders = $this->orderModel->searchOrderItems($username);

        return $orders;

    }

    public function itemSearch(){
        $itemName = $_POST['itemName'];

        $items = $this->orderModel->searchOrders($itemName);

        return $items;
    }


}



include 'cart_controller.php';
//$db = new Database();
//$cartController = new CartController($db);
//$cartController->handleCartActions();
?>
