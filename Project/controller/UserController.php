<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $userType = $this->userModel->checkCredentials($username, $password);

            if ($userType === 'admin') {
                header('Location: ../View/home_page.php?user=admin');
                exit();
            } elseif ($userType === 'client') {
                header('Location: ../View/home_page.php?user=client');
                exit();
            } else {
                if (!isset($_POST['signup'])) {
                    echo "Invalid credentials";
                }
            }
        }
    }

    public function signupUser() {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usernameR = isset($_POST['usernameR']) ? $_POST['usernameR'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $passwordR = isset($_POST['passwordR']) ? $_POST['passwordR'] : '';
            $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';

            
            if (empty($usernameR) || empty($email) || empty($passwordR) || empty($repassword)) { //CHECKS IF ANY FIELD IS LEFT EMPTY
                echo "Please fill all the fields!";
                return false;

            }elseif ($passwordR !== $repassword) {                              //CHECKS TO CONFIRM PASSWORD MATCH
                echo "Password confirmation failed. Don't match!";
                return false;

            }elseif($usernameTaken = $this->userModel->isUsernameTaken($usernameR)){     // IF username taken
            
                if ($usernameTaken) {
                    echo "Sorry the username is already taken. Try some other?";
                    return false;
                }
                
            }elseif($registrationResult = $this->userModel->registerUser($usernameR, $email, $passwordR)){ // returns bollean value to variable
            
                if($registrationResult === true){
                    echo "Registration successful!";
                    return true;
                }else{
                    echo "Registration failed. Error: " . $registrationResult;
                    return false;
                }
            }
        }    
    }
}
$db = new Database();
$userController = new UserController($db);

//ARGUEMENT HANDLERS

$userController->loginUser();               
$userController->signupUser();
if (isset($_POST['signup'])) {
    $userController->signupUser();
}


?>

