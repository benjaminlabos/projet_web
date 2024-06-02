<?php
session_start();

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Vérifier si l'utilisateur est un administrateur
$sql = "SELECT type_utilisateur FROM utilisateurs WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['type_utilisateur'] != 'administrateur') {
        echo "Vous devez être un administrateur pour accéder à cette page.";
        exit();
    }
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

// Récupérer les données du formulaire
$nom = $conn->real_escape_string($_POST['nom']);
$prenom = $conn->real_escape_string($_POST['prenom']);
$email = $conn->real_escape_string($_POST['email']);
$mot_de_passe = $conn->real_escape_string($_POST['mot_de_passe']);
$cv = $conn->real_escape_string($_POST['cv']);
$photo = $conn->real_escape_string($_POST['photo']);
$bureau = $conn->real_escape_string($_POST['bureau']);
$type_activite = $conn->real_escape_string($_POST['type_activite']);
$activite_sport = $conn->real_escape_string($_POST['activite_sport']);

// Insérer le coach dans la table utilisateurs
$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, type_utilisateur) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe', 'coach')";
if ($conn->query($sql) === TRUE) {
    $utilisateur_id = $conn->insert_id;

    // Insérer les détails du coach dans la table coachs
    $sql = "INSERT INTO coachs (utilisateur_id, cv, bureau, photo) VALUES ($utilisateur_id, '$cv', '$bureau', '$photo')";
    if ($conn->query($sql) === TRUE) {
        $coach_id = $conn->insert_id;

        // Associer le coach à l'activité sportive ou au sport de compétition
        if ($type_activite == 'activite_sportive') {
            $activite_id = str_replace('activite_', '', $activite_sport);
            $sql = "INSERT INTO coachs_activites (coach_id, activite_id) VALUES ($coach_id, $activite_id)";
        } else {
            $sport_id = str_replace('sport_', '', $activite_sport);
            $sql = "INSERT INTO coachs_sports (coach_id, sport_id) VALUES ($coach_id, $sport_id)";
        }
        $conn->query($sql);

        // Insérer les disponibilités du coach
        foreach ($_POST['disponibilites'] as $jour => $heures) {
            $heure_debut = $conn->real_escape_string($heures['debut']);
            $heure_fin = $conn->real_escape_string($heures['fin']);
            $sql = "INSERT INTO disponibilites (coach_id, jour, heure_debut, heure_fin) VALUES ($coach_id, $jour, '$heure_debut', '$heure_fin')";
            $conn->query($sql);
        }

        echo "Coach créé avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}
?>
