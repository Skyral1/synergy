<?php
// Se connecter à la base de données (utilisez vos propres informations de connexion)
$servername = "localhost";
$username = "root";
$password = "Rivotril_362778";
$dbname = "synergy";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour récupérer les annonces depuis la base de données triées par date (de la plus récente à la plus ancienne)
$sql = "SELECT titre, texte, image, date FROM annonces ORDER BY date DESC"; // Tri par date DESC pour obtenir les plus récentes en premier
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='annonce'>";
        echo "<h1>" . $row["titre"] . "</h1>";
        echo "<p>" . $row["texte"] . "</p>";

        // Vérifier si c'est une image ou une vidéo et si le champ image n'est pas vide
        $mediaUrl = $row["image"]; // Supposons que le champ "image" contienne l'URL du média
        $mediaType = pathinfo($mediaUrl, PATHINFO_EXTENSION); // Récupérer l'extension du fichier

        if (!empty($mediaUrl) && (strtolower($mediaType) === 'jpg' || strtolower($mediaType) === 'jpeg' || strtolower($mediaType) === 'png' || strtolower($mediaType) === 'gif')) {
            echo "<img src='$mediaUrl'></img>"; // Afficher l'image si l'extension est une image
        } elseif (!empty($mediaUrl) && (strtolower($mediaType) === 'mp4' || strtolower($mediaType) === 'avi' || strtolower($mediaType) === 'mov')) {
            echo "<video width='320' height='240' controls>";
            echo "<source src='$mediaUrl' type='video/mp4'>"; // Afficher la vidéo si l'extension est une vidéo
            echo "Your browser does not support the video tag.";
            echo "</video>";
        }

        echo "<p>" . $row["date"] . "</p>";
        echo "</div>";
    }
} else {
    echo "Aucune annonce à afficher";
}

// Fermer la connexion à la base de données
$conn->close();
?>