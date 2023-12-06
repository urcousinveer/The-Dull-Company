<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Orders</title>
</head>
<body>
    <?php
    include '../View/navbar_admin.php';
    ?>

    <h2>Search Orders</h2>
    <br>
    <div>
        <h4>By User:</h4>
        <p>Search by user for their orders</p>
        
        <form action="../controller/order_controller.php" method="POST">
            <input type="hidden" name="formType" value="userSearch">
            <label for="userName">Username:</label>
            <input type="text" id="userName" name="userName" required><br>
            <input type="submit" value="Search Orders">
        </form>
    </div>
    <br>
    <div>
        <h4>By Product:</h4>
        <p>Search for orders associated with a certain product</p>
        <form action="../controller/order_controller.php" method="POST">
            <input type="hidden" name="formType" value="itemSearch">
            <label for="itemName">Item Name:</label>
            <input type="text" id="itemName" name="itemName" required><br>
            <input type="submit" value="Search Orders">
        </form>
    </div>
</body>
</html>
