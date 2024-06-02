<?php
session_start();
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $email = $conn->real_escape_string($_POST['email']);
    $mot_de_passe = $conn->real_escape_string($_POST['mot_de_passe']);
    $adresse = $conn->real_escape_string($_POST['adresse']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $type_utilisateur = $conn->real_escape_string($_POST['type_utilisateur']);
    $carte_etudiante = $conn->real_escape_string($_POST['carte_etudiante']);

    // Insérer le nouvel utilisateur dans la base de données
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, adresse, telephone, type_utilisateur, carte_etudiante) 
            VALUES ('$nom', '$prenom', '$email', '$mot_de_passe', '$adresse', '$telephone', '$type_utilisateur', '$carte_etudiante')";

    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie. Vous pouvez maintenant vous <a href='login.php'>connecter</a>.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include 'header.php'; ?>

<main>
    <section id="register">
        <div class="container">
            <h2>Inscription</h2>
            <form action="register.php" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" required>
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" required>
                <label for="type_utilisateur">Type d'utilisateur</label>
                <select id="type_utilisateur" name="type_utilisateur" required>
                    <option value="client">Client</option>
                    <option value="coach">Coach</option>
                </select>
                <label for="carte_etudiante">Carte Etudiante (optionnel)</label>
                <input type="text" id="carte_etudiante" name="carte_etudiante">
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
