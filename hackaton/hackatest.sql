-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 mars 2025 à 11:35
-- Version du serveur : 11.1.2-MariaDB
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hackatest`
--

-- --------------------------------------------------------

--
-- Structure de la table `chantier`
--

DROP TABLE IF EXISTS `chantier`;
CREATE TABLE IF NOT EXISTS `chantier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `end_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chantier`
--

INSERT INTO `chantier` (`id`, `name`, `location`, `description`, `status`, `start_date`, `end_date`) VALUES
(1, 'test', 'Paris', 'testetest', 'en cours', '2025-03-06 08:00:00', '2025-06-01 17:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250304133538', '2025-03-04 13:35:57', 220),
('DoctrineMigrations\\Version20250304153143', '2025-03-04 15:33:02', 62),
('DoctrineMigrations\\Version20250304202646', '2025-03-04 20:28:24', 81),
('DoctrineMigrations\\Version20250304205307', '2025-03-04 20:53:23', 44),
('DoctrineMigrations\\Version20250304212501', '2025-03-04 21:25:16', 53),
('DoctrineMigrations\\Version20250304212824', '2025-03-04 21:28:33', 32),
('DoctrineMigrations\\Version20250304213025', '2025-03-04 21:30:31', 22),
('DoctrineMigrations\\Version20250304213800', '2025-03-04 21:38:06', 11),
('DoctrineMigrations\\Version20250304214543', '2025-03-04 21:45:49', 40);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `name`) VALUES
(1, 'Plombier'),
(2, 'Inspecteur de travaux');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skillid_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  KEY `IDX_8D93D649652072FE` (`skillid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `skillid_id`, `email`, `roles`, `password`, `first_name`, `last_name`, `phone`) VALUES
(1, 1, 'm.harre@ecole-ipssi.net', '[]', '$2y$13$jWZvXcjfyORzeSKy0fGkq.xTRiU20GWBzghttCutv8DGcx7kHn2nC', 'Morgane', 'HARRE', 651934544);

-- --------------------------------------------------------

--
-- Structure de la table `user_chantier`
--

DROP TABLE IF EXISTS `user_chantier`;
CREATE TABLE IF NOT EXISTS `user_chantier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `end_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `userid_id` int(11) DEFAULT NULL,
  `chantierid_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_83E2C3F658E0A285` (`userid_id`),
  KEY `IDX_83E2C3F6888E1854` (`chantierid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_chantier`
--

INSERT INTO `user_chantier` (`id`, `start_date`, `end_date`, `userid_id`, `chantierid_id`) VALUES
(1, '2025-03-01 08:00:00', '2025-06-01 17:00:00', 1, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649652072FE` FOREIGN KEY (`skillid_id`) REFERENCES `skill` (`id`);

--
-- Contraintes pour la table `user_chantier`
--
ALTER TABLE `user_chantier`
  ADD CONSTRAINT `FK_83E2C3F658E0A285` FOREIGN KEY (`userid_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_83E2C3F6888E1854` FOREIGN KEY (`chantierid_id`) REFERENCES `chantier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
