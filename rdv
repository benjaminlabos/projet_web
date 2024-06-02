<?php
session_start();
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifiez si les informations nécessaires sont présentes dans l'URL
if (isset($_GET['id'], $_GET['jour'], $_GET['heure_debut'])) {
    $coach_id = $_GET['id'];
    $jour = $_GET['jour'];
    $heure_debut = $_GET['heure_debut'];

    // Définir la variable $jours en anglais pour DateTime::modify()
    $jours = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

    // Calculer la date et l'heure du prochain créneau disponible
    $date_heure = new DateTime();
    $date_heure->modify("next " . $jours[$jour - 1]);
    $date_heure->setTime(substr($heure_debut, 0, 2), substr($heure_debut, 3, 2));

    // Insérer le rendez-vous dans la base de données
    $sql = "INSERT INTO rendez_vous (utilisateur_id, coach_id, date_heure) VALUES ({$_SESSION['user_id']}, $coach_id, '" . $date_heure->format('Y-m-d H:i:s') . "')";
    if ($conn->query($sql) === TRUE) {
        echo "Rendez-vous pris avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Informations insuffisantes pour prendre un rendez-vous.";
}

include 'footer.php';
?>
