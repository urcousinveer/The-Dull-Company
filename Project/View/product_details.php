<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <?php
    // Assume $db is your database connection

    // Check if the product ID is provided in the URL
    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        // Fetch product details from the database (replace with your actual query)
        $query = "SELECT * FROM products WHERE id = $productId";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productName = $row['name'];
            $productDescription = $row['description'];
            $productPrice = $row['price'];
            $productImage = $row['image'];

            // Display product details
            echo "<h1>$productName</h1>";
            echo "<img src='product_images/$productImage' alt='$productName' width='300' height='300'>";
            echo "<p>Description: $productDescription</p>";
            echo "<p>Price: $productPrice</p>";

            // Add to cart form
            echo "<form action='cart_controller.php?action=add' method='post'>";
            echo "<input type='hidden' name='productId' value='$productId'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' id='quantity' name='quantity' value='1' min='1' required>";
            echo "<input type='submit' value='Add to Cart'>";
            echo "</form>";
        } else {
            echo "<p>Product not found.</p>";
        }
    } else {
        echo "<p>Product ID not provided.</p>";
    }
    ?>
</body>
</html>
