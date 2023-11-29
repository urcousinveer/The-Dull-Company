<!--File to control search results-->

<?php
require_once ('../model/ProductModel.php');

$host = "localhost";  
$user = "root";  
$password = '';  
$db_name = "thedullcompany";  
      
$con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect! Here's the error info, hopefully it helps: ". mysqli_connect_error());  
    }  

$productModel = new ProductModel($con);

if (isset($_POST['search'])) {

    $keyword = filter_input(INPUT_POST, 'search');
    $products = $productModel->searchProducts($keyword);
}
// Include the view page
include ('../View/search_products.php');




?>
