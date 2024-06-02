<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_query = '';
if (isset($_GET['query'])) {
    $search_query = $conn->real_escape_string($_GET['query']);
}

// Requête pour rechercher uniquement les coachs, les activités sportives et les sports de compétition correspondant à la requête
$sql = "
    SELECT 'Coach' AS type, CONCAT(u.nom, ' ', u.prenom) AS nom, c.id, 'coach' AS category
    FROM utilisateurs u
    JOIN coachs c ON u.id = c.utilisateur_id
    WHERE (u.nom LIKE '%$search_query%' OR u.prenom LIKE '%$search_query%' OR u.email LIKE '%$search_query%' OR u.type_utilisateur LIKE '%$search_query%')
    UNION
    SELECT 'Activité Sportive' AS type, ac.nom AS nom, ac.id, 'activite' AS category
    FROM activites_sportives ac
    WHERE ac.nom LIKE '%$search_query%' OR ac.description LIKE '%$search_query%'
    UNION
    SELECT 'Sport de Compétition' AS type, sc.nom AS nom, sc.id, 'sport' AS category
    FROM sports_competition sc
    WHERE sc.nom LIKE '%$search_query%' OR sc.description LIKE '%$search_query%'
";
$result = $conn->query($sql);
?>

<main>
    <section id="recherche">
        <div class="container">
            <h2>Résultats de recherche pour "<?php echo htmlspecialchars($search_query); ?>"</h2>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='resultat'>";
                    echo "<p><strong>Type :</strong> " . $row['type'] . "</p>";
                    echo "<p><strong>Nom :</strong> " . $row['nom'] . "</p>";
                    if ($row['category'] == 'coach') {
                        echo "<a href='detail_coach.php?id=" . $row['id'] . "'>Voir Détails</a>";
                    } elseif ($row['category'] == 'activite') {
                        echo "<a href='detail_activite.php?id=" . $row['id'] . "'>Voir Détails</a>";
                    } else {
                        echo "<a href='detail_sport.php?id=" . $row['id'] . "'>Voir Détails</a>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun résultat trouvé.</p>";
            }
            ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
