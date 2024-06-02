<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour envoyer un message.";
    exit();
}

$utilisateur_id = $_SESSION['user_id'];

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifiez si les informations nécessaires sont présentes dans le formulaire
if (isset($_POST['coach_id'], $_POST['message'])) {
    $coach_id = $_POST['coach_id'];
    $message = $conn->real_escape_string($_POST['message']); // Échappe les caractères spéciaux pour éviter les injections SQL

    // Insérer le message dans la base de données
    $sql = "INSERT INTO messages (expediteur_id, destinataire_id, contenu) VALUES ($utilisateur_id, $coach_id, '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Informations insuffisantes pour envoyer un message.";
}
?>
