<!--file to control admin operations-->

<?php

require_once ('../model/ProductModel.php');

// connect to database
$host = "localhost";  
$user = "root";  
$password = '';  
$db_name = "thedullcompany";  
      
$con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect! Here's the error info, hopefully it helps: ". mysqli_connect_error());  
    }  

include_once('../View/add_product.php');

if (isset($_POST["Add Product"])) {

    


}
?>



