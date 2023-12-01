<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/browse_products.css">
    <title>Browse Products</title>
</head>
<body>
<?php
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_type'])) {
        // User is logged in, include the relevant navbar
        if ($_SESSION['user_type'] === 'admin') {
            include '../View/navbar_admin.php';
        }
        elseif ($_SESSION['user_type'] === 'client') {
            include '../View/navbar_customer.php';
        }
    }
    else {
        // User is not logged in, include the default navbar
        include '../View/navbar_regular.php';
    }
    ?>
    <div>
        <h1>Browse Products!</h1>
    </div>
    <?php if (empty($products)): ?>
        <p>No products available, sorry!</p>
    <?php else: ?>
        <div class="product-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="../img/<?php echo $product['itemName'];?>.jpg"
                    onclick="showProductInfo('<?php echo $product['itemName']; ?>','<?php echo $product['itemDescription']; ?>')">
                    <h3 onclick="showProductInfo('<?php echo $product['itemName']; ?>', '<?php echo $product['itemDescription']; ?>')"><?php echo $product['itemName']; ?> </h3>
                    <p><?php echo '$' . $product['listPrice']; ?></p>

                    <!--form to add to cart submission-->
                    <form action="../controller/cart_controller.php" method="post">
                    <input type="hidden" name="itemName" value="<?php echo $product['itemName']; ?>">
                    <input type="hidden" name="action" value="add">
                    <input type="submit" value="Add to Cart" class="add-cart-button">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!--pop up card for more information-->
    <div class="modal-container" id="productModal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeProductInfo()">&times;</span>
            <h2 id="modalProductName"></h2>
            <p id="modalProductDescription"></p>
        </div>
    </div>

    <script>
        function showProductInfo(productName, productDescription) {
            document.getElementById('modalProductName').innerText = productName;
            document.getElementById('modalProductDescription').innerText = productDescription;
            document.getElementById('productModal').style.display = 'flex';
        }

        function closeProductInfo() {
            document.getElementById('productModal').style.display = 'none';
        }
    </script>
</body>
</html>
