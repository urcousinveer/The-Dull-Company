<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
</head>
<body>
    <?php
    include '../View/navbar_admin.php';
    ?>

    <h2>Update Inventory</h2>
    <p>Enter the name of the product you would like to update and the amount you would like to add:</p><br>

    <form action="../controller/admin_controller.php" method="POST">

        <!--Identify the form-->
        <input type="hidden" name="formType" value="updateInventory">  
        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required><br>

        <label for="updateAmount">Amount: </label>
        <input type="number" id="updateAmount" name="updateAmount">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
