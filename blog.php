<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="./assets/img/Synergie-Black-White.ico" type="image/x-icon" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<script src="https://kit.fontawesome.com/28b70435c7.js" crossorigin="anonymous"></script>
	<script src="./assets/js/main.js" defer></script>
	<title>Document</title>
</head>

<body>
	<header>
		<a href="./"><img class="logo" src="assets/img/Synergie-Black-White.png" alt="Synergy logo" /></a>
		<nav class="nav-links">
			<ul class="nav-list">
				<li>
					<a href="./"><i class="fa-solid fa-house"></i> Accueil</a>
				</li>
				<li>
					<a href="./blog.php"><i class="fa-solid fa-square-rss"></i> Blog</a>
				</li>
				<li>
					<a href="./ressources.html"><i class="fa-solid fa-circle-info"></i> Ressources</a>
				</li>
				<li>
					<a href="./contact.html"><i class="fa-regular fa-envelope"></i> Contact</a>
				</li>
				<li>
					<a href="./login.php"><i class="fa-solid fa-plus"></i> Créer un annonce</a>
				</li>
			</ul>
		</nav>
		<div class="burger-menu">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
	</header>
	<main>
		<section class="publication">
			<!-- Votre formulaire de publication reste inchangé -->
			<!-- ... -->
		</section>

		<section class="annonces">
			<h2>Annonces existantes</h2>
			<?php include('display_announcements.php'); ?>
			<!-- Cela inclura le script PHP pour afficher les annonces -->
		</section>

		<!-- Le reste de votre contenu de blog ici -->
		<!-- ... -->
	</main>

	<footer>
		Copyright &copy; 2023-2024
		<a href="https://www.saint-raphael.be/" target="_blank" rel="noopener noreferrer">Saint-Raphael Remouchamps</a>.
		Tous droits réservés.
	</footer>
</body>

</html>