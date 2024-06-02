<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID du coach est défini dans l'URL
if (isset($_GET['id'])) {
    $coach_id = $_GET['id'];
} else {
    echo "ID du coach non spécifié.";
    exit();
}

// Récupérer les informations du coach
$sql = "SELECT u.nom, u.prenom, c.photo, c.specialite, c.cv, c.bureau 
        FROM coachs c 
        JOIN utilisateurs u ON c.utilisateur_id = u.id 
        WHERE c.id = $coach_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $coach = $result->fetch_assoc();
} else {
    echo "Coach non trouvé.";
    exit();
}

// Récupérer le calendrier des disponibilités du coach
$sql_disponibilites = "SELECT * FROM disponibilites WHERE coach_id = $coach_id ORDER BY jour, heure_debut";
$disponibilites_result = $conn->query($sql_disponibilites);
$disponibilites = [];
while ($row = $disponibilites_result->fetch_assoc()) {
    $disponibilites[] = $row;
}

// Récupérer les rendez-vous déjà pris
$sql_rendezvous = "SELECT * FROM rendez_vous WHERE coach_id = $coach_id AND statut = 'confirmé'";
$rendezvous_result = $conn->query($sql_rendezvous);
$rendezvous = [];
while ($row = $rendezvous_result->fetch_assoc()) {
    $rendezvous[] = $row['date_heure'];
}

// Fonction pour vérifier si un créneau est disponible
function est_disponible($jour, $heure_debut, $heure_fin, $rendezvous) {
    foreach ($rendezvous as $rdv) {
        $rdv_time = strtotime($rdv);
        $rdv_jour = date('N', $rdv_time);
        $rdv_heure = date('H:i:s', $rdv_time);
        if ($jour == $rdv_jour && $rdv_heure >= $heure_debut && $rdv_heure < $heure_fin) {
            return false;
        }
    }
    return true;
}

function afficher_emploi_du_temps($disponibilites, $rendezvous) {
    $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
    echo "<div class='schedule-container'>";
    echo "<table class='schedule-table'>";
    echo "<tr><th>Jour</th><th>Heure Début</th><th>Heure Fin</th><th>Disponibilité</th></tr>";
    foreach ($disponibilites as $dispo) {
        $disponible = est_disponible($dispo['jour'], $dispo['heure_debut'], $dispo['heure_fin'], $rendezvous);
        echo "<tr>";
        echo "<td>" . $jours[$dispo['jour'] - 1] . "</td>";
        echo "<td>" . $dispo['heure_debut'] . "</td>";
        echo "<td>" . $dispo['heure_fin'] . "</td>";
        if ($disponible) {
            echo "<td><a href='prendre_rendezvous.php?id=" . $dispo['coach_id'] . "&jour=" . $dispo['jour'] . "&heure_debut=" . $dispo['heure_debut'] . "'>Prendre RDV</a></td>";
        } else {
            echo "<td>Indisponible</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}
?>

<main>
    <section id="coach-details">
        <div class="container">
            <img src="images/<?php echo $coach['photo']; ?>" alt="Photo de <?php echo $coach['nom']; ?>">
            <h2><?php echo $coach['specialite']; ?></h2>
            <p><strong>Bureau :</strong> <?php echo $coach['bureau']; ?></p>
            <p><?php echo nl2br($coach['cv']); ?></p>
            <h3>Disponibilités</h3>
            <?php afficher_emploi_du_temps($disponibilites, $rendezvous); ?>
            <h3>Envoyer un Message</h3>
            <form action="envoyer_message.php" method="POST">
                <input type="hidden" name="coach_id" value="<?php echo $coach_id; ?>">
                <textarea name="message" placeholder="Votre message" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
