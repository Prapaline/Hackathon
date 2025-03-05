-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 05 mars 2025 à 09:49
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
(1, 'Construction d\'un immeuble', 'Paris', 'Construction d\'un immeuble résidentiel de 10 étages.', 'En cours', '2025-01-09 00:00:00', '2025-12-31 00:00:00'),
(2, 'Rénovation d\'une école', 'Lyon', 'Rénovation complète de l\'école primaire St-Exupéry.', 'Terminé', '2024-05-01 08:00:00', '2024-11-01 18:00:00'),
(3, 'Extension d\'un hôpital', 'Marseille', 'Extension des infrastructures de l\'hôpital La Timone.', 'En cours', '2025-02-01 08:00:00', '2025-10-30 18:00:00'),
(4, 'Rénovation d\'un bâtiment historique', 'Bordeaux', 'Rénovation de la bibliothèque historique de Bordeaux.', 'Planifié', '2025-05-01 08:00:00', '2026-03-01 18:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250304133538', '2025-03-04 14:58:26', 95);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `name`) VALUES
(1, 'Maçonnerie'),
(2, 'Électricité'),
(3, 'Plomberie'),
(4, 'Peinture'),
(5, 'Chef de Chantier'),
(6, 'Conducteur de Travaux'),
(7, 'Ingénieur BTP');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `skillid_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `skillid_id`, `email`, `roles`, `password`, `first_name`, `last_name`, `phone`) VALUES
(1, 1, 'paul.macon@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Paul', 'Durand', 123456789),
(2, 2, 'lucas.electricien@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Lucas', 'Lemoine', 123456790),
(3, 3, 'marie.plombiere@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Marie', 'Dupont', 123456791),
(4, 4, 'jean.peintre@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Jean', 'Martin', 123456792),
(5, 5, 'sophie.chefchantier@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Sophie', 'Lefevre', 123456793),
(6, 6, 'henri.conducteur@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Henri', 'Bernard', 123456794),
(7, 7, 'nicolas.ingenieur@example.com', '[\"ROLE_USER\"]', 'password_hash', 'Nicolas', 'Benoit', 123456795);

-- --------------------------------------------------------

--
-- Structure de la table `user_chantier`
--

CREATE TABLE `user_chantier` (
  `user_id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_chantier`
--

INSERT INTO `user_chantier` (`user_id`, `chantier_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chantier`
--
ALTER TABLE `chantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD KEY `IDX_8D93D649652072FE` (`skillid_id`);

--
-- Index pour la table `user_chantier`
--
ALTER TABLE `user_chantier`
  ADD PRIMARY KEY (`user_id`,`chantier_id`),
  ADD KEY `IDX_83E2C3F6A76ED395` (`user_id`),
  ADD KEY `IDX_83E2C3F6D0C0049D` (`chantier_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chantier`
--
ALTER TABLE `chantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `FK_83E2C3F6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_83E2C3F6D0C0049D` FOREIGN KEY (`chantier_id`) REFERENCES `chantier` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
