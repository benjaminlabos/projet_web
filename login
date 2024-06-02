<?php
session_start();
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $mot_de_passe = $conn->real_escape_string($_POST['mot_de_passe']);

    // Rechercher l'utilisateur dans la base de données
    $sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe
        if ($mot_de_passe == $user['mot_de_passe']) { // Utilisez password_verify si vous avez hashé les mots de passe
            // Mot de passe correct, démarrer la session utilisateur
            $_SESSION['user_id'] = $user['id'];
            header("Location: connexion_reussie.php");
            exit();
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<?php include 'header.php'; ?>

<main>
    <section id="login">
        <div class="container">
            <h2>Connexion</h2>
            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <button type="submit">Connexion</button>
            </form>
            <p>Pas de compte? <a href="register.php">Inscrivez-vous ici</a></p>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
