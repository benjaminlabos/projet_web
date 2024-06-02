<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page d'erreur de connexion
    header("Location: erreur_connexion.php");
    exit();
}

include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'offre est spécifiée dans l'URL
if (isset($_GET['offre'])) {
    $offre = $_GET['offre'];
} else {
    echo "Aucune offre spécifiée.";
    exit();
}

// Définir les détails de l'offre en fonction de la sélection
$details_offre = [
    'standard' => ['nom' => 'Standard', 'prix' => 20],
    'premium' => ['nom' => 'Premium', 'prix' => 25],
    'vip' => ['nom' => 'VIP', 'prix' => 30]
];

if (!array_key_exists($offre, $details_offre)) {
    echo "Offre non valide.";
    exit();
}

$nom_offre = $details_offre[$offre]['nom'];
$prix_offre = $details_offre[$offre]['prix'];
?>

<main>
    <section id="paiement">
        <div class="container">
            <h2>Paiement pour l'offre <?php echo $nom_offre; ?></h2>
            <form action="process_paiement.php" method="POST">
                <input type="hidden" name="offre" value="<?php echo $offre; ?>">
                <input type="hidden" name="prix" value="<?php echo $prix_offre; ?>">
                
                <h3>Coordonnées</h3>
                <label for="nom">Nom et Prénom</label>
                <input type="text" id="nom" name="nom" required>
                
                <label for="adresse1">Adresse Ligne 1</label>
                <input type="text" id="adresse1" name="adresse1" required>
                
                <label for="adresse2">Adresse Ligne 2</label>
                <input type="text" id="adresse2" name="adresse2">
                
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" required>
                
                <label for="code_postal">Code Postal</label>
                <input type="text" id="code_postal" name="code_postal" required>
                
                <label for="pays">Pays</label>
                <input type="text" id="pays" name="pays" required>
                
                <label for="telephone">Numéro de téléphone</label>
                <input type="text" id="telephone" name="telephone" required>
                
                <label for="carte_etudiant">Carte Etudiant</label>
                <input type="text" id="carte_etudiant" name="carte_etudiant" required>
                
                <h3>Informations de paiement</h3>
                <label for="type_carte">Type de carte de paiement</label>
                <select id="type_carte" name="type_carte" required>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="American Express">American Express</option>
                    <option value="PayPal">PayPal</option>
                </select>
                
                <label for="numero_carte">Numéro de la carte</label>
                <input type="text" id="numero_carte" name="numero_carte" required>
                
                <label for="nom_carte">Nom affiché sur la carte</label>
                <input type="text" id="nom_carte" name="nom_carte" required>
                
                <label for="expiration">Date d'expiration</label>
                <input type="text" id="expiration" name="expiration" placeholder="MM/AA" required>
                
                <label for="cvv">Code de sécurité</label>
                <input type="text" id="cvv" name="cvv" required>
                
                <button type="submit">Payer <?php echo $prix_offre; ?>€</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
