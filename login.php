<?php
// Connexion à la base de données
$servername = "localhost";
$username_db = "root";
$password_db = "Rivotril_362778";
$dbname = "synergy";

// Création de la connexion
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérification des identifiants lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête préparée pour éviter les injections SQL
    $query = "SELECT * FROM users WHERE username=?"; // Vérifie l'utilisateur par son nom d'utilisateur
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Vérification du mot de passe haché
        if (password_verify($password, $row['password'])) {
            // L'utilisateur est authentifié avec succès
            // Création d'un cookie de connexion
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie valide pendant 30 jours

            // Redirection vers une autre page après la connexion réussie
            header("Location: create_announcement.php");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // Mot de passe incorrect
            echo "Identifiants incorrects. Veuillez réessayer.";
        }
    } else {
        // Aucun utilisateur trouvé avec ce nom
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
    $stmt->close();
}
?>

<!-- Formulaire de connexion -->
<!DOCTYPE html>
<html>

<head>
    <title>Page de Connexion</title>
</head>

<style>
    /* Ajoute ces styles pour la page de connexion */

    body {
        font-family: "Afacad", sans-serif;
        background-image: url(./assets/img/synergie-fond.png);
        text-align: center;
        padding: 50px;
    }

    h2 {
        color: #333;
        margin-bottom: 20px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label,
    input[type="text"],
    input[type="password"],
    input[type="submit"] {
        display: block;
        width: 100%;
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"],
    input[type="submit"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        background-color: #3366ff;
        color: #fff;
        border: none;
        font-weight: bold;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #254785;
    }
</style>

<body>

    <h2>Connexion</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Se connecter">
    </form>

</body>

</html>

<?php
// Fermeture de la connexion à la base de données
$conn->close();
?>