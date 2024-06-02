<?php
include 'header.php';

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'sportify');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: erreur_connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur connecté
$sql = "SELECT nom, prenom, email, adresse, type_utilisateur, carte_etudiante FROM utilisateurs WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

// Récupérer les rendez-vous confirmés pour les coachs
if ($user['type_utilisateur'] == 'coach') {
    $sql_rdv = "SELECT rv.*, u.nom AS client_nom, u.prenom AS client_prenom 
                FROM rendez_vous rv 
                JOIN utilisateurs u ON rv.utilisateur_id = u.id 
                WHERE rv.coach_id = (
                    SELECT id FROM coachs WHERE utilisateur_id = $user_id
                ) AND rv.statut = 'confirmé'";
    $result_rdv = $conn->query($sql_rdv);
}

// Récupérer les messages reçus et envoyés par l'utilisateur
$sql_messages = "SELECT m.*, 
                        u1.nom AS expediteur_nom, u1.prenom AS expediteur_prenom, 
                        u2.nom AS destinataire_nom, u2.prenom AS destinataire_prenom 
                 FROM messages m 
                 JOIN utilisateurs u1 ON m.expediteur_id = u1.id 
                 JOIN utilisateurs u2 ON m.destinataire_id = u2.id 
                 WHERE m.expediteur_id = $user_id OR m.destinataire_id = $user_id 
                 ORDER BY m.date_heure ASC";
$result_messages = $conn->query($sql_messages);
?>

<main>
    <section id="compte">
        <div class="container">
            <h2>Votre Compte</h2>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['nom']); ?></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['prenom']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <?php if ($user['type_utilisateur'] == 'client'): ?>
                <p><strong>Adresse :</strong> <?php echo htmlspecialchars($user['adresse']); ?></p>
                <?php if (!empty($user['carte_etudiante'])): ?>
                    <p><strong>Carte Étudiante :</strong> <?php echo htmlspecialchars($user['carte_etudiante']); ?></p>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if ($user['type_utilisateur'] == 'coach'): ?>
                <h3>Rendez-vous Confirmés</h3>
                <?php
                if ($result_rdv && $result_rdv->num_rows > 0) {
                    while ($row_rdv = $result_rdv->fetch_assoc()) {
                        echo "<div class='rendezvous'>";
                        echo "<p><strong>Client :</strong> " . $row_rdv['client_prenom'] . " " . $row_rdv['client_nom'] . "</p>";
                        echo "<p><strong>Date et Heure :</strong> " . $row_rdv['date_heure'] . "</p>";
                        echo "<p><strong>Statut :</strong> " . $row_rdv['statut'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun rendez-vous confirmé.</p>";
                }
                ?>
            <?php endif; ?>
            
            <h3>Messages</h3>
            <?php
            if ($result_messages && $result_messages->num_rows > 0) {
                $conversations = [];
                while ($row_msg = $result_messages->fetch_assoc()) {
                    $conversation_id = ($row_msg['expediteur_id'] == $user_id) ? $row_msg['destinataire_id'] : $row_msg['expediteur_id'];
                    if (!isset($conversations[$conversation_id])) {
                        $conversations[$conversation_id] = [];
                    }
                    $conversations[$conversation_id][] = $row_msg;
                }

                foreach ($conversations as $conversation_id => $messages) {
                    echo "<div class='conversation'>";
                    echo "<h4>Conversation avec ";
                    echo ($messages[0]['expediteur_id'] == $user_id) ? $messages[0]['destinataire_prenom'] . " " . $messages[0]['destinataire_nom'] : $messages[0]['expediteur_prenom'] . " " . $messages[0]['expediteur_nom'];
                    echo "</h4>";
                    foreach ($messages as $message) {
                        echo "<div class='message'>";
                        echo "<p><strong>" . (($message['expediteur_id'] == $user_id) ? "Vous" : $message['expediteur_prenom'] . " " . $message['expediteur_nom']) . " :</strong> " . $message['contenu'] . "</p>";
                        echo "<p><em>" . $message['date_heure'] . "</em></p>";
                        echo "</div>";
                    }
                    echo "<form action='repondre_message.php' method='POST'>";
                    echo "<input type='hidden' name='destinataire_id' value='$conversation_id'>";
                    echo "<textarea name='reponse' placeholder='Votre réponse'></textarea>";
                    echo "<button type='submit'>Envoyer</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun message reçu.</p>";
            }
            ?>

            <?php if ($user['type_utilisateur'] == 'administrateur'): ?>
                <a href="creer_coach.php"><button>Créer un coach</button></a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
