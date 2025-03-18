<?php

    session_start();

     //is session user niet geset?
    if(isset($_SESSION['user'])) {
        echo "ingelogd als: " . $_SESSION['user'];
        echo "<br>";
        echo "<a href='beveiligdepagina.php'>beveiligdepagina</a><br>";
    }

    //autoloader for loading all Classes
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());

    //Als het formulier Gepost wordt:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // $username = $_POST['username'];
        // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //nu database INSERT voor user
        if(isset($_POST['inloggen'])) {
            $userManager->loginUser($_POST);
        }

        if(isset($_POST['Registreren'])) {
            $userManager->insertUser($_POST);
        }
    }



?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Registreren</h2>
    <form method="POST">

        <label for="username"></label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password"></label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Registreren" name='register'>
    </form>

    
    <h2>Inloggen</h2>
    <form method="POST" action="">
        Gebruikersnaam: <input type="text" name="username" required><br><br>
        Wachtwoord: <input type="password" name="password" required><br><br>
        <input type="submit" value="Inloggen" name='login'>
    </form> -->



    

       
    

    


    <h2>Registreren</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    if (isset($success)) {
        echo "<p style='color:green'>$success</p>";
    }
    ?>
    <form method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" required><br><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br><br>
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Registreren" name='Registreren'>
    </form>
    <p>Heb je al een account? <a href="login.php">Inloggen hier</a></p>



    </head>
<body>
    <h2>Inloggen</h2>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    
    <form method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Inloggen" name='inloggen'>
    </form>
    <p>Geen account? <a href="register.php">Registreer hier</a></p>




    <form method="POST">
    <!-- Je kunt de game-ID dynamisch toevoegen vanuit de hoofdbibliotheek -->
    Game ID: <input type="text" name="game_id" required><br>
    <button type="submit">Voeg toe aan mijn bibliotheek</button>
</form>





<!-- <?php
// // Haal alle games op uit de hoofdbibliotheek

// $stmt = $pdo->query("SELECT id, name FROM games");

// echo "<h2>Hoofdbibliotheek</h2>";
// while ($game = $stmt->fetch()) {
//     echo "<div>";
//     echo "<h3>" . htmlspecialchars($game['name']) . "</h3>";
//     echo "<form method='POST'>";
//     echo "<input type='hidden' name='game_id' value='" . $game['id'] . "'>";
//     echo "<button type='submit'>Voeg toe aan mijn bibliotheek</button>";
//     echo "</form>";
//     echo "</div>";
// }
// ?>

</body>
</html> -->



    
    
    