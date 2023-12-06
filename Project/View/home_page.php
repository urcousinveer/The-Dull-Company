<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>

    h1 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }


    h3 {
        text-align: center;
        color: #555;
    }


    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #333;
        color: #fff;
        cursor: pointer;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
    }

    input[type="submit"]:hover {
        background-color: #555;
    }
</style>
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

    include '../controller/UserController.php';
    $userController = new UserController($db);

    if (isset($_GET['logout'])) {
        $userController->logoutUser();
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
