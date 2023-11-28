<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/browse_products.css">
    <title>Browse Products</title>
</head>
<body>
    <div>
        <h1>Browse Products!</h1>
        <p>click on a product to view more info</p>
    </div>
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="../img/<?php echo $product['image_filename']; ?>
                <h3><?php echo $product['itemName']; ?></h3>
                <p><?php echo '$' . $product['listPrice']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
