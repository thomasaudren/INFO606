-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 05 Mai 2014 à 11:07
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `606`
--
CREATE DATABASE IF NOT EXISTS `606` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `606`;

-- --------------------------------------------------------

--
-- Structure de la table `academie`
--

CREATE TABLE IF NOT EXISTS `academie` (
  `ID_ACADEMIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIB_ACADEMIE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_ACADEMIE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `academie`
--

INSERT INTO `academie` (`ID_ACADEMIE`, `LIB_ACADEMIE`) VALUES
(1, 'Reims');

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `ID_AGENDA` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_AGENDA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `agenda`
--

INSERT INTO `agenda` (`ID_AGENDA`) VALUES
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26);

-- --------------------------------------------------------

--
-- Structure de la table `appartenir_per_cla`
--

CREATE TABLE IF NOT EXISTS `appartenir_per_cla` (
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`ID_CLASSE`),
  KEY `FK_APPARTENIR_PER_CLA2` (`ID_CLASSE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appartenir_per_cla`
--

INSERT INTO `appartenir_per_cla` (`ID_PERSONNE`, `ID_CLASSE`) VALUES
(2, 22),
(4, 22),
(5, 22);

-- --------------------------------------------------------

--
-- Structure de la table `appartenir_per_eta`
--

CREATE TABLE IF NOT EXISTS `appartenir_per_eta` (
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_ETABLISSEMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`ID_ETABLISSEMENT`),
  KEY `FK_APPARTENIR_PER_ETA2` (`ID_ETABLISSEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appartenir_per_eta`
--

INSERT INTO `appartenir_per_eta` (`ID_PERSONNE`, `ID_ETABLISSEMENT`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `ID_CLASSE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETABLISSEMENT` int(11) NOT NULL,
  `ID_NIVEAU` int(11) NOT NULL,
  `ID_AGENDA` int(11) NOT NULL,
  `LIB_CLASSE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_CLASSE`),
  KEY `FK_AVOIR_3` (`ID_NIVEAU`),
  KEY `FK_DEPENDRE` (`ID_ETABLISSEMENT`),
  KEY `FK_POSSEDER_CLA_AG` (`ID_AGENDA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`ID_CLASSE`, `ID_ETABLISSEMENT`, `ID_NIVEAU`, `ID_AGENDA`, `LIB_CLASSE`) VALUES
(22, 1, 1, 15, 'CP');

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE IF NOT EXISTS `commune` (
  `ID_COMMUNE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAYS` int(11) NOT NULL,
  `NOM_COMMUNE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_COMMUNE`),
  KEY `FK_ETRE_DANS` (`ID_PAYS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commune`
--

INSERT INTO `commune` (`ID_COMMUNE`, `ID_PAYS`, `NOM_COMMUNE`) VALUES
(1, 1, 'Reims');

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE IF NOT EXISTS `etablissement` (
  `ID_ETABLISSEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COMMUNE` int(11) NOT NULL,
  `ID_ACADEMIE` int(11) NOT NULL,
  `LIB_ETABLISSEMENT` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_ETABLISSEMENT`),
  KEY `FK_ETRE_SITUER` (`ID_COMMUNE`),
  KEY `FK_POSSEDER` (`ID_ACADEMIE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `etablissement`
--

INSERT INTO `etablissement` (`ID_ETABLISSEMENT`, `ID_COMMUNE`, `ID_ACADEMIE`, `LIB_ETABLISSEMENT`) VALUES
(1, 1, 1, 'Clairmarais');

-- --------------------------------------------------------

--
-- Structure de la table `exercer`
--

CREATE TABLE IF NOT EXISTS `exercer` (
  `ID_EXERCICE` int(11) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `GRAINE` longtext,
  `DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID_EXERCICE`,`ID_PERSONNE`),
  KEY `FK_EXERCER2` (`ID_PERSONNE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE IF NOT EXISTS `exercice` (
  `ID_EXERCICE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MATIERE` int(11) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_NIVEAU` int(11) NOT NULL,
  `LIB_EXERCICE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_EXERCICE`),
  KEY `FK_APPARTENIR_2` (`ID_NIVEAU`),
  KEY `FK_CONCERNER` (`ID_MATIERE`),
  KEY `FK_CREER` (`ID_PERSONNE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `ID_MATIERE` int(11) NOT NULL AUTO_INCREMENT,
  `LIB_MATIERE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_MATIERE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
  `ID_NIVEAU` int(11) NOT NULL AUTO_INCREMENT,
  `LIB_NIVEAU` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_NIVEAU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`ID_NIVEAU`, `LIB_NIVEAU`) VALUES
(1, 'CP'),
(2, 'CE1'),
(3, 'CE2'),
(4, 'CM1'),
(5, 'CM2');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `ID_PAGE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_AGENDA` int(11) NOT NULL,
  `DATE_PAGE` date DEFAULT NULL,
  `CONTENT_PAGE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_PAGE`),
  KEY `FK_AVOIR_2` (`ID_AGENDA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `ID_PAYS` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_PAYS` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_PAYS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`ID_PAYS`, `NOM_PAYS`) VALUES
(1, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `ID_PERSONNE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROFIL` int(11) NOT NULL,
  `NOM_PERSONNE` varchar(1024) DEFAULT NULL,
  `PRENOM_PERSONNE` varchar(1024) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `PASSWORD` varchar(1024) DEFAULT NULL,
  `LOGIN` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONNE`),
  KEY `FK_CORRESPONDRE` (`ID_PROFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`ID_PERSONNE`, `ID_PROFIL`, `NOM_PERSONNE`, `PRENOM_PERSONNE`, `DATE_NAISSANCE`, `PASSWORD`, `LOGIN`) VALUES
(1, 4, 'Deleplace', 'Nicolas', '2014-05-05', '21232f297a57a5a743894a0e4a801fc3', 'DELEP001'),
(2, 2, 'Audren', 'Thomas', '2014-05-01', '21232f297a57a5a743894a0e4a801fc3', 'AUDRE001'),
(3, 3, 'Rabat', 'Cyril', '2014-05-13', '21232f297a57a5a743894a0e4a801fc3', 'RABAT001'),
(4, 1, 'Stark', 'Tony', '0454-12-05', '', 'STARK001'),
(5, 1, 'Wayne', 'Bruce', '0548-04-05', '', 'WAYNE001');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `ID_PROFIL` int(11) NOT NULL AUTO_INCREMENT,
  `LIB_PROFIL` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID_PROFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`ID_PROFIL`, `LIB_PROFIL`) VALUES
(1, 'Eleve'),
(2, 'Professeur'),
(3, 'Directeur'),
(4, 'Developpeur');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartenir_per_cla`
--
ALTER TABLE `appartenir_per_cla`
  ADD CONSTRAINT `FK_APPARTENIR_PER_CLA2` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`),
  ADD CONSTRAINT `FK_APPARTENIR_PER_CLA` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`);

--
-- Contraintes pour la table `appartenir_per_eta`
--
ALTER TABLE `appartenir_per_eta`
  ADD CONSTRAINT `FK_APPARTENIR_PER_ETA2` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `etablissement` (`ID_ETABLISSEMENT`),
  ADD CONSTRAINT `FK_APPARTENIR_PER_ETA` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`);

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_POSSEDER_CLA_AG` FOREIGN KEY (`ID_AGENDA`) REFERENCES `agenda` (`ID_AGENDA`),
  ADD CONSTRAINT `FK_AVOIR_3` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `niveau` (`ID_NIVEAU`),
  ADD CONSTRAINT `FK_DEPENDRE` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `etablissement` (`ID_ETABLISSEMENT`);

--
-- Contraintes pour la table `commune`
--
ALTER TABLE `commune`
  ADD CONSTRAINT `FK_ETRE_DANS` FOREIGN KEY (`ID_PAYS`) REFERENCES `pays` (`ID_PAYS`);

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `FK_POSSEDER` FOREIGN KEY (`ID_ACADEMIE`) REFERENCES `academie` (`ID_ACADEMIE`),
  ADD CONSTRAINT `FK_ETRE_SITUER` FOREIGN KEY (`ID_COMMUNE`) REFERENCES `commune` (`ID_COMMUNE`);

--
-- Contraintes pour la table `exercer`
--
ALTER TABLE `exercer`
  ADD CONSTRAINT `FK_EXERCER2` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`),
  ADD CONSTRAINT `FK_EXERCER` FOREIGN KEY (`ID_EXERCICE`) REFERENCES `exercice` (`ID_EXERCICE`);

--
-- Contraintes pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`),
  ADD CONSTRAINT `FK_APPARTENIR_2` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `niveau` (`ID_NIVEAU`),
  ADD CONSTRAINT `FK_CONCERNER` FOREIGN KEY (`ID_MATIERE`) REFERENCES `matiere` (`ID_MATIERE`);

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_AVOIR_2` FOREIGN KEY (`ID_AGENDA`) REFERENCES `agenda` (`ID_AGENDA`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_CORRESPONDRE` FOREIGN KEY (`ID_PROFIL`) REFERENCES `profil` (`ID_PROFIL`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
