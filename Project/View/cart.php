<!-- view_cart.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <title>View Cart</title>
</head>
<body>
    <?php
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['user_type'])) {
            // User is logged in, include the relevant navbar
            if ($_SESSION['user_type'] === 'admin') {
                include '../View/navbar_admin.php';
            } elseif ($_SESSION['user_type'] === 'client') {
                include '../View/navbar_customer.php';
            }
        } else {
            // User is not logged in, include the default navbar
            include '../View/navbar_regular.php';
        }
    ?>

    <div>
        <h1>View Cart</h1>
    </div>

    <?php
        // Check if the cart is not empty
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo '<div class="cart-container">';
            foreach ($_SESSION['cart'] as $cartItem) {
                echo '<div class="cart-item">';
                echo '<p>Name: ' . $cartItem['itemName'] . '</p>';
                echo '<p>Price: $' . $cartItem['listPrice'] . '</p>';
                echo '<p>Quantity: ' . $cartItem['quantity'] . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }
    ?>
</body>
</html>
