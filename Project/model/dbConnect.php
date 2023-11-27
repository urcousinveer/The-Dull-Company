<?php      
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "Dull_Company_DB";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect! Here's the error info, hopefully it helps: ". mysqli_connect_error());  
    }  
    
?>  