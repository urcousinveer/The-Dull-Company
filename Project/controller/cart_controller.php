<?php
// Assume $db is your database connection

session_start();

// Check the action parameter in the URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'add':
            // Handle adding items to the cart
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productId = $_POST['productId'];
                $quantity = $_POST['quantity'];

                // Fetch product details from the database (replace with your actual query)
                $query = "SELECT * FROM products WHERE id = $productId";
                $result = $db->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $productName = $row['name'];
                    $productPrice = $row['price'];

                    // Add the item to the cart (using session for simplicity, replace with a database if needed)
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }

                    $cartItem = array(
                        'productId' => $productId,
                        'productName' => $productName,
                        'quantity' => $quantity,
                        'price' => $productPrice
                    );

                    array_push($_SESSION['cart'], $cartItem);

                    // Redirect back to the product details page
                    header("Location: product_details.php?id=$productId");
                } else {
                    echo "<p>Product not found.</p>";
                }
            }
        break;

        case 'remove':
            // Handle removing items from the cart
            if (isset($_GET['productId'])) {
                $productIdToRemove = $_GET['productId'];

                // Find the index of the item with the specified product ID in the cart
                $itemIndex = -1;
                foreach ($_SESSION['cart'] as $index => $cartItem) {
                    if ($cartItem['productId'] == $productIdToRemove) {
                        $itemIndex = $index;
                        break;
                    }
                }

                // Remove the item from the cart if found
                if ($itemIndex != -1) {
                    unset($_SESSION['cart'][$itemIndex]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array

                    // Redirect back to the cart page
                    header('Location: cart.php');
                } else {
                    echo "<p>Item not found in the cart.</p>";
                }
            }
        break;    


    }
}
?>
