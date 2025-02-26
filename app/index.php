<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    //autoloader for loading all Classes
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());


    //Als het formulier Gepost wordt:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //nu database INSERT voor user
        if(isset($_POST['login'])) {
            $userManager->loginUser($_POST);
        }

        if(isset($_POST['register'])) {
            $userManager->insertUser($username, $password);
        }
        

    } else {
            echo "Geen gegevens ontvangen.";
    }

?>

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
        </form>
    




</body>
</html>



    
    
    