-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 07 mars 2025 à 11:08
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
-- Base de données : `hackatest2`
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
(3, 'Chantier A', 'Paris', 'Construction d\'un immeuble résidentiel', 'En cours', '2025-04-01 08:00:00', '2025-12-31 18:00:00'),
(4, 'Chantier B', 'Lyon', 'Rénovation d\'un bâtiment historique', 'Planifié', '2025-05-15 09:00:00', '2025-11-30 17:00:00'),
(6, 'Chantier C', 'Lagny', 'Rénovation d\'un bâtiment historique', 'En cours', '2025-03-06 15:27:00', '2025-03-28 15:27:00');

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
('DoctrineMigrations\\Version20250306100321', '2025-03-06 10:47:39', 97),
('DoctrineMigrations\\Version20250306104150', '2025-03-06 10:51:19', 1);

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
(1, 'Plombier'),
(2, 'Électricien'),
(3, 'Menuisier'),
(4, 'Peintre'),
(5, 'Charpentier');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `skillid_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `skillid_id`, `email`, `roles`, `password`, `first_name`, `last_name`, `phone`) VALUES
(1, 1, 'm.harre@ecole-ipssi.net', '[\"ROLE_ADMIN\"]', '$2y$13$jWZvXcjfyORzeSKy0fGkq.xTRiU20GWBzghttCutv8DGcx7kHn2nC', 'Morgane', 'HARRE', 651934544),
(5, 3, 'r8f8el.77400@gmail.com', '[\"ROLE_USER\"]', '$2y$13$rWaYYbm3al4Yn.BYw3THQOtByNCEs67YcjTu6249X33hthay93Zei', 'Rafael', 'Salgado', 612345678),
(6, 3, 'portugal@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$WQXOLWmKYPCHCydDuUQaIubxzwKTtN.X9T4WpNYCTPF4v5Tku1u2i', 'port', 'ugal', 612345678);

-- --------------------------------------------------------

--
-- Structure de la table `user_chantier`
--

CREATE TABLE `user_chantier` (
  `id` int(11) NOT NULL,
  `userid_id` int(11) DEFAULT NULL,
  `chantierid_id` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `end_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_chantier`
--

INSERT INTO `user_chantier` (`id`, `userid_id`, `chantierid_id`, `start_date`, `end_date`) VALUES
(2, 1, 4, '2025-05-15 09:00:00', '2025-11-30 17:00:00'),
(5, 1, 6, '2025-04-03 10:18:00', '2025-04-20 10:18:00'),
(6, 5, 3, '2025-03-05 10:23:00', '2025-03-22 10:23:00'),
(8, 6, 6, '2025-03-07 11:04:00', '2025-03-15 11:04:00');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_83E2C3F658E0A285` (`userid_id`),
  ADD KEY `IDX_83E2C3F6888E1854` (`chantierid_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chantier`
--
ALTER TABLE `chantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user_chantier`
--
ALTER TABLE `user_chantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
