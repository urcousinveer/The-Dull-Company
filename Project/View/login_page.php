<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <ul>
        <li><a href="home_page.php">Home Page</a></li>
    </ul>

    <h1>Login Here!</h1>
    
    <!-- Login form -->
    <form action="../controller/UserController.php" method="post">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>