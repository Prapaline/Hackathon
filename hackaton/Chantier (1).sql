-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 04 mars 2025 à 16:57
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `btp_ipssi2`
--

-- --------------------------------------------------------

--
-- Structure de la table `chantier`
--

CREATE TABLE `chantier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `end_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chantier`
--

INSERT INTO `chantier` (`id`, `name`, `location`, `description`, `status`, `start_date`, `end_date`) VALUES
(1, 'Construction d\'un immeuble', 'Paris', 'Construction d\'un immeuble résidentiel de 10 étages.', 'En cours', '2025-01-10 08:00:00', '2025-12-31 18:00:00'),
(2, 'Rénovation d\'une école', 'Lyon', 'Rénovation complète de l\'école primaire St-Exupéry.', 'Terminé', '2024-05-01 08:00:00', '2024-11-01 18:00:00'),
(3, 'Extension d\'un hôpital', 'Marseille', 'Extension des infrastructures de l\'hôpital La Timone.', 'En cours', '2025-02-01 08:00:00', '2025-10-30 18:00:00'),
(4, 'Rénovation d\'un bâtiment historique', 'Bordeaux', 'Rénovation de la bibliothèque historique de Bordeaux.', 'Planifié', '2025-05-01 08:00:00', '2026-03-01 18:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chantier`
--
ALTER TABLE `chantier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chantier`
--
ALTER TABLE `chantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
