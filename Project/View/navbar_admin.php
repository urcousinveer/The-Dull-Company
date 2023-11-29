<?php
//navbar for admin

echo '
<html>
<head>
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<header>
    <nav class="navbar">
        <ul class="navbar-menu">
            <li><a href="../View/home_page.php">Home</a></li>
            <li class="has-submenu">
                <a href="#">Manage</a>
                <ul class="manage-submenu">
                    <li><a href="../View/add_product.php">Add Product</a></li>
                    <li><a href="../View/remove_product.php">Remove Product</a></li>
                    <li><a href="../View/search_orders.php">Search Orders</a></li>
                </ul>
            </li>
            <li><a href="../controller/product_controller.php">Browse Products</a></li>
            <li><a href="search_products.php">Search</a></li>
            <li><a href="cart.php">View Cart</a></li>
            <li><a href="checkout.php">Checkout</a></li>
        </ul>
    </nav> <!-- Fix: Close the nav tag here -->
</header>
</html>';
?>
