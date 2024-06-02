<?php
session_start();

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: erreur_connexion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rendezvous_id = $conn->real_escape_string($_POST['rendezvous_id']);

    // Annuler le rendez-vous
    $sql = "UPDATE rendez_vous SET statut = 'annulé' WHERE id = $rendezvous_id";
    if ($conn->query($sql) === TRUE) {
        echo "Rendez-vous annulé avec succès.";
    } else {
        echo "Erreur lors de l'annulation du rendez-vous : " . $conn->error;
    }
}

header("Location: rendezvous.php");
exit();
?>
