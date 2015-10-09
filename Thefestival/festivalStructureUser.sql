-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 25 Septembre 2015 à 10:43
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
-- Structure de la table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `idArtist` int(11) NOT NULL AUTO_INCREMENT,
  `nameArtist` varchar(25) NOT NULL,
  `bio` varchar(300) NOT NULL,
  `idYoutubeVideo` varchar(12) NOT NULL,
  PRIMARY KEY (`idArtist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentartist`
--

DROP TABLE IF EXISTS `commentartist`;
CREATE TABLE IF NOT EXISTS `commentartist` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `datPost` date NOT NULL,
  `content` varchar(250) NOT NULL,
  `isValid` int(11) NOT NULL,
  PRIMARY KEY (`idComment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentschedule`
--

DROP TABLE IF EXISTS `commentschedule`;
CREATE TABLE IF NOT EXISTS `commentschedule` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `datePost` date NOT NULL,
  `content` varchar(250) NOT NULL,
  `idValid` int(11) NOT NULL,
  PRIMARY KEY (`idComment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT USAGE ON *.* TO 'userFestival'@'127.0.0.1' IDENTIFIED BY PASSWORD '*0B74FCD1F359F2F247F1C098F33235DEB4ECB20A';

GRANT SELECT, INSERT, UPDATE ON `festival`.* TO 'userFestival'@'127.0.0.1';
