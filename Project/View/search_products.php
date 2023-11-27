<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search Results</title>
</head>
<body>
    <h1>Product Search Results</h1>

    <?php
    // Assume $db is your database connection
    require_once 'ProductModel.php';

    if (isset($_GET['search'])) {
        $searchKeyword = $_GET['search'];

        $productModel = new ProductModel($db);
        $searchResults = $productModel->searchProducts($searchKeyword);

        if ($searchResults) {
            // Display search results
            foreach ($searchResults as $result) {
                $productId = $result['id'];
                $productName = $result['name'];
                $productDescription = $result['description'];
                $productPrice = $result['price'];
                $productImage = $result['image'];

                // Display each product in the search results
                echo "<div>";
                echo "<h2>$productName</h2>";
                echo "<p>Description: $productDescription</p>";
                echo "<p>Price: $productPrice</p>";
                echo "<img src='product_images/$productImage' alt='$productName' width='150' height='150'>";
                echo "<a href='product_details.php?id=$productId'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found for '$searchKeyword'.</p>";
        }
    } else {
        echo "<p>No search keyword provided.</p>";
    }
    ?>
</body>
</html>
