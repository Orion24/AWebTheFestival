-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 18 Décembre 2015 à 11:26
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `festival`
--
CREATE DATABASE IF NOT EXISTS `festival` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `festival`;

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `idArtist` int(11) NOT NULL AUTO_INCREMENT,
  `nameArtist` varchar(25) CHARACTER SET latin1 NOT NULL,
  `bio` varchar(400) CHARACTER SET latin1 NOT NULL,
  `magicCookieYoutube` varchar(12) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idArtist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idSchedule` int(11) NOT NULL,
  `idArtist` int(11) NOT NULL,
  `dateCommentaire` date NOT NULL,
  `content` varchar(200) CHARACTER SET latin1 NOT NULL,
  `isArtist` int(1) NOT NULL,
  `isValid` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idComment`),
  KEY `idUser` (`idUser`,`idSchedule`,`idArtist`),
  KEY `idSchedule` (`idSchedule`),
  KEY `idArtist` (`idArtist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `idSchedule` int(11) NOT NULL AUTO_INCREMENT,
  `dateJour` date NOT NULL,
  `heureDebut` date NOT NULL,
  `heureFin` date NOT NULL,
  `idArtist` int(11) NOT NULL,
  PRIMARY KEY (`idSchedule`),
  KEY `FK_SCHEDULE_idArtist` (`idArtist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) CHARACTER SET latin1 NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 NOT NULL,
  `isAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_SCHEDULE_idArtist` FOREIGN KEY (`idArtist`) REFERENCES `artists` (`idArtist`);
  
GRANT USAGE ON *.* TO 'userFestival'@'127.0.0.1' IDENTIFIED BY PASSWORD '*0B74FCD1F359F2F247F1C098F33235DEB4ECB20A';

GRANT SELECT, INSERT, UPDATE, DELETE ON `festival`.* TO 'userFestival'@'127.0.0.1';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
