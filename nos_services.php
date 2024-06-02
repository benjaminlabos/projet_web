<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations de la salle
$sql = "SELECT nom, description, adresse, telephone, email FROM salles WHERE id = 1";
$result = $conn->query($sql);

if ($result === false) {
    die("Erreur SQL : " . $conn->error);
}

if ($result->num_rows > 0) {
    $salle = $result->fetch_assoc();
} else {
    echo "Aucune information de salle trouvée.";
    exit();
}
?>

<main>
    <section id="details-salle">
        <div class="container">
            <h2><?php echo $salle['nom']; ?></h2>
            <p><?php echo nl2br($salle['description']); ?></p>
            <h3>Coordonnées</h3>
            <p><strong>Adresse :</strong> <?php echo $salle['adresse']; ?></p>
            <p><strong>Téléphone :</strong> <?php echo $salle['telephone']; ?></p>
            <p><strong>Email :</strong> <?php echo $salle['email']; ?></p>
            <!-- Ajoutez plus de détails sur les services ici -->
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
