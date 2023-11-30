<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <ul>
        <li><a href="home_page.php">Back to Home Page</a></li>
    </ul>
    <h1>Sign Up!</h1>
    <form action = "../controller/UserController.php" method ="post">
        
        <label for="usernameR">Username: </label>
        <input type="text" id="usernameR" name="usernameR" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="passwordR">Password: </label>
        <input type="password" id="passwordR" name="passwordR" required><br><br>  

        <label for="repassword">Confirm Password: </label>
        <input type="password" id="repassword" name="repassword"><br><br>

        <input type="hidden" name="signup" value="1"> <!--to make sure login print doesnt include during signup-->

        <input type="submit" value="Submit">
</body>
</html>
