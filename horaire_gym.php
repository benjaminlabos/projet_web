<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les horaires de la salle de sport
$sql = "SELECT jour, heure_ouverture, heure_fermeture FROM horaires_salle";
$result = $conn->query($sql);

if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . $conn->error);
}

$horaires = [];
while ($row = $result->fetch_assoc()) {
    $horaires[] = $row;
}
?>

<main>
    <section id="hor-salle">
        <div class="container">
            <h2>Horaire de la Gym</h2>
            <h3>Horaires d'Ouverture</h3>
            <table class="center-table">
                <tr><th>Jour</th><th>Ouverture</th><th>Fermeture</th></tr>
                <?php foreach ($horaires as $horaire): ?>
                <tr>
                    <td><?php echo $horaire['jour']; ?></td>
                    <td><?php echo $horaire['heure_ouverture']; ?></td>
                    <td><?php echo $horaire['heure_fermeture']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
