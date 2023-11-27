<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>

    <?php
    // Assume $db is your database connection

    session_start();

    // Check if the cart is not empty
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo "<table border='1'>";
        echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";

        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $cartItem) {
            $productId = $cartItem['productId'];
            $productName = $cartItem['productName'];
            $quantity = $cartItem['quantity'];
            $price = $cartItem['price'];
            $totalItemPrice = $quantity * $price;

            // Display each item in the cart
            echo "<tr>";
            echo "<td>$productName</td>";
            echo "<td>$quantity</td>";
            echo "<td>$totalItemPrice</td>";
            echo "<td><a href='cart_controller.php?action=remove&productId=$productId'>Remove</a></td>";
            echo "</tr>";

            $totalPrice += $totalItemPrice;
        }

        echo "<tr><td colspan='2'><strong>Total:</strong></td><td colspan='2'>$totalPrice</td></tr>";
        echo "</table>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>

    <p><a href="customer_view.php">Continue Shopping</a></p>
</body>
</html>
