<?php
include 'header.php';

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

$user_id = $_SESSION['user_id'];

// Récupérer les rendez-vous confirmés de l'utilisateur, y compris les activités sportives et les sports de compétition
$sql = "SELECT rv.*, u.nom AS coach_nom, u.prenom AS coach_prenom, 
        ac.nom AS activite_nom, ac.lieu AS activite_lieu, 
        sc.nom AS sport_nom, sc.lieu AS sport_lieu
        FROM rendez_vous rv 
        JOIN coachs c ON rv.coach_id = c.id
        JOIN utilisateurs u ON c.utilisateur_id = u.id 
        LEFT JOIN coachs_activites ca ON c.id = ca.coach_id
        LEFT JOIN activites_sportives ac ON ac.id = ca.activite_id
        LEFT JOIN coachs_sports cs ON c.id = cs.coach_id
        LEFT JOIN sports_competition sc ON sc.id = cs.sport_id
        WHERE rv.utilisateur_id = $user_id AND rv.statut = 'confirmé'";
$result = $conn->query($sql);

?>

<main>
    <section id="rendez-vous">
        <div class="container">
            <h2>Vos Rendez-vous Confirmés</h2>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='rendezvous'>";
                    echo "<p><strong>Coach :</strong> " . $row['coach_prenom'] . " " . $row['coach_nom'] . "</p>";
                    if (!empty($row['activite_nom'])) {
                        echo "<p><strong>Activité :</strong> " . $row['activite_nom'] . "</p>";
                        echo "<p><strong>Adresse :</strong> " . $row['activite_lieu'] . "</p>";
                        echo "<p><strong>Digicode :</strong> " . $row['digicode'] . "</p>";
                    } elseif (!empty($row['sport_nom'])) {
                        echo "<p><strong>Sport de Compétition :</strong> " . $row['sport_nom'] . "</p>";
                        echo "<p><strong>Adresse :</strong> " . $row['sport_lieu'] . "</p>";
                    }
                    echo "<p><strong>Date et Heure :</strong> " . $row['date_heure'] . "</p>";
                    echo "<form action='annuler_rendezvous.php' method='POST'>";
                    echo "<input type='hidden' name='rendezvous_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit'>Annuler le Rendez-vous</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun rendez-vous confirmé trouvé.</p>";
            }
            ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
