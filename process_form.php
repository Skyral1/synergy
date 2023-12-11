<!-- Dev by @Skyral_ -->
<!-- https://github.com/Skyral1 -->

<?php
// Récupération des données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$message = $_POST['message'];

// Charger l'URL du webhook Discord à partir d'une variable d'environnement
$webhookurl = 'WEBHOOK_URL'; // Assure-toi de définir cette variable d'environnement

if ($webhookurl) {
    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        // Message à envoyer sur Discord
        "content" => "Nouveau message de contact reçu!",
        "embeds" => [
            [
                "title" => "Nouveau message de contact",
                "color" => hexdec("3366ff"),
                "fields" => [
                    [
                        "name" => "Nom",
                        "value" => $nom,
                        "inline" => true
                    ],
                    [
                        "name" => "Email",
                        "value" => $email,
                        "inline" => true
                    ],
                    [
                        "name" => "Message",
                        "value" => $message
                    ]
                ],
                "timestamp" => $timestamp
            ]
        ]
    ]);

    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        echo "Erreur Curl : " . $error;
    } else {
        echo "Message envoyé avec succès !";
    }

    curl_close($ch);

    // Redirection vers une page de confirmation
    header('Location: ./index.php');
} else {
    echo "L'URL du webhook Discord n'a pas été définie.";
}
?>