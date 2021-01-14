-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 jan. 2021 à 13:37
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `social-network`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `creation_date`, `user_id`, `posts_id`) VALUES
(1, 'aze', '2021-01-14 14:28:23', 10, 8),
(2, 'aze', '2021-01-14 14:28:24', 10, 8);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default_conv.png',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `hobbies`
--

DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE IF NOT EXISTS `hobbies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_hobby` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `hobbies`
--

INSERT INTO `hobbies` (`id`, `name_hobby`) VALUES
(1, 'jue vidéal');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `conversations_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `comments_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `content`, `creation_date`, `users_id`) VALUES
(1, '', '2020-12-15 12:10:43', 7),
(2, 'test', '2020-12-15 12:10:49', 7),
(3, 'test', '2020-12-15 12:11:11', 7),
(4, 'testons', '2020-12-15 14:05:56', 7),
(5, 'testons', '2020-12-15 14:07:54', 7),
(6, 'tester', '2020-12-15 14:07:58', 7),
(7, 'test', '2020-12-15 14:10:58', 8),
(8, 'nouveau test', '2020-12-15 14:11:03', 8);

-- --------------------------------------------------------

--
-- Structure de la table `reacts`
--

DROP TABLE IF EXISTS `reacts`;
CREATE TABLE IF NOT EXISTS `reacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `emoji` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `technologies`
--

DROP TABLE IF EXISTS `technologies`;
CREATE TABLE IF NOT EXISTS `technologies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_technology` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `technologies`
--

INSERT INTO `technologies` (`id`, `name_technology`) VALUES
(1, 'html'),
(2, 'PHP'),
(3, 'dd'),
(4, ''),
(5, 'c'),
(6, 'ffff'),
(7, 'ddddd'),
(8, 'dddddcc'),
(9, 'd'),
(10, 'zzz'),
(11, 'ddd'),
(12, 'dddd'),
(13, 'jjjjj'),
(14, 'rrrr'),
(15, 'eee'),
(16, 'ccc');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `picture_profil` varchar(255) DEFAULT 'default.png',
  `picture_cover` varchar(255) DEFAULT 'defaultcover.png',
  `date_birth` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `presentation` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `last_name`, `first_name`, `picture_profil`, `picture_cover`, `date_birth`, `password`, `presentation`) VALUES
(5, 'maxime.siegl@laplateforme.io', 'Maxime', 'Siegl', 'arthur.jpg', 'defaultcover.png', '1994-02-28', '$2y$10$s4ARRSsVIMaGPON7U0hJ0eDkS46DiJyWL6J91bC4R985qaiuM3Q6q', ''),
(7, 'cecile.wojnowski@laplateforme.io', 'Wojnowski', 'Cécile', 'default.png', 'defaultcover.png', '2020-12-17', '$2y$10$7qNQVuV.5OQeWByq/kgTSuiu1sLA9fnlBcHqnvHG1wtZgBaM5uw1e', ''),
(8, 'test.test@laplateforme.io', 'Test', 'Testeur', 'default.png', 'defaultcover.png', '2020-12-26', '$2y$10$T35stOlFpeCgxKrX8fe6keeLMngDYdSEpqdZ2WcMVV7Gp/wpbtcD6', ''),
(9, 'admin.admin@laplateforme.io', 'Admin', 'Admin', 'avatarfilm.png', 'defaultcover.png', '2020-12-01', '$2y$10$b.yy.X.qYwHGSn8S4kEvsuigeU7ZBATPjoMvcLFZuH4d9Y1qsKTvG', NULL),
(10, 'celine.pawlak@laplateforme.io', 'Pawlak', 'Céline', 'default.png', 'defaultcover.png', '1995-12-26', '$2y$10$pelMbS5P2je/Iz4j7uS3POpBfddEafEC2v6n38nXG.m2fOBeW44dy', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users_conversations`
--

DROP TABLE IF EXISTS `users_conversations`;
CREATE TABLE IF NOT EXISTS `users_conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `conversations_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users_hobbies`
--

DROP TABLE IF EXISTS `users_hobbies`;
CREATE TABLE IF NOT EXISTS `users_hobbies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `hobbies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_hobbies`
--

INSERT INTO `users_hobbies` (`id`, `users_id`, `hobbies_id`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users_reacts`
--

DROP TABLE IF EXISTS `users_reacts`;
CREATE TABLE IF NOT EXISTS `users_reacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `reacts_id` int(11) NOT NULL,
  `messages_id` int(11) DEFAULT NULL,
  `posts_id` int(11) DEFAULT NULL,
  `comments_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users_technologies`
--

DROP TABLE IF EXISTS `users_technologies`;
CREATE TABLE IF NOT EXISTS `users_technologies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `technologies_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_technologies`
--

INSERT INTO `users_technologies` (`id`, `users_id`, `technologies_id`) VALUES
(1, 5, 1),
(47, 8, 15),
(46, 8, 11),
(48, 8, 16);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
