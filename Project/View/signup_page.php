<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>

        body, ul {
            margin: 0;
            padding: 0;
        }


        .navbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }

        .navbar-menu {
            list-style: none;
            display: flex;
        }

        .navbar-menu li {
            margin: 0 15px;
        }

        .navbar-menu a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s;
        }

        .navbar-menu a:hover {
            color: #55acee; 
        }


        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }


        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #55acee;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul class="navbar-menu">
            <li><a href="home_page.php">Back to Home Page</a></li>
        </ul>
    </div>

    <h1>Sign Up!</h1>
    
    <!-- Sign Up form -->
    <form action="../controller/UserController.php" method="post">
        <label for="usernameR">Username:</label>
        <input type="text" id="usernameR" name="usernameR" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="passwordR">Password:</label>
        <input type="password" id="passwordR" name="passwordR" required>

        <label for="repassword">Confirm Password:</label>
        <input type="password" id="repassword" name="repassword">

        <input type="hidden" name="signup" value="1"> <!-- to make sure login print doesn't include during signup -->

        <input type="submit" value="Submit">
    </form>

    <br>

    <p>If you already have an account with us, click <a href="../View/login_page.php">here</a>.</p>
</body>
</html>
