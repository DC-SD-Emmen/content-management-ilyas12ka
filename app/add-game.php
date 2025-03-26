<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Add Game</h1>


<?php 

    include 'classes/Database.php';
    include 'classes/GameManager.php';

    $db = new Database();
    $gameManager = new GameManager($db);

    //code maken voor versturen formulier
    //deze code betekend: "Als er op verzenden is geklikt
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $gameManager->fileUpload($_FILES['image']);
       $gameManager->addGame($_POST, $_FILES['image']['name']);
    }

        ?>

        <form method="post"enctype="multipart/form-data">
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" required><br>

            
            <label for="genre">genre:</label>
            <input type="text" id="genre" name="genre" required><br>

        
            <label for="platform">platform:</label>
            <input type="platform" id="platform" name="platform" required><br>

            
            <label for="release"> release:</label>
            <input type="date" id="release" name="release" required><br>

        
            <label for="rating">rating:</label>
            <input type="rating" id="rating" name="rating" required><br>

            <label for='image'>Image: </label>
            <input type='file' id='image' name='image' required><br>
            

            <input type="submit" value="Game Toevoegen">
        </form>
</body>
</html>

<style>

        body {
            background-color: lightblue;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: 0 auto;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        input {
            margin: 10px;
            padding: 5px;
        }       
</body>
</html>


