<?php

class GameManager {
    private $db;
    private $connection;

    //in de construct function wordt eerst database connectie gemaakt
    public function __construct(Database $db) {
        $this->db = $db;
        if(is_null($this->db->getConnection())) {
            echo "Connection failed!";
        } else {
            $this->connection = $this->db->getConnection();
        }
    }

    //in de functie getAllGames gaat informatie ophalen uit de database en dan return data
    public function getAllGames() {
        $query = "SELECT * FROM games"; 
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results as associative arrays
    
        // Initialize an array to hold Game objects
        $games = [];
    
        // Loop through each result and create a new Game object
        foreach ($results as $result) {
            // Assuming the Game class has a constructor that accepts an associative array
            $games[] = new Game($result);
        }
    
        return $games;
    }
    

    //in function addgame gaat data toevoegen aan de database
    public function addGame($data, $imageName) {

        $title = $data['title'];
        $genre = $data['genre'];
        $platform = $data['platform'];
        $release = $data['release'];
        $rating = $data['rating'];


        $query = "INSERT INTO games (title, genre, platform, `release`, rating, imageName) 
          VALUES (:title, :genre, :platform, :release, :rating, :imageName)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':platform', $platform); 
        $stmt->bindParam(':release', $release);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':imageName', $imageName);

        echo "game has been added!";
        return $stmt->execute();
    }

    // function updategame gaat een game updaten in de database

    public function updateGame($id, Game $game) {
        $query = "UPDATE games SET title = :title WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':title', $game->getTitle());
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    // function deletegame gaat een game in de database
    public function deleteGame($id) {
        $query = "DELETE FROM games WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function fileUpload($file) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
    }
}


?>