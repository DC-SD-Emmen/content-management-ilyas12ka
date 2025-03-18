<?php

    class Database {

            private $servername = 'mysql';
            private $user = 'root';
            private $password = 'root';
            private $dbname = 'mydatabase'; 
        
            private $conn;
        
            public function __construct() {
                try {
                    // Create a PDO instance
                    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->user, $this->password);
                    
                    // Set the PDO error mode to exception
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                } catch (PDOException $e) {
                    // In case of error, display the error message
                    echo "Connection failed: " . $e->getMessage();
                }
            }
        
            // Optionally, you can create a method to get the connection
            public function getConnection() {
                return $this->conn;
            }
    }

?>

<?php

class User {
    private $username;
    private $email;
    private $passwordHash;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $this->hashPassword($password);
    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function checkPassword($password) {
        return password_verify($password, $this->passwordHash);
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function updateUser($newUsername = null, $newEmail = null, $newPassword = null) {
        if ($newUsername) {
            $this->username = $newUsername;
        }
        if ($newEmail) {
            $this->email = $newEmail;
        }
        if ($newPassword) {
            $this->passwordHash = $this->hashPassword($newPassword);
        }
    }
}
?>
