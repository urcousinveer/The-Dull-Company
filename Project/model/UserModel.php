<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Function to check if a username is already taken
    public function isUsernameTaken($username) {
        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        
        // Initialize $count to 0
        $count = 0;
    
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
    public function registerUser($username, $password) {
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user information into the 'users' table
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $hashedPassword);

        return $stmt->execute();
    }

    // Function to authenticate a user
    public function authenticateUser($username, $password) {
        // Retrieve hashed password from the database for the given username
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "SELECT password FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);

        if ($stmt->fetch()) {
            // Verify the password
            return password_verify($password, $hashedPassword);
        } else {
            return false; // User not found
        }
    }
    
}
?>
