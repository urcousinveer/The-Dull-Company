<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Product</title>
</head>
<body>
    <h2>Remove Product</h2>
    
    <!-- Product removal form -->
    <form action="product_controller.php?action=remove" method="post">
        <label for="productId">Product ID:</label>
        <input type="text" id="productId" name="productId" required><br>

        <input type="submit" value="Remove Product">
    </form>
</body>
</html>
