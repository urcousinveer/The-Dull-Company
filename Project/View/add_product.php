<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
</head>
<body>
    <?php
    include '../View/navbar_admin.php';
    ?>
    <h2>Add New Product</h2>
    
    
    <form action="../controller/admin_controller.php" method="POST" enctype="multipart/form-data">
        
        <!--Identify the form-->
        <input type="hidden" name="formType" value="addProduct">

        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="categoryName" required><br>

        <label for="productName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required><br>

        <label for="itemDescription">Item Description:</label>
        <textarea id="itemDescription" name="itemDescription" required></textarea><br>

        <label for="listPrice">List Price:</label>
        <input type="number" id="listPrice" name="listPrice" step="0.01" required><br>

        <label for="quantity">Product Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="itemImage">Item Image (jpg):</label>
        <input type="file" id="itemImage" name="itemImage" accept="image/jpg" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
