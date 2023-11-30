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
        <li><a href="login_page.php">Login</a></li>
        <li><a href="signup_page.php">Sign Up</a></li>
        <li><a href="search_products.php">Search Products</a></li>
        <li><a href="view_cart.php">View Cart</a></li>
        <!-- Add more options as needed -->
    </ul>

    <h2>Featured Products</h2>

    <!-- Search form -->
    <form action="../controller/search_controller.php" method="POST">
        <label for="search">Search Products:</label>
        <input type="text" id="search" name="search" required>
        <input type="submit" value="search">
    </form>

</body>
</html>
