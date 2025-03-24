
 <?php
$host = 'mysql';   
$db = 'gamelibrary';
$user = 'root';        
$password = 'root';            

try {
    // Maak verbinding met de database
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Verbinden mislukt: " . $e->getMessage();
    exit;
}


include('classes/Database.php');


if (!isset($_GET['id'])) {
    die("Geen game geselecteerd.");
}


$game_id = (int)$_GET['id'];  

$sql = "SELECT * FROM games WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $game_id]);  
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    die("Game niet gevonden.");
}



    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['update'])) {

           
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $platform = $_POST['platform'];
            $release_date = $_POST['release_date'];
            $rating = $_POST['rating'];
    
            $update_sql = "UPDATE games SET title=?, genre=?, platform=?, release_date=?, rating=?, description=? WHERE id=?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("sssssi", $title, $genre, $platform, $release_date, $rating, $game_id);
    


        }
}
?>