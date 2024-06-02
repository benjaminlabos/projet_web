<?php

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations de l'activité sportive
$activite_id = $_GET['id'];
$sql = "SELECT * FROM activites_sportives WHERE id = $activite_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $activite = $result->fetch_assoc();
} else {
    echo "Activité non trouvée.";
    exit();
}

// Récupérer les coachs associés à l'activité sportive
$sql = "SELECT c.id, u.nom, u.prenom, c.photo 
        FROM coachs_activites ca 
        JOIN coachs c ON ca.coach_id = c.id 
        JOIN utilisateurs u ON c.utilisateur_id = u.id 
        WHERE ca.activite_id = $activite_id";
$coachs_result = $conn->query($sql);
?>
<?php include 'header.php'; ?>
<main>
    <section id="activite-details">
        <div class="container">
            <h2>Description</h2>
            <p><?php echo $activite['description']; ?></p>
        </div>
    </section>
    <section id="coachs">
        <div class="container">
            <h2>Coachs Associés</h2>
            <?php if ($coachs_result->num_rows > 0): ?>
                <ul>
                    <?php while($coach = $coachs_result->fetch_assoc()): ?>
                        <li>
                            <img src="images/<?php echo $coach['photo']; ?>" alt="Photo de <?php echo $coach['nom']; ?>">
                            <h3><?php echo $coach['nom'] . ' ' . $coach['prenom']; ?></h3>
                            <a href="detail_coach.php?id=<?php echo $coach['id']; ?>">Voir Profil</a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Aucun coach associé à cette activité.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
