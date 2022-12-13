-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 déc. 2022 à 16:18
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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `auction`
--

INSERT INTO `auction` (`auction_id`, `start_price`, `reserve_price`, `current_bid`, `start_time`, `duration_id`, `end_time`, `viewings`, `win_confirmed`, `item_id`, `user_id`, `type`) VALUES
(26, '15.00', '30.00', '15.00', '2022-12-13 15:27:08', 5, '2022-12-23 15:27:08', 3, 0, 29, 1, 1),
(25, '30.00', '50.00', '30.00', '2022-12-13 15:25:38', 5, '2022-12-23 15:25:38', 0, 0, 28, 1, 1),
(24, '4.00', '7.00', '4.00', '2022-12-13 15:17:25', 5, '2022-12-23 15:17:25', 1, 0, 27, 1, 1),
(23, '5.00', '12.00', '5.00', '2022-12-13 15:16:04', 5, '2022-12-23 15:16:04', 1, 0, 26, 1, 1),
(22, '60.00', '85.00', '60.00', '2022-12-13 15:14:29', 5, '2022-12-23 15:14:29', 5, 0, 25, 1, 1),
(21, '6.00', '10.00', '6.00', '2022-12-13 15:11:50', 5, '2022-12-23 15:11:50', 0, 0, 24, 1, 1),
(20, '10.00', '20.00', '10.00', '2022-12-13 15:10:20', 5, '2022-12-23 15:10:20', 4, 0, 23, 1, 1),
(19, '42.00', '50.00', '42.00', '2022-12-13 15:09:25', 5, '2022-12-23 15:09:25', 1, 0, 22, 1, 1),
(18, '80.00', '120.00', '80.00', '2022-12-13 15:07:27', 5, '2022-12-23 15:07:27', 0, 0, 21, 1, 1),
(17, '206000.00', '215000.00', '206000.00', '2022-12-13 15:05:41', 5, '2022-12-23 15:05:41', 0, 0, 20, 1, 1),
(16, '950.00', '1080.00', '950.00', '2022-12-13 14:54:53', 5, '2022-12-23 14:54:53', 1, 0, 19, 1, 1),
(15, '35000.00', '45000.00', '35000.00', '2022-12-13 14:53:30', 5, '2022-12-23 14:53:30', 9, 0, 18, 1, 1),
(14, '10.00', '15.00', '13.00', '2022-12-13 14:51:10', 5, '2022-12-23 14:51:10', 5, 0, 17, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `bids`
--

INSERT INTO `bids` (`bid_id`, `user_id`, `auction_id`, `bid_price`, `bid_time`) VALUES
(1, 2, 1, '60.00', '2022-11-19 15:08:18'),
(2, 2, 1, '80.00', '2022-11-19 15:08:55'),
(3, 2, 1, '90.00', '2022-11-19 15:20:06'),
(4, 2, 1, '91.00', '2022-11-19 15:32:25'),
(5, 2, 3, '25.00', '2022-11-21 16:37:26'),
(6, 2, 14, '13.00', '2022-12-13 16:18:03');

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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`item_id`, `item_picture`, `label`, `description`, `state_id`, `category_id`) VALUES
(17, 'uploads/item/121322-141210_71zfiinJ7sL._SL1117_.jpg', 'Slipknot - IOWA', '9 Men, 9 Masks, Maximum insanity with NO safety net! AWESOME artwork to boot!!!', 1, 22),
(18, 'uploads/item/121322-141230_montre rolex.jpg', 'Rolex', 'Montre trop cher pour rien', 1, 20),
(19, 'uploads/item/121322-141253_120322-161233_pcgamer.jpg', 'PC Gamer', 'PC de jeu:\r\nAMD Ryzen 5 3600 6x 4,2 GHz\r\n16 Go de mémoire RAM DDR4 PC-3000\r\nNvidia GeForce RTX3060 12 Go\r\nDisque dur SSD NVME M.2 de 500 Go\r\nWindows 10 Professionnel\r\n7.1 Son / LAN Gigabit', 1, 11),
(20, 'uploads/item/121322-151241_120322-161205_ferrari.jpg', 'Ferrari SP48 Unica', 'Voiture pas cher du tout', 2, 7),
(21, 'uploads/item/121322-151227_120322-161215_theweeknd concert.jpeg', 'Concert de TheWeeknd', 'Concert de l\'artiste mondialement connu à Paris', 1, 15),
(22, 'uploads/item/121322-151225_81xiXPG6YgL._SX425_.jpg', 'The End, So Far', 'The End, So Far Vinyle ', 2, 22),
(23, 'uploads/item/121322-151220_71LCcXgubpL._AC_SX425_.jpg', 'KALINCO Montre Connectée', '【Moniteur de la Santé】Faire toujours attention à votre santé physique et mentale, le capteur de mouvement haute performance intégré surveille et détecte automatiquement votre fréquence cardiaque en temps réel, pression artérielle, l\'oxygène sanguin et vot', 3, 20),
(24, 'uploads/item/121322-151250_51-1xJGYBYL._AC_SX679_.jpg', 'Anigaduo 25W USB C', 'Compatibilité Universelle : USBC chargeur avec câble de 2 m pour iPhone 14/14 Plus/14 Pro/14 Pro Max/13/13 Mini/13 Pro/13 Pro Max/12/12 Mini/12 Pro/12 Pro Max 11 SE 2022/2020, XR, XS, XS MAX, 8, 8 Plus, Pad Pro, Airpods Pro.\r\nSafety: 25W USB C Chargeur se', 1, 11),
(25, 'uploads/item/121322-151229_71DGPi4MOdL._AC_SX425_.jpg', 'Govee Barre LED Smart', 'Nouveau Plaisir Visuel : Les barres lumineuses peuvent être facilement synchronisées avec les couleurs et les sons de votre écran de télévision. Vos expériences de jeu, de cinéma et de musique seront améliorées avec un éclairage vibrant, 16 millions de co', 1, 11),
(26, 'uploads/item/121322-151204_91625EDAA7L._AC_SY445_.jpg', 'Black Widow', 'Black Widow, 1 Blu-ray, 133 minutes\r\n\r\nSynopsis\r\nNatasha Romanoff, alias Black Widow, voit resurgir la part la plus sombre de son passé pour faire face à une redoutable conspiration liée à sa vie d\'autrefois. Poursuivie par une force qui ne reculera devan', 3, 14),
(27, 'uploads/item/121322-151225_61iYFNhtwHL._AC_SX679_.jpg', ' Verre Trempé pour iPhone 11', 'Pack de 2 Verre Trempé iPhone 11, iPhone XR, Très grande dureté: résiste aux égratignures jusqu\'à 9H (plus dur qu\'un couteau). Haute-réponse et une grande transparence.\r\n⚠ NON COMPATIBLE: iPhone 11 Pro, 11 Pro Max, iPhone X, XS, XS Max\r\nOléophobe: il a un', 2, 21),
(28, 'uploads/item/121322-151238_51odlNdMNyL._AC_SX425_.jpg', 'Tefal Emotion Poêle 28 cm', 'SAISIE PARFAITE : poêle inox non revêtue pour de délicieuses viandes et légumes saisis, idéale pour déglacer et réaliser de savoureux jus et sauces\r\nGARANTIE 10 ANS : poêle de qualité supérieure, de conception sûre et robuste, sans risque de détérioration', 2, 25),
(29, 'uploads/item/121322-151208_s-l500.jpg', 'ANCIENNE LAMPE INDUSTRIELLE ARTICULÉE VINTAGE', 'ANCIENNE LAMPE INDUSTRIELLE ARTICULÉ VINTAGE \r\nETAT OCCASION VOIR LES PHOTOS \r\nCOLIS MONDIAL RELAY ', 5, 5);

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
(1, 'GabGabS', '356a192b7913b04c54574d18c28d46e6395428ab', 'uploads/profile/031116-120348_image_bceabb1299.jpg', 'Gaby', 'Lst', 'gabriel.lessert@edu.ece.fr', '2001-12-02', 24, '4.96', 2),
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
(2, 1),
(2, 14);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
