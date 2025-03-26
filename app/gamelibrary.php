<?php

    session_start();

     //is session user niet geset?
    if(!isset($_SESSION['user'])) {
        header('location: login.php');  
    }

    //autoloader for loading all Classes
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());
    $gameManager = new GameManager($db);

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

            <!-- horizontal menu bar with links to add-game.php, account.php -->
             <div id="menubar">
                <div class="menu-item">
                    <a href='add-game.php'>ADD GAME</a>
                </div>
                <div class="menu-item">
                    <a href='account.php'>ACCOUNT</a>
                </div>


                <div class="menu-item">
                    <a href='register.php'>REGISTER</a>
             </div>
                
             <div class="menu-item">
                    <a href='login.php'>LOGIN</a>
             </div>
        </header>





        
        


        <!-- Game list -->
        <section class="game-list">
            <h2>Your Games</h2>

            <div class="game-grid">
                <?php 
                    $games = $gameManager->getAllGames(); 
                    
                    //foreach game in games
                    //make div class .game-item
                    //within that div, img src using the image from the game

                    foreach($games as $game) {
                        echo "<div class='game-item'>";
                        echo "<img class='game-image' src='classes/uploads/" . $game->getImage() . "' alt='game image'>";
                        echo "<h3>" . $game->getTitle() . "</h3>";
                        echo "<p>" . $game->getGenre() . "</p>";
                        echo "</div>";
                    }
                ?>
            </div>
           


        </section>

       
    </div>



    

    <!-- <script src="app.js"></script> -->


    
</body>
</html>

<style>


/* Algemene stijl */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color:rgb(143, 87, 87);
    color: #ffffff;
    text-align: center;
    padding: 20px;
}

/* Header */
header {
    background-color:rgb(103, 72, 72);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

header h1 {
    font-size: 2em;
}

/* Navigatiebalk */
nav {
    margin-top: 15px;
}

.menu-item {
    display: inline-block;
    margin: 10px;
}

.menu-item a {
    color: #ffffff;
    text-decoration: none;
    background: #ff4757;
    padding: 10px 15px;
    border-radius: 5px;
    transition: 0.3s;
}

.menu-item a:hover {
    background: #e84118;
}

/* Container */
.container {
    max-width: 800px;
    margin: 20px auto;
    background:rgb(14, 13, 13);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

/* Formulieren (Login, Register, Add Game) */
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

input, select, textarea {
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    width: 100%;
}

button {
    background:rgb(242, 236, 237);
    color:rgb(232, 223, 223);
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #e84118;
}

/* Game Grid */
.game-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.game-card {
    background-color: #292929;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease-in-out;
}

.game-card:hover {
    transform: scale(1.05);
}

.game-card img {
    max-width: 100%;
    border-radius: 10px;
}

/* Footer */
footer {
    background-color: #1e1e1e;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
    text-align: center;
}
