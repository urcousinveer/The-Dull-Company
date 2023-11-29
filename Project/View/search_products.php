<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/browse_products.css">
    <title>Search Results</title>
</head>
<body>
    <div>
    <?php include_once('navbar_regular.php'); ?>    
    </div>
    <div>
        <h1>Search Results!</h1>
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
                    <a href="#" class=add-cart-button>Add to Cart</a>
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
