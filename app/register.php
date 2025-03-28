<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel='stylesheet' href='styling.css'>
</head>
<body>

<?php

//spl autoloader for loading all classes
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});


$db = new Database();
$userManager = new UserManager($db->getConnection());

 //Als het formulier Gepost wordt:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $userManager->loginUser($_POST);
    }

?>

    
              
                 
                <?php
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            
        


            
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
    
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    
    

    </body>
    </html>

    <form method="POST">

Game ID: <input type="text" name="game_id" required><br>
<button type="submit">Voeg toe aan mijn bibliotheek</button>
</form>

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

 




