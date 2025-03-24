<?php

    //spl autoloader classes
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    session_start();

    //is session user niet geset?
    if(!isset($_SESSION['user'])) {
        header('location: login.php');
    }

    $db = new Database();
    $userManager = new UserManager($db->getConnection());

    //if server method request is post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['logout'])) {
            unset($_SESSION['user']);
            session_destroy();
    
            header('location: login.php');
        }

        if(isset($_POST['updateUSERNAME'])) {
            $userManager->updateUserName($_POST);
        }

        if(isset($_POST['updatePASSWORD'])) {
            $userManager->updatePassword($_POST);
        }

    }

   
  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Welkom op de beveiligde pagina!</h1>

    <form method='POST'>
        <input type='hidden' name='id' value='<?php echo $_SESSION["user_id"]; ?>'>
        <input type='submit' name='logout' value='logout'>
    </form>

    <!-- form for update username -->
    <form method='POST'>
        <input type='hidden' name='id' value='<?php echo $_SESSION["user_id"]; ?>'>
        <label for='username'>Gebruikersnaam:</label>
        <input type='text' id='username' name='username' value='<?php echo $_SESSION["user"]; ?>' required>
        <label for='password'>Wachtwoord:</label>
        <input type='password' id='password' name='password' required>
        <input type='submit' name='updateUSERNAME' value='update'>
    </form>

    <!-- form for update password -->
    <form method='POST'>
        <input type='hidden' name='id' value='<?php echo $_SESSION["user_id"]; ?>'>
        <label for='passwordNEW'>Wachtwoord Nieuw:</label>
        <br>
        <input type='password' id='passwordNEW' name='passwordNEW' required>
        <label for='password'>Wachtwoord:</label>
        <input type='password' id='password' name='password' required>
        <input type='submit' name='updatePASSWORD' value='update'>
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