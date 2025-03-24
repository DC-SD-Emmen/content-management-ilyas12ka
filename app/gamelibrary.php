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



    <!-- <h2>Registreren</h2>
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
    <p>Geen account? <a href="register.php">Registreer hier</a></p> -->




    <!-- <form method="POST">

    Game ID: <input type="text" name="game_id" required><br>
    <button type="submit">Voeg toe aan mijn bibliotheek</button>
</form> -->



<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Game Library</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>My Game Library</h1>
            <p>Manage your game collection in one place.</p>
        </header>

        <!-- Game list -->
        <section class="game-list">
            <h2>Your Games</h2>
            <ul id="game-list">
                <!-- Dynamically added games will appear here -->
                <li>
                    <!-- <span class="game-title">The Witcher 3</span>
                    <span class="game-genre">RPG</span> -->
                </li>
                <li>
                    <!-- <span class="game-title">Minecraft</span>
                    <span class="game-genre">Survival</span>
                </li> -->
                <!-- More games can be added here -->
            </ul>
        </section>

        <!-- Add game form -->
        <section class="add-game">
            <h2>Add a New Game</h2>
            <form id="add-game-form">
                <input type="text" id="game-title" placeholder="Game Title" required>
                <input type="text" id="game-genre" placeholder="Game Genre" required>
                <button type="submit">Add Game</button>
            </form>
        </section>
    </div>

    <script src="app.js"></script>
</body>
</html>