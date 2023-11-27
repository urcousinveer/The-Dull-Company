<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
</head>
<body>
    <h2>Add New Product</h2>
    
    <!-- Product form -->
    <form action="product_controller.php?action=add" method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br>

        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription" required></textarea><br>

        <label for="productPrice">Product Price:</label>
        <input type="number" id="productPrice" name="productPrice" step="0.01" required><br>

        <label for="productQuantity">Product Quantity:</label>
        <input type="number" id="productQuantity" name="productQuantity" required><br>

        <label for="productImage">Product Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/*" required><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
