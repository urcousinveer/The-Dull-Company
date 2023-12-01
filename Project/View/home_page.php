<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
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
    <br>
    <h1>Welcome!</h1>

    <h3>Search for a product here</h3>

    
    <form action="../controller/search_controller.php" method="POST">
        <label for="search">Search Products:</label>
        <input type="text" id="search" name="search" required>
        <input type="submit" value="search">
    </form>

</body>
</html>
