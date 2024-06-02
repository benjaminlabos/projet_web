<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id'])) {
    header("Location: erreur_connexion.php");
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

// Récupérer les activités sportives et les sports de compétition
$sql_activites = "SELECT id, nom FROM activites_sportives";
$sql_sports = "SELECT id, nom FROM sports_competition";
$result_activites = $conn->query($sql_activites);
$result_sports = $conn->query($sql_sports);
?>

<main>
    <section id="creer-coach">
        <div class="container">
            <h2>Créer un Coach</h2>
            <form action="enregistrer_coach.php" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
                
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <br>
                <label for="cv">CV</label>
                <textarea id="cv" name="cv" required></textarea>
                <br>
                <label for="photo">URL de la photo</label>
                <input type="text" id="photo" name="photo" required>
                
                <label for="bureau">Bureau</label>
                <input type="text" id="bureau" name="bureau" required>
                <br>
                <br>
                <label for="type_activite">Type d'activité</label>
                <select id="type_activite" name="type_activite" required>
                    <option value="sport_competition">Sport de Compétition</option>
                    <option value="activite_sportive">Activité Sportive</option>
                </select>
                
                <label for="activite_sport">Activité/Sport</label>
                <select id="activite_sport" name="activite_sport" required>
                    <optgroup label="Activités Sportives">
                        <?php while ($row = $result_activites->fetch_assoc()): ?>
                            <option value="activite_<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nom']); ?></option>
                        <?php endwhile; ?>
                    </optgroup>
                    <optgroup label="Sports de Compétition">
                        <?php while ($row = $result_sports->fetch_assoc()): ?>
                            <option value="sport_<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nom']); ?></option>
                        <?php endwhile; ?>
                    </optgroup>
                </select>
                
                <h3>Disponibilités</h3>
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <div>
                        <label for="jour_<?php echo $i; ?>">Jour <?php echo $i; ?></label>
                        <input type="time" id="heure_debut_<?php echo $i; ?>" name="disponibilites[<?php echo $i; ?>][debut]" required>
                        <input type="time" id="heure_fin_<?php echo $i; ?>" name="disponibilites[<?php echo $i; ?>][fin]" required>
                    </div>
                <?php endfor; ?>
                
                <button type="submit">Créer le Coach</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
