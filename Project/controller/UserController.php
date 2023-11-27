<?php

require_once 'UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    // Function to register a new user
    public function registerUser($username, $password) {
        return $this->userModel->registerUser($username, $password);
    }

    // Function to authenticate a user
    public function authenticateUser($username, $password) {
        return $this->userModel->authenticateUser($username, $password);
    }
}


$userController = new UserController($db);

// Check the action parameter in the URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'register':
            // Handle the registration form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usernameRegister = $_POST['usernameRegister'];
                $passwordRegister = $_POST['passwordRegister'];

                $result = $userController->registerUser($usernameRegister, $passwordRegister);

                if ($result) {
                    // Registration successful
                    header('Location: customer_view.php'); // Redirect to customer dashboard
                } else {
                    // Handle error, display an error message, etc.
                }
            }
        break;

        case 'login':
            // Handle the login form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usernameLogin = $_POST['usernameLogin'];
                $passwordLogin = $_POST['passwordLogin'];

                $result = $userController->authenticateUser($usernameLogin, $passwordLogin);

                if ($result) {
                    // Authentication successful
                    header('Location: customer_view.php'); // Redirect to customer dashboard
                } else {
                    // Handle error, display an error message, etc.
                }
            }
        break;
    }
}
?>
