<?php
// Vérifier la présence du cookie de connexion
if (!isset($_COOKIE['user'])) {
    // Rediriger l'utilisateur vers une page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer une Annonce</title>
    <!-- Inclure vos liens vers les feuilles de style CSS ou scripts ici si nécessaire -->
</head>

<body>
    <h1>Créer une Annonce</h1>
    <form action="save_announcement.php" method="post" enctype="multipart/form-data">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="texte">Texte :</label><br>
        <textarea id="texte" name="texte" rows="4" cols="50" required></textarea><br><br>

        <label for="image">Image :</label><br>
        <input type="file" id="image" name="image"><br><br> <!-- Champ pour l'upload de l'image -->

        <input type="submit" value="Créer l'Annonce">
    </form>
</body>

</html>