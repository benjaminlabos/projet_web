<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportify</title>
    <link rel="stylesheet" href="acceuil.css">
    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn:active {
            background-color: #004085;
        }

        .btn-container {
            text-align: center;
            margin: 20px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        img {
            width: 50%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <section id="activites-sportives">
        <div class="container">
            <h2>Activités Sportives</h2>
            <img src="images/ap.jpg" alt="Activités Sportives">
            <div class="btn-container">
                <a href="detail_activite.php?id=1" class="btn">Musculation</a>
                <a href="detail_activite.php?id=2" class="btn">Fitness</a>
                <a href="detail_activite.php?id=3" class="btn">Biking</a>
                <a href="detail_activite.php?id=4" class="btn">Cardio-Training</a>
                <a href="detail_activite.php?id=5" class="btn">Cours Collectifs</a>
            </div>
        </div>
    </section>
    <section id="sports-competition">
        <div class="container">
            <h2>Sports de Compétition</h2>
            <img src="images/sc.jpg" alt="Sports de Compétition">
            <div class="btn-container">
                <a href="detail_sport.php?id=3" class="btn">Basketball</a>
                <a href="detail_sport.php?id=4" class="btn">Football</a>
                <a href="detail_sport.php?id=5" class="btn">Rugby</a>
                <a href="detail_sport.php?id=6" class="btn">Tennis</a>
                <a href="detail_sport.php?id=7" class="btn">Natation</a>
                <a href="detail_sport.php?id=8" class="btn">Plongeon</a>
            </div>
        </div>
    </section>
    <section id="salle-de-sport">
        <div class="container">
            <h2>Salle de Sport Omnes</h2>
            <img src="images/salle.jpg" alt="Salle de Sport Omnes">
            <div class="btn-container">
                <a href="nos_services.php" class="btn">Nos Informations</a>
                <a href="horaire_gym.php" class="btn">Horaire de la Gym</a>
                <a href="regles_machines.php" class="btn">Règles sur l'utilisation des Machines</a>
                <a href="nouveaux_clients.php" class="btn">Nouveaux Clients</a>
                <a href="alimentation_nutrition.php" class="btn">Alimentation et Nutrition</a>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
