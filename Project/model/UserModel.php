<?php

include 'dbConnect.php';

class UserModel {

   private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function checkCredentials($username, $password) {
        //global $con;
        $connection = $this->db->getConnection();

        // Perform database query to check credentials
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            return $user['user_type']; // Assuming there is a 'user_type' column in your database
        }

        return false;
    }
    public function isUsernameTaken($usernameR) {
        $count = 0;

        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $usernameR);
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
    public function registerUser($usernameR, $email, $passwordR) {
        
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $usernameR, $email, $passwordR);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Registration successful
        } else {
            $stmt->close();
            return $stmt->error; // Return the error message if registration fails
        }
    }

    public function getUserData($username) {
        $query = "SELECT userID, user_type FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt) {
            die("Error in preparing the statement: " . $this->db->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        if ($stmt->error) {
            die("Error in executing the statement: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
        $userID = null;
        $userType = null;
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userID = $row['userID'];
                $userType = $row['user_type'];
                // Other assignments...
            }
        }
    
        // Checking if user data is found
        if ($userID !== null && $userType !== null) {
            return [
                'userID' => $userID,
                'user_type' => $userType,
        
            ];
        } else {
            return null; // Or handle the case where user data is not found
        }
    }
    
}

?>

