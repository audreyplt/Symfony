-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 26 jan. 2020 à 21:19
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mi16`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visuel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `visuel`, `texte`) VALUES
(1, 'Fruits', 'images/fruits.jpg', 'De la passion ou de ton imagination'),
(2, 'Junk Food', 'images/junk_food.jpg', 'Chère et cancérogène, tu es prévenu(e)'),
(3, 'Légumes', 'images/legumes.jpg', 'Plus tu en manges, moins tu en es un');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usager_id` int(11) DEFAULT NULL,
  `date_commande` datetime NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67D4F36F0FC` (`usager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `usager_id`, `date_commande`, `statut`) VALUES
(17, 8, '2020-01-26 18:08:16', 'en attente'),
(18, 8, '2020-01-26 18:08:33', 'en attente'),
(19, 7, '2020-01-26 18:09:39', 'en attente'),
(20, 8, '2020-01-26 18:25:59', 'en attente');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

DROP TABLE IF EXISTS `ligne_commande`;
CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `commandes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3170B74BF347EFB` (`produit_id`),
  KEY `IDX_3170B74B8BF5C2E6` (`commandes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`id`, `quantite`, `prix`, `produit_id`, `commandes_id`) VALUES
(17, 3, 3.42, 1, 17),
(18, 4, 8.25, 8, 17),
(19, 2, 1.7, 5, 18),
(20, 2, 2.5, 9, 19),
(21, 4, 2.5, 9, 20);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191220143540', '2019-12-20 14:35:49'),
('20191220143645', '2019-12-20 14:36:50'),
('20200113181433', '2020-01-13 18:16:37'),
('20200115103950', '2020-01-15 10:41:11'),
('20200115105215', '2020-01-15 10:52:23'),
('20200116082436', '2020-01-16 08:24:52'),
('20200126174953', '2020-01-26 17:50:06');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visuel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `categorie_id`, `libelle`, `texte`, `visuel`, `prix`) VALUES
(1, 1, 'Pomme', 'Elle est bonne pour la tienne', 'images/pommes.jpg', '3.42'),
(2, 1, 'Poire', 'Ici tu n\'en es pas une', 'images/poires.jpg', '2.11'),
(3, 1, 'Pêche', 'Elle va te la donner', 'images/peche.jpg', '2.84'),
(4, 3, 'Carotte', 'C\'est bon pour ta vue', 'images/carottes.jpg', '2.90'),
(5, 3, 'Tomate', 'Fruit ou Légume ? Légume', 'images/tomates.jpg', '1.70'),
(6, 3, 'Chou Romanesco', 'Mange des fractales', 'images/romanesco.jpg', '1.81'),
(7, 2, 'Nutella', 'C\'est bon, sauf pour ta santé', 'images/nutella.jpg', '4.50'),
(8, 2, 'Pizza', 'Y\'a pas pire que za', 'images/pizza.jpg', '8.25'),
(9, 2, 'Oreo', 'Seulement si tu es un smartphone', 'images/oreo.jpg', '2.50');

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3CDC65FFE7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;;

--
-- Déchargement des données de la table `usager`
--

INSERT INTO `usager` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(7, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$12$kzHnHFx20rdcz8ASfEg.x.Eoj8/mFsjMUxDFwSrbkmT7Y/d8xQw9i', 'admin', 'admin'),
(8, 'bab38prapant@hotmail.fr', '[\"ROLE_CLIENT\"]', '$2y$12$CITGyDxfxOQthaDDyDIHWeO2daIOhcNdauZwnddQ6b7nrsUakM.1m', 'bab', 'bab'),
(9, 'test@gmail.com', '[\"ROLE_CLIENT\"]', '$2y$12$Y3Ji5mYfXyY4f/.A51ROgu1tvW0905Kx9CUzOWTt6IN7DptIq8bJq', 'test', 'test');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D4F36F0FC` FOREIGN KEY (`usager_id`) REFERENCES `usager` (`id`);

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `FK_3170B74B8BF5C2E6` FOREIGN KEY (`commandes_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_3170B74BF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
