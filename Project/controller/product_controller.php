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

// Create an instance of the ProductModel
$productModel = new ProductModel($con);

// Get all products
$products = $productModel->getAllProducts();

// Include the HTML for displaying products
include ('../View/browse_products.php');




?>
