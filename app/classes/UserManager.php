<?php

class UserManager {

    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Insert function for the user
    public function insertUser($data) {
        // Sanitize input

        $username = filter_var($data['username']);
        $password = password_hash($data['password'],  PASSWORD_DEFAULT);
        $email = $data['email'];

        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

            // Bind the parameters
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $password, PDO::PARAM_STR);

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
                    //set session user
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user'] = $input_username;
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

 
    // Functie om alle games voor een specifieke gebruiker op te halen

    public function getGamesByUser($user_id) {
        $query = "SELECT g.name
                  FROM games g
                  JOIN user_games ug ON g.id = ug.game_id
                  WHERE ug.users_id = :user_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Maak een nieuwe gebruiker aan en voeg deze toe aan de database
    public function createUser(User $user) {
        try {
            // Versleutel het wachtwoord
            $user->hashPassword();

            // SQL-query voor het invoegen van de gebruiker
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $user->getUsername());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':password', $user->getPassword());
            
        
            $stmt->execute();
            echo "Gebruiker succesvol aangemaakt.\n";
        } catch (PDOException $e) {
            echo "Fout bij het aanmaken van gebruiker: " . $e->getMessage();
        }
    }
    
    // Verkrijg een gebruiker op basis van zijn/haar gebruikersnaam
    public function getUserByUsername($username) {
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return new User($user['username'], $user['email'], $user['password'], $user['id']);
            }

            return null;
        } catch (PDOException $e) {
            echo "Fout bij het ophalen van gebruiker: " . $e->getMessage();
            return null;
        }
    }
    
    // Verkrijg een gebruiker op basis van zijn/haar ID
    public function getUserById($userId) {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return new User($user['username'], $user['email'], $user['password'], $user['id']);
            }

            return null;
        } catch (PDOException $e) {
            echo "Fout bij het ophalen van gebruiker: " . $e->getMessage();
            return null;
        }
    }
    
    // Update gebruikersgegevens
    public function updateUser(User $user) {
        try {
            $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $user->getUsername());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':id', $user->getId());

            
            $stmt->execute();
            echo "Gebruiker succesvol geüpdatet.\n";
        } catch (PDOException $e) {
            echo "Fout bij het updaten van gebruiker: " . $e->getMessage();
        }
    }

    // Verwijder een gebruiker
    public function deleteUser($userId) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $userId);

            $stmt->execute();
            echo "Gebruiker succesvol verwijderd.\n";
        } catch (PDOException $e) {
            echo "Fout bij het verwijderen van gebruiker: " . $e->getMessage();
        }
    }
    


    // Functie om een game toe te voegen aan de bibliotheek van een gebruiker
        function voegGameToe($userId, $gameId) {
            global $pdo;

    // Check of de koppeling al bestaat
        $stmt = $pdo->prepare("SELECT * FROM user_games WHERE user_id = :user_id AND game_id = :game_id");
        $stmt->execute(['user_id' => $userId, 'game_id' => $gameId]);

         if ($stmt->rowCount() > 0) {
            echo "De game is al toegevoegd aan de bibliotheek van de gebruiker.";
        } else {
        // Game toevoegen aan de bibliotheek
        $stmt = $pdo->prepare("INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)");
        $stmt->execute(['user_id' => $userId, 'game_id' => $gameId]);

        echo "De game is toegevoegd aan de bibliotheek van de gebruiker.";
    }
}


// $userId = 1; 
// $gameId = 2; 
// voegGameToe($userId, $gameId);



// Functie om de games van een gebruiker op te halen
function haalGamesOp($userId) {
    global $pdo;

    // SQL query om de games van een specifieke gebruiker op te halen
    $stmt = $pdo->prepare("
        SELECT g.game_id, g.game_name 
        FROM games g
        JOIN user_games ug ON g.game_id = ug.game_id
        WHERE ug.user_id = :user_id
    ");
    $stmt->execute(['user_id' => $userId]);

    // Controleer of er games zijn
    if ($stmt->rowCount() > 0) {
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($games as $game) {
            echo "Game: " . $game['game_name'] . "<br>";
        }
    } else {
        echo "Geen games gevonden voor deze gebruiker.";
    }
}


// $userId = 1; 
// haalGamesOp($userId);

}

  
