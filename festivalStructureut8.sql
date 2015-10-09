-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Octobre 2015 à 09:09
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
CREATE DATABASE IF NOT EXISTS `festival` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `festival`;

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `idArtist` int(11) NOT NULL AUTO_INCREMENT,
  `nameArtist` varchar(25) NOT NULL,
  `bio` varchar(400) NOT NULL,
  `magicCookieYoutube` varchar(12) NOT NULL,
  PRIMARY KEY (`idArtist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `idSchedule` int(11) NOT NULL DEFAULT '0',
  `dateCommentaire` date NOT NULL,
  `content` varchar(200) NOT NULL,
  `isArtist` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idArtist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idSchedule`,`idUser`,`idArtist`),
  KEY `FK_Commente_idArtist` (`idArtist`),
  KEY `FK_Commente_idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_Commente_idSchedule` FOREIGN KEY (`idSchedule`) REFERENCES `schedule` (`idSchedule`),
  ADD CONSTRAINT `FK_Commente_idArtist` FOREIGN KEY (`idArtist`) REFERENCES `artists` (`idArtist`),
  ADD CONSTRAINT `FK_Commente_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Contraintes pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_SCHEDULE_idArtist` FOREIGN KEY (`idArtist`) REFERENCES `artists` (`idArtist`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE USER 'm151admin'@'127.0.0.1' IDENTIFIED BY '*0B74FCD1F359F2F247F1C098F33235DEB4ECB20A';
GRANT SELECT, INSERT, UPDATE, DELETE ON `festival`.* TO 'userFestival'@'127.0.0.1';