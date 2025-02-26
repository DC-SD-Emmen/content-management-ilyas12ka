<?php

class UserManager {

    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn) {
        $this->conn = $conn;
        // Set PDO to throw exceptions on errors
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Insert function for the user
    public function insertUser($username, $password) {
        // Sanitize input

        $username = filter_var($username,);

        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

            // Bind the parameters
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $password, PDO::PARAM_STR);

            // Execute the statement and handle success/failure
            if ($stmt->execute()) {
                echo "Gebruiker succesvol toegevoegd!";
            } else {
                echo "Fout bij het toevoegen van de gebruiker.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Login function for the user
    public function loginUser($data) {
        $input_username = $data['username'];
        $input_password = $data['password'];
        
        try {
            // SQL-query to check if the username exists
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $this->conn->prepare($sql);
            
            // Bind the parameter (PDO::PARAM_STR is for strings)
            $stmt->bindParam(1, $input_username, PDO::PARAM_STR);
            $stmt->execute();
            
            // Fetch the result
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Compare the input password with the stored hashed password
                if (password_verify($input_password, $user['password'])) {
                    echo "Inloggen succesvol!";
                } else {
                    echo "Onjuist wachtwoord.";
                }
            } else {
                echo "Gebruikersnaam bestaat niet.";
            }
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
    }

}

   
    



