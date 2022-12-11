-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 11 déc. 2022 à 17:26
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ebay_clone`
--

-- --------------------------------------------------------

--
-- Structure de la table `auction`
--

DROP TABLE IF EXISTS `auction`;
CREATE TABLE IF NOT EXISTS `auction` (
  `auction_id` int NOT NULL AUTO_INCREMENT,
  `start_price` decimal(8,2) NOT NULL,
  `reserve_price` decimal(8,2) NOT NULL,
  `current_bid` decimal(8,2) NOT NULL,
  `start_time` datetime NOT NULL,
  `duration_id` int NOT NULL,
  `end_time` datetime NOT NULL,
  `viewings` int NOT NULL DEFAULT '0',
  `win_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`auction_id`),
  KEY `Auction_Duration` (`duration_id`),
  KEY `Auction_Item` (`item_id`),
  KEY `Auction_Users` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `auction`
--

INSERT INTO `auction` (`auction_id`, `start_price`, `reserve_price`, `current_bid`, `start_time`, `duration_id`, `end_time`, `viewings`, `win_confirmed`, `item_id`, `user_id`, `type`) VALUES
(1, '10.00', '90.00', '91.00', '2022-11-19 15:02:42', 2, '2022-11-19 15:32:47', 11, 1, 1, 1, 1),
(2, '2.00', '10.00', '2.00', '2022-11-21 13:28:22', 2, '2022-11-24 13:28:22', 8, 0, 2, 1, 1),
(3, '20.00', '500.00', '25.00', '2022-11-21 13:30:07', 3, '2022-11-26 13:30:07', 6, 0, 3, 1, 1),
(4, '25.00', '600.00', '25.00', '2022-11-21 13:31:12', 3, '2022-11-26 13:31:12', 3, 0, 4, 1, 1),
(6, '400000.00', '450000.00', '400000.00', '2022-12-03 16:05:05', 5, '2022-12-13 16:05:05', 13, 0, 6, 1, 1),
(7, '80.00', '250.00', '80.00', '2022-12-03 16:06:15', 5, '2022-12-13 16:06:15', 4, 0, 7, 1, 1),
(8, '10.00', '15.00', '10.00', '2022-12-03 16:07:15', 5, '2022-12-13 16:07:15', 0, 0, 8, 1, 1),
(9, '250.00', '300.00', '250.00', '2022-12-03 16:09:26', 5, '2022-12-13 16:09:26', 2, 0, 9, 1, 1),
(10, '135.00', '150.00', '135.00', '2022-12-03 16:12:36', 5, '2022-12-13 16:12:36', 0, 0, 10, 1, 1),
(11, '2549.00', '2570.00', '2549.00', '2022-12-03 16:18:56', 5, '2022-12-13 16:18:56', 2, 0, 11, 1, 1),
(12, '80.00', '90.00', '80.00', '2022-12-03 16:23:23', 5, '2022-12-13 16:23:23', 0, 0, 12, 1, 1),
(13, '11850.00', '12000.00', '11850.00', '2022-12-03 16:28:00', 5, '2022-12-13 16:28:00', 0, 0, 13, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `bid_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `auction_id` int NOT NULL,
  `bid_price` decimal(8,2) NOT NULL,
  `bid_time` datetime NOT NULL,
  PRIMARY KEY (`bid_id`),
  KEY `Auction_Bids` (`auction_id`),
  KEY `Users_Bids` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `bids`
--

INSERT INTO `bids` (`bid_id`, `user_id`, `auction_id`, `bid_price`, `bid_time`) VALUES
(1, 2, 1, '60.00', '2022-11-19 15:08:18'),
(2, 2, 1, '80.00', '2022-11-19 15:08:55'),
(3, 2, 1, '90.00', '2022-11-19 15:20:06'),
(4, 2, 1, '91.00', '2022-11-19 15:32:25'),
(5, 2, 3, '25.00', '2022-11-21 16:37:26');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(63) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Antiques'),
(2, 'Art'),
(3, 'Bébé'),
(4, 'Livre, BD & Magasines'),
(5, 'Bureautique'),
(6, 'Caméra & Photographie'),
(7, 'Véhicule'),
(8, 'Vêtement & Accessoire'),
(9, 'Pièce'),
(11, 'Informatique'),
(12, 'Artisanal'),
(13, 'Poupée'),
(14, 'Film/Série'),
(15, 'Concert'),
(16, 'Jardin'),
(17, 'Santé & Beauté'),
(18, 'Voyage & Vacances'),
(19, 'DIY'),
(20, 'Montre & Bijou'),
(21, 'Téléphone & Communication'),
(22, 'Musique'),
(24, 'Animaux'),
(25, 'Cuisine'),
(26, 'Son & Vision'),
(27, 'Sport'),
(28, 'Jeu & jouet'),
(35, 'Non répertorié ');

-- --------------------------------------------------------

--
-- Structure de la table `duration`
--

DROP TABLE IF EXISTS `duration`;
CREATE TABLE IF NOT EXISTS `duration` (
  `duration_id` int NOT NULL AUTO_INCREMENT,
  `duration` int NOT NULL,
  PRIMARY KEY (`duration_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `duration`
--

INSERT INTO `duration` (`duration_id`, `duration`) VALUES
(1, 1),
(2, 3),
(3, 5),
(4, 7),
(5, 10);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_picture` varchar(255) NOT NULL,
  `label` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `state_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `Category_Item` (`category_id`),
  KEY `Item_condition_id` (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`item_id`, `item_picture`, `label`, `description`, `state_id`, `category_id`) VALUES
(1, 'uploads/item/111922-151142_unnamed.jpg', 'yhhh', 'kjkjkj', 1, 8),
(3, 'uploads/item/112122-131107_TIPE-3 1.jpg', 'C\'est claire comme Claire', 'Livre nul', 1, 4),
(4, 'uploads/item/112122-131112_TIPE-2.jpg', 'Guillaume et ses amis', 'Le jeu trop trop mauvais quoi', 4, 31),
(6, 'uploads/item/120322-161205_ferrari.jpg', 'Ferrari SP48 Unica', 'Belle voiture italienne, le 0 à 100 en 2.3s', 1, 7),
(7, 'uploads/item/120322-161215_theweeknd concert.jpeg', 'The Weeknd concert', 'Un concert de qualité d\'un artiste mondialement connu (The Weeknd)', 1, 15),
(8, 'uploads/item/120322-161215_one piece.jpg', 'One piece dernier tome', 'Le dernier tome de one piece', 1, 4),
(10, 'uploads/item/120322-161236_nike air force1.jpg', 'Nike air force 1 ', 'Une paire de chaussure agréable et portable à n\'importe quel moment', 1, 8),
(11, 'uploads/item/120322-161256_pcgamer.jpg', 'PC de gaming Intel Core i7', 'Processeur : Intel Core i7-13700KF, 8x 3.40GHz + 8x 2.50GHz\r\ncarte mère : ASUS Prime Z690-A DDR5, S. 1700\r\nCarte Graphique : NVIDIA GeForce RTX 3070 Ti 8Go\r\nSystème d\'Exploitation : Windows 11 Home\r\nRAM : 16Go DDR5-6000 | ADATA XPG Lancer RGB\r\n', 1, 5),
(12, 'uploads/item/120322-161223_filet copaya.jpg', 'Filet de volley Copaya', 'Un filet de beach-volley qualitatif. Le sac est composÃ© du filet, des poteaux, des lignes et de tendeurs.', 1, 27),
(13, 'uploads/item/120322-161200_montre rolex.jpg', 'Montre DATEJUST 36 Rolex', 'Belle montre ROLEX ', 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `rating_value` int NOT NULL,
  PRIMARY KEY (`sender_id`,`receiver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`sender_id`, `receiver_id`, `rating_value`) VALUES
(2, 1, 4),
(1, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1, 'Client'),
(2, 'Vendeur'),
(0, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int NOT NULL AUTO_INCREMENT,
  `state` varchar(63) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `state`
--

INSERT INTO `state` (`state_id`, `state`) VALUES
(1, 'Neuf'),
(2, 'Comme neuf'),
(3, 'Très bon état'),
(4, 'Bon état'),
(5, 'Abîmé');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(31) NOT NULL,
  `passwd` varchar(40) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `first_name` varchar(31) NOT NULL,
  `last_name` varchar(31) NOT NULL,
  `email` varchar(63) NOT NULL,
  `birthdate` date NOT NULL,
  `rating_count` int NOT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `role_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `Users_Roles` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passwd`, `profile_picture`, `first_name`, `last_name`, `email`, `birthdate`, `rating_count`, `rating`, `role_id`) VALUES
(1, 'GabGabS', '356a192b7913b04c54574d18c28d46e6395428ab', 'uploads/profile/031116-120348_image_bceabb1299.jpg', 'Gaby', 'Lst', 'gaby@ece.fr', '2001-12-02', 24, '4.96', 2),
(2, 'Gabuyer', '356a192b7913b04c54574d18c28d46e6395428ab', 'uploads/profile/stock.jpg', 'Gaby', 'lacheteur', 'Craby@ece.fe', '2001-12-02', 1, '3.00', 1),
(3, 'admin', '356a192b7913b04c54574d18c28d46e6395428ab', 'uploads/profile/stock.jpg', 'Prenom', 'Nom', 'admin@ece.fr', '2001-12-02', 0, '0.00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `watch`
--

DROP TABLE IF EXISTS `watch`;
CREATE TABLE IF NOT EXISTS `watch` (
  `user_id` int NOT NULL,
  `auction_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`auction_id`),
  KEY `Watch_Auction` (`auction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `watch`
--

INSERT INTO `watch` (`user_id`, `auction_id`) VALUES
(2, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
