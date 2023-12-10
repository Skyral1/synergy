document
	.getElementById("contactForm")
	.addEventListener("submit", function (event) {
		event.preventDefault(); // Empêche le rechargement de la page après la soumission du formulaire

		// Récupération des valeurs du formulaire
		var nom = document.getElementById("nom").value;
		var email = document.getElementById("email").value;
		var message = document.getElementById("message").value;

		// Données à envoyer au webhook Discord
		var webhookURL =
			"https://discord.com/api/webhooks/1183469620116607136/4dOR5wLyl7mQnpsVE0NUxltdKbKhMjoO1VrBsSpemRQ0TwVCNgeUUhnsuQ6_BFDFiyWD"; // Remplace avec ton URL de webhook

		var timestamp = new Date().toISOString();

		var jsonData = {
			content: "Nouveau message de contact reçu!",
			embeds: [
				{
					title: "Nouveau message de contact",
					color: 663399,
					fields: [
						{
							name: "Nom",
							value: nom,
							inline: true,
						},
						{
							name: "Email",
							value: email,
							inline: true,
						},
						{
							name: "Message",
							value: message,
						},
					],
					timestamp: timestamp,
				},
			],
		};

		// Envoi des données via fetch
		fetch(webhookURL, {
			method: "POST",
			headers: {
				"Content-type": "application/json",
			},
			body: JSON.stringify(jsonData),
		})
			.then((response) => {
				if (!response.ok) {
					throw new Error("Erreur lors de l'envoi des données");
				}
				return response.json();
			})
			.then((data) => {
				console.log("Message envoyé avec succès:", data);
				// Faire quelque chose après l'envoi réussi (par exemple, afficher un message de confirmation)
			})
			.catch((error) => {
				console.error("Erreur:", error);
				// Gérer les erreurs ici (par exemple, afficher un message d'erreur)
			});
	});
