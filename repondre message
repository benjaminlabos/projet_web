<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour envoyer un message.";
    exit();
}

$expediteur_id = $_SESSION['user_id'];

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifiez si les informations nécessaires sont présentes dans le formulaire
if (isset($_POST['destinataire_id'], $_POST['reponse'])) {
    $destinataire_id = $_POST['destinataire_id'];
    $reponse = $conn->real_escape_string($_POST['reponse']); // Échappe les caractères spéciaux pour éviter les injections SQL

    // Insérer la réponse dans la base de données
    $sql = "INSERT INTO messages (expediteur_id, destinataire_id, contenu) VALUES ($expediteur_id, $destinataire_id, '$reponse')";
    if ($conn->query($sql) === TRUE) {
        header("Location: compte.php");
        exit();
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Informations insuffisantes pour envoyer un message.";
}
?>
