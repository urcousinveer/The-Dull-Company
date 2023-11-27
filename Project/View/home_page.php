<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Homepage</title>
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
        }

        .product-card {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .product-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Welcome, Customer!</h1>
    
    <!-- Customer options -->
    <ul>
        <li><a href="search_products.php">Search Products</a></li>
        <li><a href="view_cart.php">View Cart</a></li>
        <!-- Add more options as needed -->
    </ul>

    <h2>Featured Products</h2>

    <!-- Search form -->
    <form action="search_products.php" method="get">
        <label for="search">Search Products:</label>
        <input type="text" id="search" name="search" required>
        <input type="submit" value="Search">
    </form>


    <?php
        // Assume $db is your database connection

        // Fetch product data from the database (replace with your actual query)
        $query = "SELECT * FROM products LIMIT 4";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['id'];
                $productName = $row['name'];
                $productImage = $row['image'];

                // Display product image with a link to product details
                echo "<div style='display: inline-block; margin: 10px;'>";
                echo "<a href='product_details.php?id=$productId'>";
                echo "<img src='product_images/$productImage' alt='$productName' width='150' height='150'>";
                echo "<p>$productName</p>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No featured products available.</p>";
        }
        ?>
    <!-- Product display -->
    <div class="product-container">
        <!-- Example product card -->
        <div class="product-card">
            <img src="product_images/product1.jpg" alt="Product 1" class="product-image">
            <h3>Product 1</h3>
            <p>Description of Product 1.</p>
            <a href="product_details.php?id=1">View Details</a>
        </div>

        <!-- Example product card -->
        <div class="product-card">
            <img src="product_images/product2.jpg" alt="Product 2" class="product-image">
            <h3>Product 2</h3>
            <p>Description of Product 2.</p>
            <a href="product_details.php?id=2">View Details</a>
        </div>

        <!-- Add more product cards as needed -->
    </div>
</body>
</html>
