<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportify</title>
    <link rel="stylesheet" href="acceuil.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Sportify</h1>
            <nav>
                <ul>
                    <li><a href="acceuil.php">Accueil</a></li>
                    <li><a href="parcourir.php">Tout Parcourir</a></li>
                    <li><a href="rendezvous.php">Rendez-vous</a></li>
                    <li><a href="compte.php">Votre Compte</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Connexion</a></li>
                    <?php endif; ?>
                </ul>
                <form action="recherche.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Nom ou Spécialité" required>
                    <button type="submit">Rechercher</button>
                </form>
            </nav>
        </div>
    </header>
</body>
</html>
