<!--file to control admin operations-->

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include ('../model/ProductModel.php');

Class admin_controller {

    private $productModel;

    // connect to database
    public function __construct($db) {
        $this->productModel = new ProductModel($db);
    }

    public function adminFunctions() {
    
        // add a product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            echo "you've submitted a form!";

            $categoryName = isset($_POST['categoryName']) ? $_POST['categoryName'] : '';
            $itemName = isset($_POST['itemName']) ? $_POST['itemName'] : '';
            $itemDescription = isset($_POST['itemDescription']) ? $_POST['itemDescription'] : '';
            $listPrice = isset($_POST['listPrice']) ? $_POST['listPrice'] : '';
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
            $itemImage = isset($_FILES['itemImage']) ? $_FILES['itemImage'] : '';
            $updateAmount = isset($_POST['updateAmount']) ? $_POST['updateAmount'] : '';

            $formType = filter_input(INPUT_POST, 'formType');

            if($formType === 'addProduct'){

                $itemImage = $this->productModel->checkImageUpload($itemName, $itemImage);
                $itemAdd = $this->productModel->addProduct($categoryName, $itemName, $itemDescription, $listPrice, $quantity);

                if($itemAdd){

                    header('Location: ../View/add_product.php?formType=addProduct');
                    echo "Item added";
                    exit();
                }
                else{
                    echo "error";
                }

            }elseif($formType === 'removeProduct'){
                
                $itemRemove = $this->productModel->removeProduct($itemName);

                if($itemRemove){

                    header('Location: ../View/remove_product.php?formType=removeProduct');
                    echo "Item Removed";
                    exit();
                }
                else{
                    echo "error";
                }

            }elseif($formType === 'updateInventory'){

               $updateInventory = $this->productModel->updateInventory($itemName, $updateAmount); 
               
                if ($updateInventory){
                    
                    header('Location: ../View/update_inventory.php?formType=updateInventory');
                    exit();
                }
                else {
                    echo "error";   
                }

            }
            else {
                echo "error! error!";
            }

        }

    } 

}

$db = new Database();
$admin_controller = new admin_controller($db);

//ARGUEMENT HANDLERS
$admin_controller->adminFunctions();               

?>



