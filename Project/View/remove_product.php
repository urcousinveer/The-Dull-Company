<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Product</title>
</head>
<body>
    <?php
    include '../View/navbar_admin.php';
    ?>
    <h2>Remove a Product</h2>
    
    <form action="../controller/admin_controller.php" method="POST">

        <!--Identify the form-->
        <input type="hidden" name="formType" value="removeProduct">    
        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
