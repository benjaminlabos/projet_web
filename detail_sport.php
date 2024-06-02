<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations du sport de compétition
$sport_id = $_GET['id'];
$sql = "SELECT * FROM sports_competition WHERE id = $sport_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sport = $result->fetch_assoc();
} else {
    echo "Sport non trouvé.";
    exit();
}

// Récupérer les coachs associés au sport de compétition
$sql = "SELECT c.id, u.nom, u.prenom, c.photo 
        FROM coachs_sports cs 
        JOIN coachs c ON cs.coach_id = c.id 
        JOIN utilisateurs u ON c.utilisateur_id = u.id 
        WHERE cs.sport_id = $sport_id";
$coachs_result = $conn->query($sql);
?>

<main>
    <section id="sport-details">
        <div class="container">
            <h2>Description</h2>
            <p><?php echo $sport['description']; ?></p>
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
                <p>Aucun coach associé à ce sport.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
