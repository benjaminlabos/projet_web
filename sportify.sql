-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 02 juin 2024 à 10:58
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sportify`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites_sportives`
--

DROP TABLE IF EXISTS `activites_sportives`;
CREATE TABLE IF NOT EXISTS `activites_sportives` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `lieu` varchar(255) DEFAULT 'Adidas Arena',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `activites_sportives`
--

INSERT INTO `activites_sportives` (`id`, `nom`, `description`, `lieu`) VALUES
(1, 'Musculation', 'Activité visant à développer la masse musculaire.', 'Adidas Arena'),
(2, 'Fitness', 'Activité physique pour améliorer la condition physique.', 'Adidas Arena'),
(3, 'Biking', 'Activité de cyclisme pour renforcer l’endurance et le cardio.', 'Adidas Arena'),
(4, 'Cardio-Training', 'Ensemble d’exercices visant à améliorer la capacité cardiovasculaire.', 'Adidas Arena'),
(5, 'Cours Collectifs', 'Séances de sport en groupe pour diverses disciplines.', 'Adidas Arena');

-- --------------------------------------------------------

--
-- Structure de la table `coachs`
--

DROP TABLE IF EXISTS `coachs`;
CREATE TABLE IF NOT EXISTS `coachs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `specialite` varchar(255) DEFAULT NULL,
  `cv` text,
  `bureau` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `coachs`
--

INSERT INTO `coachs` (`id`, `utilisateur_id`, `photo`, `specialite`, `cv`, `bureau`) VALUES
(1, 3, 'paul_leroy.jpg', 'Musculation', 'Paul Leroy a 10 ans d expérience en musculation et fitness.', 'AB'),
(2, 4, 'marie_bernard.jpg', 'Tennis', 'Marie Bernard est une ancienne joueuse professionnelle de tennis.', 'BF'),
(15, 5, 'jean_durand.jpg', 'Fitness', 'Jean Durand est un expert en fitness avec 15 ans d\'expérience.', 'A1'),
(16, 6, 'sophie_martin.jpg', 'Biking', 'Sophie Martin est une cycliste passionnée avec 10 ans d\'expérience.', 'B2'),
(17, 7, 'luc_dupont.jpg', 'Cardio Training', 'Luc Dupont est un entraîneur de cardio avec une vaste expérience en endurance.', 'C3'),
(18, 8, 'emma_bernard.jpg', 'Cours Collectif', 'Emma Bernard est spécialisée dans les cours collectifs avec plus de 12 ans d\'expérience.', 'D4'),
(19, 17, 'thomas_lefevre.jpg', 'Basketball', 'Thomas Lefevre est un expert en basketball avec 10 ans d\'expérience.', 'B1'),
(20, 18, 'julie_moreau.jpg', 'Football', 'Julie Moreau est une experte en football avec 8 ans d\'expérience.', 'F1'),
(21, 19, 'marc_petit.jpg', 'Rugby', 'Marc Petit est un expert en rugby avec 12 ans d\'expérience.', 'R1'),
(22, 20, 'claire_durant.jpg', 'Natation', 'Claire Durant est une experte en natation avec 15 ans d\'expérience.', 'N1'),
(23, 21, 'nicolas_lemoine.jpg', 'Plongeon', 'Nicolas Lemoine est un expert en plongeon avec 7 ans d\'expérience.', 'P1'),
(25, 25, 'a_b.jpg', NULL, 'lalallala', '555');

-- --------------------------------------------------------

--
-- Structure de la table `coachs_activites`
--

DROP TABLE IF EXISTS `coachs_activites`;
CREATE TABLE IF NOT EXISTS `coachs_activites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coach_id` int DEFAULT NULL,
  `activite_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coach_id` (`coach_id`),
  KEY `activite_id` (`activite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `coachs_activites`
--

INSERT INTO `coachs_activites` (`id`, `coach_id`, `activite_id`) VALUES
(1, 1, 1),
(2, 15, 2),
(3, 16, 3),
(6, 17, 4),
(7, 18, 5);

-- --------------------------------------------------------

--
-- Structure de la table `coachs_sports`
--

DROP TABLE IF EXISTS `coachs_sports`;
CREATE TABLE IF NOT EXISTS `coachs_sports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coach_id` int DEFAULT NULL,
  `sport_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coach_id` (`coach_id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `coachs_sports`
--

INSERT INTO `coachs_sports` (`id`, `coach_id`, `sport_id`) VALUES
(1, 2, 6),
(2, 19, 3),
(3, 20, 4),
(4, 21, 5),
(5, 22, 7),
(6, 23, 8),
(8, 25, 4);

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

DROP TABLE IF EXISTS `disponibilites`;
CREATE TABLE IF NOT EXISTS `disponibilites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coach_id` int DEFAULT NULL,
  `jour` int DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coach_id` (`coach_id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `disponibilites`
--

INSERT INTO `disponibilites` (`id`, `coach_id`, `jour`, `heure_debut`, `heure_fin`) VALUES
(1, 2, 2, '09:00:00', '12:00:00'),
(2, 2, 2, '14:00:00', '17:00:00'),
(3, 2, 3, '09:00:00', '12:00:00'),
(4, 2, 3, '14:00:00', '17:00:00'),
(5, 2, 4, '09:00:00', '12:00:00'),
(6, 2, 4, '14:00:00', '17:00:00'),
(7, 2, 6, '09:00:00', '12:00:00'),
(8, 2, 6, '14:00:00', '17:00:00'),
(9, 20, 1, '14:00:00', '17:00:00'),
(10, 20, 3, '14:00:00', '17:00:00'),
(11, 20, 5, '09:00:00', '12:00:00'),
(12, 20, 5, '14:00:00', '17:00:00'),
(13, 20, 6, '09:00:00', '12:00:00'),
(14, 20, 6, '14:00:00', '17:00:00'),
(26, 16, 6, '14:00:00', '17:00:00'),
(25, 16, 6, '09:00:00', '12:00:00'),
(24, 16, 5, '14:00:00', '17:00:00'),
(23, 16, 5, '09:00:00', '12:00:00'),
(22, 16, 3, '14:00:00', '17:00:00'),
(21, 16, 1, '14:00:00', '17:00:00'),
(27, 19, 2, '14:00:00', '17:00:00'),
(28, 19, 4, '14:00:00', '17:00:00'),
(29, 19, 5, '09:00:00', '12:00:00'),
(30, 19, 5, '14:00:00', '17:00:00'),
(31, 19, 6, '09:00:00', '12:00:00'),
(32, 19, 6, '14:00:00', '17:00:00'),
(50, 22, 6, '14:00:00', '17:00:00'),
(49, 22, 6, '09:00:00', '12:00:00'),
(48, 22, 5, '14:00:00', '17:00:00'),
(47, 22, 5, '09:00:00', '12:00:00'),
(46, 22, 1, '14:00:00', '17:00:00'),
(45, 22, 1, '09:00:00', '12:00:00'),
(39, 21, 2, '14:00:00', '17:00:00'),
(40, 21, 3, '14:00:00', '17:00:00'),
(41, 21, 4, '09:00:00', '12:00:00'),
(42, 21, 4, '14:00:00', '17:00:00'),
(43, 21, 5, '09:00:00', '12:00:00'),
(44, 21, 5, '14:00:00', '17:00:00'),
(51, 23, 2, '14:00:00', '17:00:00'),
(52, 23, 3, '14:00:00', '17:00:00'),
(53, 23, 4, '09:00:00', '12:00:00'),
(54, 23, 4, '14:00:00', '17:00:00'),
(55, 23, 7, '09:00:00', '12:00:00'),
(56, 23, 7, '14:00:00', '17:00:00'),
(57, 1, 1, '14:00:00', '17:00:00'),
(58, 1, 3, '14:00:00', '17:00:00'),
(59, 1, 5, '09:00:00', '12:00:00'),
(60, 1, 5, '14:00:00', '17:00:00'),
(61, 1, 6, '09:00:00', '12:00:00'),
(62, 1, 6, '14:00:00', '17:00:00'),
(63, 15, 3, '14:00:00', '17:00:00'),
(64, 15, 4, '14:00:00', '17:00:00'),
(65, 15, 7, '09:00:00', '12:00:00'),
(66, 15, 7, '14:00:00', '17:00:00'),
(67, 15, 1, '09:00:00', '12:00:00'),
(68, 15, 1, '14:00:00', '17:00:00'),
(69, 17, 3, '14:00:00', '17:00:00'),
(70, 17, 4, '14:00:00', '17:00:00'),
(71, 17, 2, '09:00:00', '12:00:00'),
(72, 17, 2, '14:00:00', '17:00:00'),
(73, 17, 1, '09:00:00', '12:00:00'),
(74, 17, 1, '14:00:00', '17:00:00'),
(75, 18, 3, '14:00:00', '17:00:00'),
(76, 18, 4, '14:00:00', '17:00:00'),
(77, 18, 2, '09:00:00', '12:00:00'),
(78, 18, 2, '14:00:00', '17:00:00'),
(79, 18, 5, '09:00:00', '12:00:00'),
(80, 18, 7, '14:00:00', '17:00:00'),
(81, 24, 1, '20:00:00', '23:00:00'),
(82, 24, 2, '21:00:00', '22:30:00'),
(83, 24, 3, '14:00:00', '17:00:00'),
(84, 24, 4, '05:00:00', '08:00:00'),
(85, 24, 5, '06:00:00', '09:00:00'),
(86, 24, 6, '07:00:00', '10:00:00'),
(87, 24, 7, '17:00:00', '19:00:00'),
(88, 25, 1, '00:00:00', '20:00:00'),
(89, 25, 2, '01:20:00', '20:00:00'),
(90, 25, 3, '17:00:00', '19:00:00'),
(91, 25, 4, '15:00:00', '17:00:00'),
(92, 25, 5, '15:00:00', '08:00:00'),
(93, 25, 6, '09:00:00', '12:00:00'),
(94, 25, 7, '09:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `horaires_salle`
--

DROP TABLE IF EXISTS `horaires_salle`;
CREATE TABLE IF NOT EXISTS `horaires_salle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour` varchar(20) NOT NULL,
  `heure_ouverture` time NOT NULL,
  `heure_fermeture` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `horaires_salle`
--

INSERT INTO `horaires_salle` (`id`, `jour`, `heure_ouverture`, `heure_fermeture`) VALUES
(1, 'Lundi', '08:00:00', '22:00:00'),
(2, 'Mardi', '08:00:00', '22:00:00'),
(3, 'Mercredi', '08:00:00', '22:00:00'),
(4, 'Jeudi', '08:00:00', '22:00:00'),
(5, 'Vendredi', '08:00:00', '22:00:00'),
(6, 'Samedi', '09:00:00', '20:00:00'),
(7, 'Dimanche', '09:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `expediteur_id` int DEFAULT NULL,
  `destinataire_id` int DEFAULT NULL,
  `contenu` text NOT NULL,
  `date_heure` datetime DEFAULT CURRENT_TIMESTAMP,
  `type_message` enum('texte','audio','video','courriel') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expediteur_id` (`expediteur_id`),
  KEY `destinataire_id` (`destinataire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE IF NOT EXISTS `rendez_vous` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `coach_id` int DEFAULT NULL,
  `date_heure` datetime NOT NULL,
  `statut` enum('confirmé','annulé') DEFAULT 'confirmé',
  `digicode` varchar(255) DEFAULT '1234',
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `coach_id` (`coach_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `utilisateur_id`, `coach_id`, `date_heure`, `statut`, `digicode`) VALUES
(45, 1, 20, '2024-06-03 14:00:00', 'annulé', '1234'),
(46, 1, 15, '2024-06-03 09:00:00', 'annulé', '1234'),
(47, 1, 18, '2024-06-04 09:00:00', 'annulé', '1234'),
(48, 1, 20, '2024-05-29 14:00:00', 'annulé', '1234'),
(49, 1, 2, '2024-05-29 14:00:00', 'annulé', '1234'),
(50, 1, 20, '2024-05-31 14:00:00', 'annulé', '1234'),
(51, 1, 22, '2024-06-03 09:00:00', 'annulé', '1234'),
(52, 1, 22, '2024-06-03 09:00:00', 'annulé', '1234'),
(53, 22, 20, '2024-05-31 09:00:00', 'annulé', '1234'),
(54, 22, 20, '2024-05-31 14:00:00', 'annulé', '1234'),
(55, 22, 20, '2024-06-01 09:00:00', 'annulé', '1234'),
(56, 22, 19, '2024-05-31 14:00:00', 'annulé', '1234'),
(57, 22, 20, '2024-06-05 14:00:00', 'annulé', '1234'),
(58, 22, 19, '2024-05-31 14:00:00', 'annulé', '1234'),
(59, 22, 16, '2024-05-31 14:00:00', 'annulé', '1234'),
(60, 22, 1, '2024-06-03 14:00:00', 'annulé', '1234'),
(61, 3, 1, '2024-05-31 09:00:00', 'annulé', '1234'),
(62, 18, 20, '2024-06-05 14:00:00', 'confirmé', '1234'),
(63, 22, 2, '2024-06-06 09:00:00', 'annulé', '1234'),
(64, 22, 1, '2024-06-03 14:00:00', 'confirmé', '1234'),
(65, 22, 25, '2024-06-04 01:20:00', 'annulé', '1234'),
(66, 22, 25, '2024-06-07 15:00:00', 'annulé', '1234');

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

DROP TABLE IF EXISTS `salles`;
CREATE TABLE IF NOT EXISTS `salles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`id`, `nom`, `description`, `adresse`, `telephone`, `email`) VALUES
(1, 'Salle de Sport Omnes', 'La salle de sport Omnes est équipée des dernières technologies en matière d’équipements sportifs et offre une variété de cours et d’entraînements pour tous les niveaux.', '123 Rue Principale, 75001 Paris', '01 23 45 67 89', 'contact@omnes.sport');

-- --------------------------------------------------------

--
-- Structure de la table `sports_competition`
--

DROP TABLE IF EXISTS `sports_competition`;
CREATE TABLE IF NOT EXISTS `sports_competition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `lieu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sports_competition`
--

INSERT INTO `sports_competition` (`id`, `nom`, `description`, `lieu`) VALUES
(3, 'Basketball', 'Sport de compétition en équipe où l\'objectif est de marquer des points en lançant un ballon dans le panier adverse.', 'Stade Suzanne Lenglen'),
(4, 'Football', 'Sport de compétition en équipe où l\'objectif est de marquer des buts en envoyant un ballon dans le but adverse.', 'Stade Suzanne Lenglen'),
(5, 'Rugby', 'Sport de compétition en équipe caractérisé par des contacts physiques intenses et l\'objectif de marquer des essais.', 'Stade Suzanne Lenglen'),
(6, 'Tennis', 'Sport de raquette joué en simple ou en double avec l\'objectif de marquer des points en frappant une balle dans le terrain adverse.', 'Stade Suzanne Lenglen'),
(7, 'Natation', 'Sport individuel ou en équipe consistant à nager sur différentes distances et styles.', 'Stade Suzanne Lenglen'),
(8, 'Plongeon', 'Sport individuel où l\'objectif est de plonger dans une piscine depuis une plateforme ou un tremplin en réalisant des figures acrobatiques.', 'Stade Suzanne Lenglen');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_heure` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('validé','échoué') DEFAULT 'validé',
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `type_utilisateur` enum('administrateur','coach','client') NOT NULL,
  `carte_etudiante` varchar(20) DEFAULT NULL,
  `informations_paiement` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `adresse`, `telephone`, `type_utilisateur`, `carte_etudiante`, `informations_paiement`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'motdepasse1', '123 Rue Principale', '0102030405', 'client', 'ET12345', '{}'),
(2, 'Martin', 'Sophie', 'sophie.martin@example.com', 'motdepasse2', '456 Rue Secondaire', '0607080910', 'client', 'ET67890', '{}'),
(3, 'Leroy', 'Paul', 'paul.leroy@example.com', 'motdepasse3', '789 Rue Tertiaire', '0112233445', 'coach', NULL, '{}'),
(4, 'Bernard', 'Marie', 'marie.bernard@example.com', 'motdepasse4', '101 Rue Quaternaire', '0666778899', 'coach', NULL, '{}'),
(5, 'Durand', 'Jean', 'jean.durand@fitness.com', 'password1', '123 Rue de la Santé, Paris', '0102030405', 'coach', NULL, NULL),
(6, 'Martin', 'Sophie', 'sophie.martin@biking.com', 'password2', '456 Avenue des Sports, Lyon', '0607080910', 'coach', NULL, NULL),
(7, 'Dupont', 'Luc', 'luc.dupont@cardio.com', 'password3', '789 Boulevard du Cardio, Marseille', '0203040506', 'coach', NULL, NULL),
(8, 'Bernard', 'Emma', 'emma.bernard@collectif.com', 'password4', '1011 Chemin des Cours, Toulouse', '0708091011', 'coach', NULL, NULL),
(17, 'Lefevre', 'Thomas', 'thomas.lefevre@basket.com', 'password5', '123 Rue du Basket, Paris', '0102030405', 'coach', NULL, NULL),
(18, 'Moreau', 'Julie', 'julie.moreau@foot.com', 'password6', '456 Rue du Foot, Lyon', '0607080910', 'coach', NULL, NULL),
(19, 'Petit', 'Marc', 'marc.petit@rugby.com', 'password7', '789 Rue du Rugby, Marseille', '0203040506', 'coach', NULL, NULL),
(20, 'Durant', 'Claire', 'claire.durant@natation.com', 'password8', '1011 Rue de la Natation, Toulouse', '0708091011', 'coach', NULL, NULL),
(21, 'Lemoine', 'Nicolas', 'nicolas.lemoine@plongeon.com', 'password9', '1213 Rue du Plongeon, Nice', '0809101112', 'coach', NULL, NULL),
(22, 'Perreaut', 'Arthur', 'perreaut.arthur@gmail.com', '123456', '49 bd de strasbourg', '0670032417', 'administrateur', NULL, NULL),
(23, 'Klein', 'Paul', 'kpaul@caca.com', '123', '5 avenue du ziizi', '0625487963', 'client', '', NULL),
(25, 'Ponsonnet', 'Laurence', 'laurenceponsonnet94@gmail.com', '123', NULL, NULL, 'coach', NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `coachs`
--
ALTER TABLE `coachs`
  ADD CONSTRAINT `coachs_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `coachs_activites`
--
ALTER TABLE `coachs_activites`
  ADD CONSTRAINT `coachs_activites_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coachs` (`id`),
  ADD CONSTRAINT `coachs_activites_ibfk_2` FOREIGN KEY (`activite_id`) REFERENCES `activites_sportives` (`id`);

--
-- Contraintes pour la table `coachs_sports`
--
ALTER TABLE `coachs_sports`
  ADD CONSTRAINT `coachs_sports_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coachs` (`id`),
  ADD CONSTRAINT `coachs_sports_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sports_competition` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`expediteur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`destinataire_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `rendez_vous_ibfk_2` FOREIGN KEY (`coach_id`) REFERENCES `coachs` (`id`);

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
