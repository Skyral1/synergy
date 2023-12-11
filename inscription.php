<!-- Dev by @Skyral_ -->
<!-- https://github.com/Skyral1 -->

<?php
// Vérifier la présence du cookie de connexion
if (!isset($_COOKIE['user'])) {
    // Rediriger l'utilisateur vers une page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>

<style>
    /* Ajoute ces styles pour le formulaire d'inscription */
    body {
        font-family: "Afacad", sans-serif;
        background-image: url(../assets/img/synergie-fond.png);
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

    <h2>Inscription</h2>

    <form action="inscription.php" method="post">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username"><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="S'inscrire">
    </form>

    <?php
    // Vos informations de connexion à la base de données
    $servername = "localhost";
    $username_db = "root";
    $password_db = "Rivotril_362778";
    $dbname = "synergy";

    // Connexion à la base de données
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Échapper les données pour éviter les attaques par injection SQL
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        // Hachage du mot de passe (pour des raisons de sécurité)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Requête pour insérer les données dans la base de données
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Inscription réussie !</p>";
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>

</body>

</html>