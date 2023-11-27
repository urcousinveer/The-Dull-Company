<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Welcome, Customer!</h1>
    
    <!-- Customer options -->
    <ul>
        <li><a href="search_products.php">Search Products</a></li>
        <li><a href="view_cart.php">View Cart</a></li>
        <!-- Add more options as needed -->
    </ul>

    <h2>User Registration</h2>
    
    <!-- Registration form -->
    <form action="user_controller.php?action=register" method="post">
        <label for="usernameRegister">Username:</label>
        <input type="text" id="usernameRegister" name="usernameRegister" required><br>

        <label for="passwordRegister">Password:</label>
        <input type="password" id="passwordRegister" name="passwordRegister" required><br>

        <input type="submit" value="Register">
    </form>

    <h2>User Login</h2>
    
    <!-- Login form -->
    <form action="user_controller.php?action=login" method="post">
        <label for="usernameLogin">Username:</label>
        <input type="text" id="usernameLogin" name="usernameLogin" required><br>

        <label for="passwordLogin">Password:</label>
        <input type="password" id="passwordLogin" name="passwordLogin" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

