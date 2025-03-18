<?php

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $db;
    // Constructor
    public function __construct($username, $email, $password, $id = null) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        if ($id) {
            $this->id = $id;
        }
    }

    // Getter en setter methoden voor de attributen
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Versleutelen van het wachtwoord
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    // Wachtwoord verifiëren
    public function verifyPassword($inputPassword) {
        return password_verify($inputPassword, $this->password);
    }
}



?>
