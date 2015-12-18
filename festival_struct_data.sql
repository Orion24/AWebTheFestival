-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 18 Décembre 2015 à 11:28
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

--
-- Contenu de la table `artists`
--

INSERT INTO `artists` (`idArtist`, `nameArtist`, `bio`, `magicCookieYoutube`) VALUES
(1, 'Slipknot', 'Originaire de Des Moines dans l''Iowa ce groupe était composé de 9 membres :  Sid Wilson, Paul Gray, Joey Jordison, Chris Fehn, James Root, Craig Jones, Shawn Crahan, Mick Thomson, et de Corey Taylor. Mais avec le décès de Paul Gray, et le départ de Joey Jordison, le groupe dénombre sept membres restants.', 'XEEasR7hVhA'),
(2, 'Disturbed', 'Disturbed est un groupe de metal alternatif américain, fondé en 1996 à Chicago par Dan Donegan, Steve « Fuzz » Kmak, Mike Wengren et David Draiman.', 'Auuqlcom6tM'),
(3, 'Avenged Sevenfold', 'Avenged Sevenfold (A7X) est un groupe de heavy metal américain, originaire de Huntington Beach, en Californie. Le groupe a longtemps été un pilier de la scène underground californienne avant d''évoluer vers une musique plus mélodique qui a permis au groupe de connaître le succès avec l''album City of Evil et l''album éponyme Avenged Sevenfold. Fondé par M. Shadows, Zacky Vengeance, The Rev et Matt We', 'Jgk3u44W2i4'),
(4, 'System of a Down', 'System of a Down (parfois abrégé en SOAD ou System) est un groupe de rock américain, originaire de Californie, formé en 1994. Le groupe est actuellement composé de quatre membres, tous d''origine arménienne : Serj Tankian, Daron Malakian, Shavo Odadjian, et John Dolmayan. Issu de la scène underground californienne, le groupe rencontre son premier succès majeur avec la sortie de son premier album ho', 'CSvFpBOe8eY'),
(5, 'Maximum The Hormone', 'Maximum the Hormone (Makishimamu Za Horumon) (stylisé MAXIMUM THE HORMONE) est un groupe nu metal/punk hardcore japonais composé de quatre membres.\n\nLe groupe a été popularisé principalement grâce à son interprétation de deux génériques de la série animée Death Note avec les titres What''s up, People? et Zetsubou Billy.', 'qlEW_mLZ22U'),
(6, 'Five finger death punch', 'Five Finger Death Punch (parfois abrégé FFDP ou 5FDP) est un groupe de heavy metal américain, originaire de Las Vegas, dans le Nevada. Formé en 2005 par le guitariste d''origine hongroise Zoltán Báthory. Autour de Báthory le groupe se compose de Ivan L. Moody au chant, Jeremy Spencer à la batterie, Chris Kael à la basse et Jason Hook à la guitare. Le nom Five Finger Death Punch est une référence au', 'HCBPmxiVMKk'),
(7, 'Gojira', 'Gojira est un groupe de Metal Extrême français fondé en 1996 à Bayonne (Pyrénées-Atlantiques). Créé sous le nom initial de Godzilla1, il adopte son nom actuel en 2012, lequel n''est autre que sa transcription en romaji. Le groupe est actuellement composé de quatre membres : Joseph Duplantier (chant et guitare rythmique), le leader ; Mario Duplantier (batterie), frère du premier ; Christian Andreu ', 'BGHlZwMYO9g'),
(8, 'JoJo', 'C''est un branleur qui aime le hardcore et il aime les loli. Mais on l''aime quand même <3.', 'zoSd0fUDaLE');

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

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`idComment`, `idUser`, `idSchedule`, `idArtist`, `dateCommentaire`, `content`, `isArtist`, `isValid`) VALUES
(2, 1, 0, 1, '2015-10-05', 'Je suis un test', 1, 1),
(5, 3, 0, 2, '2015-11-01', 'Bla.bla', 1, 1),
(9, 1, 0, 3, '2015-12-04', 'Test A7X', 1, 1),
(10, 1, 0, 1, '2015-12-18', 'Magots 4 life <3', 1, 1),
(11, 3, 0, 5, '2015-12-18', 'What''s up people?', 1, 1),
(12, 1, 0, 4, '2015-12-18', 'SOAD!', 1, 1);

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
-- Contenu de la table `users`
--

INSERT INTO `users` (`idUser`, `pseudo`, `password`, `isAdmin`) VALUES
(1, 'Admin', 'f6889fc97e14b42dec11a8c183ea791c5465b658', 1),
(3, 'Toto', 'f6889fc97e14b42dec11a8c183ea791c5465b658', 0);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
