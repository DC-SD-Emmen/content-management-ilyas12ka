<?php

    session_start();

    //is session user niet geset?
    if(!isset($_SESSION['user'])) {
        header('location: index.php');
    }

    if(isset($_POST['logout'])) {
        unset($_SESSION['user']);
        session_destroy();

        header('location: index.php');
    }
  

    
session_start();

// Vernietig de sessie
session_unset();  
session_destroy(); 

echo "Je bent uitgelogd!";
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
        <input type='submit' name='logout' value='logout'>
    </form>
    
</body>
</html>