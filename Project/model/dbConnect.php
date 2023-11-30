<?php      

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = '';
    private $db_name = "thedullcompany";
    private $con;

    public function __construct() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db_name);

        if ($this->con->connect_error) {
            die("Failed to connect! Here's the error info, hopefully it helps: " . $this->con->connect_error);
        }
    }

    public function getConnection() {
        return $this->con;
    }

    public function prepare($query) {
        return $this->con->prepare($query);
    }
}

// Usage in other files
// $db = new Database();
// $con = $db->getConnection();
?>
