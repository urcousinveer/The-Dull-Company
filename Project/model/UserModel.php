<?php

require_once '../controller/UserController.php';
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Function to check if a username is already taken
    public function isUsernameTaken($username) {
        $count = 0;

        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
    
        // Fetch the result and assign the value to $count
        if ($stmt->fetch()) {
            $stmt->close();
            return $count > 0;
        } else {
            $stmt->close();
            return false;
        }
    }
    

    // Function to register a new user
    /*public function registerUser($username, $password) {
       

        // Insert user information into the 'users' table
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username);

        return $stmt->execute();
    }*/

    // Function to authenticate a user
    public function authenticateUser($username, $password) {
    
        $query = "SELECT password FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $userRecord = $result->fetch_assoc();
            if (password_verify($password, $userRecord["password"])){
            return true; // This is if username and pwd is corrrect.
            }
        return false; // if it failed
        }
    }
    
}
?>
