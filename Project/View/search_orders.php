<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Orders</title>
</head>
<body>
    <h2>Search Orders</h2>
    
    <!-- Order search form -->
    <form action="order_controller.php?action=search" method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br>

        <input type="submit" value="Search Orders">
    </form>
</body>
</html>
