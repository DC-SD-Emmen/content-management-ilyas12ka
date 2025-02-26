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