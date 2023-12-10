<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>

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