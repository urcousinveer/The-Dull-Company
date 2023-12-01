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
                
                // Check if 'name' key exists before accessing it
                if (array_key_exists('itemName', $cartItem)) {
                    echo '<p>Name: ' . $cartItem['itemName'] . '</p>';
                } else {
                    echo '<p>Name not available</p>';
                }

                // Check if 'listPrice' key exists before accessing it
                if (array_key_exists('listPrice', $cartItem)) {
                    echo '<p>Price: $' . $cartItem['listPrice'] . '</p>';
                } else {
                    echo '<p>Price not available</p>';
                }

                echo '<p>Quantity: ' . $cartItem['quantity'] . '</p>';
                echo '<br>';

                // increase quantity button
                echo '<form method="post" action="../controller/cart_controller.php">';
                echo '<input type="hidden" name="action" value="increaseQuantity">';
                echo '<input type="hidden" name="itemName" value="' . $cartItem['itemName'] . '">';
                echo '<button type="submit">Add Extra</button>';
                echo '</form>';
                echo '<br>';

                // decrease quantity button
                echo '<form method="post" action="../controller/cart_controller.php">';
                echo '<input type="hidden" name="action" value="decreaseQuantity">';
                echo '<input type="hidden" name="itemName" value="' . $cartItem['itemName'] . '">';
                echo '<button type="submit">Remove One</button>';
                echo '</form>';
                echo '<br>';

                // remove item button
                echo '<form method="post" action="../controller/cart_controller.php">';
                echo '<input type="hidden" name="action" value="remove">';
                echo '<input type="hidden" name="itemName" value="' . $cartItem['itemName'] . '">';
                echo '<button type="submit">Remove Item</button>';
                echo '</form>';

                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }

        $totalQuantity = 0;
        $totalAmount = 0;

        foreach ($_SESSION['cart'] as $cartItem) {
            $totalQuantity += $cartItem['quantity'];
            $totalAmount += $cartItem['quantity'] * $cartItem['listPrice'];
        }

        $_SESSION['orderTotal'] = $totalAmount;

        echo '<p>Total Quantity: ' . $totalQuantity . '</p>';
        echo '<p>Total Amount: $' . number_format($totalAmount, 2) . '</p>';


        if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'client' || $_SESSION['user_type'] === 'admin')) {
            echo '<form method="post" action="../View/checkout.php">';
            echo '<input type="submit" value="Checkout">';
            echo '</form>';
        }
    ?>
</body>
</html>
