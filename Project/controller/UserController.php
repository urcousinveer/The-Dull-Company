<?php

require_once '../Model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    // Function to register a new user
    /*public function registerUser($username, $password) {
        return $this->userModel->registerUser($username, $password);
    }*/

    // Function to authenticate a user
    public function authenticateUser($username, $password) {
        return $this->userModel->authenticateUser($username, $password);
    }


    //$userController = new UserController($db);

    public function handleRequest($postData){// Check the action parameter in the URL
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            /*case 'register':
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
            break;*/

            case 'login':
                // Handle the login form submission
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];


                    if ($this->userModel->authenticateUser($username, $password)) {
                        // Authentication successful
                        echo "Authentication successful for user: $username";
                        header('Location: customer_view.php'); // Redirect to customer dashboard
                    } else {
                        echo "Authentication failed";
                        // Handle error, display an error message, etc.
                    }
            }
            break;
        }
    }
}
}
?>
