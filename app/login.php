
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
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

        $userManager->loginUser($_POST);
    }

?>

    <div class="login-container">
        <h2>Inloggen</h2>

        <!-- Inlogformulier -->
        <form method ="POST">
            
            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Inloggen">
            </div>

            <div class="error-message">
              
                 
                <?php
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            
        


     
</body>
</html>


