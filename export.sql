-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 14 oct. 2019 à 14:06
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ez_party`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `all_powers` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_admin`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event_needs`
--

DROP TABLE IF EXISTS `event_needs`;
CREATE TABLE IF NOT EXISTS `event_needs` (
  `event_needs_id` int(11) NOT NULL AUTO_INCREMENT,
  `need_name` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_needs_id`),
  KEY `event_needs_ibfk_1` (`event_id`),
  KEY `event_needs_ibfk_2` (`supplier_id`),
  KEY `event_needs_ibfk_3` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event_participants`
--

DROP TABLE IF EXISTS `event_participants`;
CREATE TABLE IF NOT EXISTS `event_participants` (
  `participants_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`participants_id`),
  KEY `event_participants_ibfk_1` (`event_id`),
  KEY `event_participants_ibfk_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event_plan`
--

DROP TABLE IF EXISTS `event_plan`;
CREATE TABLE IF NOT EXISTS `event_plan` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` mediumtext NOT NULL,
  `event_picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `city_address` varchar(255) NOT NULL,
  `zip_code_address` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `private` tinyint(1) NOT NULL,
  `mandatory_fees` tinyint(1) NOT NULL,
  `max_fees` decimal(10,0) DEFAULT NULL,
  `mandatory_needs` tinyint(1) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `event_plan_ibfk_1` (`creator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membership_fees`
--

DROP TABLE IF EXISTS `membership_fees`;
CREATE TABLE IF NOT EXISTS `membership_fees` (
  `membership_fees_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fees` decimal(10,0) NOT NULL,
  PRIMARY KEY (`membership_fees_id`),
  KEY `user_id` (`user_id`),
  KEY `membership_fees_ibfk_1` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `needs_category`
--

DROP TABLE IF EXISTS `needs_category`;
CREATE TABLE IF NOT EXISTS `needs_category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `needs_category`
--

INSERT INTO `needs_category` (`id_category`, `category_name`) VALUES
(2, 'Boisson/Alcool'),
(3, 'Matériel'),
(4, 'Décoration'),
(5, 'Nourriture'),
(6, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `participation_requests`
--

DROP TABLE IF EXISTS `participation_requests`;
CREATE TABLE IF NOT EXISTS `participation_requests` (
  `participation_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`participation_id`),
  KEY `user_id` (`user_id`),
  KEY `participation_requests_ibfk_1` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city_address` varchar(255) NOT NULL,
  `zip_code_address` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `event_needs`
--
ALTER TABLE `event_needs`
  ADD CONSTRAINT `event_needs_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_plan` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_needs_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `event_needs_ibfk_3` FOREIGN KEY (`category`) REFERENCES `needs_category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `event_participants`
--
ALTER TABLE `event_participants`
  ADD CONSTRAINT `event_participants_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_plan` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `event_plan`
--
ALTER TABLE `event_plan`
  ADD CONSTRAINT `event_plan_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `membership_fees`
--
ALTER TABLE `membership_fees`
  ADD CONSTRAINT `membership_fees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_plan` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membership_fees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `participation_requests`
--
ALTER TABLE `participation_requests`
  ADD CONSTRAINT `participation_requests_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_plan` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participation_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
