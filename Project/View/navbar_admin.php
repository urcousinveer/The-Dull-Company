
<!--navbar for admin -->


    <link rel="stylesheet" href="../css/navbar.css">
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
                    <li><a href="../View/update_inventory.php">Update Inventory</a></li>
                </ul>
            </li>
            <li><a href="../controller/product_controller.php">Browse Products</a></li>
            <li><a href="../View/cart.php">View Cart</a></li>
            <li><a href="../controller/UserController.php?logout=1">Log out</a></li>

        </ul>
    </nav>
</header>
