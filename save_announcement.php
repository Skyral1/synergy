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

// Récupérer les données du formulaire
$titre = mysqli_real_escape_string($conn, $_POST['titre']);
$texte = mysqli_real_escape_string($conn, $_POST['texte']);
// Définir le fuseau horaire sur celui de la Belgique
date_default_timezone_set('Europe/Brussels');

// Récupérer la date et l'heure actuelles
$date = date('Y-m-d H:i:s');

// Traitement de l'image uploadée
$image = ''; // Variable pour stocker le chemin de l'image dans la base de données

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "./server/annonces/images/"; // Répertoire où seront stockées les images uploadées

    // Récupération du nom du fichier téléchargé
    $fileName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifications supplémentaires comme précédemment

    // Vérifier si $uploadOk est mis à 0 par une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $targetFile;
            echo "Le fichier " . basename($_FILES["image"]["name"]) . " a été téléchargé.";
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
}

// Requête pour insérer l'annonce dans la base de données avec le chemin de l'image
$sql = "INSERT INTO annonces (titre, texte, image, date) VALUES ('$titre', '$texte', '$image', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "Annonce créée avec succès";
    header("Location: blog.php");
    exit();
} else {
    echo "Erreur lors de la création de l'annonce : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>