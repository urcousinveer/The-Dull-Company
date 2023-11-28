<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Welcome!</h1>
    <ul>
        <li><a href="search_products.php">Search Products</a></li>
        <!--<li><a href="view_cart.php">View Cart</a></li>  -->
       
    </ul>

    <!--<h2>User Registration</h2>
    
     Registration form 
    <form action="user_controller.php?action=register" method="post">
        <label for="usernameRegister">Username:</label>
        <input type="text" id="usernameRegister" name="usernameRegister" required><br>

        <label for="passwordRegister">Password:</label>
        <input type="password" id="passwordRegister" name="passwordRegister" required><br>

        <input type="submit" value="Register">
    </form>
    -->
    <h2>User Login</h2>
    
    <!-- Login form -->
    <form action="index_login.php?action=login" method="post">
        <label for="username">Username: </label>
        <input type="text" id="usernameLogin" name="username" required><br>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

