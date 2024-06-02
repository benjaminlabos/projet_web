<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page d'erreur de connexion
    header("Location: erreur_connexion.php");
    exit();
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offre = $conn->real_escape_string($_POST['offre']);
    $prix = $conn->real_escape_string($_POST['prix']);
    $nom = $conn->real_escape_string($_POST['nom']);
    $adresse1 = $conn->real_escape_string($_POST['adresse1']);
    $adresse2 = $conn->real_escape_string($_POST['adresse2']);
    $ville = $conn->real_escape_string($_POST['ville']);
    $code_postal = $conn->real_escape_string($_POST['code_postal']);
    $pays = $conn->real_escape_string($_POST['pays']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $carte_etudiant = $conn->real_escape_string($_POST['carte_etudiant']);
    $type_carte = $conn->real_escape_string($_POST['type_carte']);
    $numero_carte = $conn->real_escape_string($_POST['numero_carte']);
    $nom_carte = $conn->real_escape_string($_POST['nom_carte']);
    $expiration = $conn->real_escape_string($_POST['expiration']);
    $cvv = $conn->real_escape_string($_POST['cvv']);
    
    // Valider les informations de paiement (simulé)
    $paiement_valide = true; // Simulation de la validation du paiement
    
    if ($paiement_valide) {
        // Enregistrement des informations de l'utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (nom, adresse1, adresse2, ville, code_postal, pays, telephone, carte_etudiant, offre, prix) VALUES ('$nom', '$adresse1', '$adresse2', '$ville', '$code_postal', '$pays', '$telephone', '$carte_etudiant', '$offre', '$prix')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_id'] = $conn->insert_id;

            // Envoyer un email de confirmation (simulation)
            $to = $email;
            $subject = "Confirmation de Paiement";
            $message = "Merci pour votre paiement. Vous êtes maintenant inscrit à l'offre $offre.";
            $headers = "From: contact@omnes.sport";
            mail($to, $subject, $message, $headers);
            
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Paiement non valide.";
    }
}
?>

<?php include 'header.php'; ?>

<main>
    <section id="confirmation">
        <div class="container">
            <h2>Confirmation de Paiement</h2>
            <p>Merci pour votre paiement. Vous êtes maintenant inscrit à l'offre <?php echo htmlspecialchars($offre); ?>.</p>
            <a href="index.php" class="btn">Retour à l'accueil</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
