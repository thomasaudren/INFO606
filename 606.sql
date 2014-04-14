-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Avril 2014 à 16:46
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `606`
--

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
(1, 'REIMS');

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `ID_AGENDA` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_AGENDA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `ID_CLASSE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETABLISSEMENT` int(11) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `LIB_CLASSE` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_CLASSE`),
  KEY `FK_DEPENDRE` (`ID_ETABLISSEMENT`),
  KEY `FK_FAIRE` (`ID_PERSONNE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 1, 'REIMS');

-- --------------------------------------------------------

--
-- Structure de la table `dev`
--

CREATE TABLE IF NOT EXISTS `dev` (
  `ID_PERSONNE` int(11) NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dev`
--

INSERT INTO `dev` (`ID_PERSONNE`) VALUES
(2);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `PASSWORD` longtext,
  `LOGIN` varchar(256) DEFAULT NULL,
  `REDOUBLANT` int(11) DEFAULT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  `ID_AGENDA` int(11) NOT NULL,
  `ID_ETABLISSEMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`),
  KEY `FK_APARTENIR` (`ID_CLASSE`),
  KEY `FK_APPARTENIR_3` (`ID_ETABLISSEMENT`),
  KEY `FK_POSSEDER_2` (`ID_AGENDA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 1, 'Lycée Georges Clémenceau');

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
  `ID_NIVEAU` int(11) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 'FRANCE');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `ID_PERSONNE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_PERSONNE` varchar(1024) DEFAULT NULL,
  `PRENOM_PERSONNE` varchar(1024) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `PASSWORD` varchar(256) DEFAULT NULL,
  `LOGIN` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONNE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`ID_PERSONNE`, `NOM_PERSONNE`, `PRENOM_PERSONNE`, `DATE_NAISSANCE`, `PASSWORD`, `LOGIN`) VALUES
(1, 'DELEPLACE', 'NICOLAS', '2014-04-01', '21232f297a57a5a743894a0e4a801fc3', 'DELEP001'),
(2, 'AUDREN', 'THOMAS', '2014-04-01', '21232f297a57a5a743894a0e4a801fc3', 'AUDRE001');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_STATUT` int(11) NOT NULL,
  `ID_ETABLISSEMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`),
  KEY `FK_APPARTENIR_` (`ID_ETABLISSEMENT`),
  KEY `FK_ETRE` (`ID_STATUT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`ID_PERSONNE`, `ID_STATUT`, `ID_ETABLISSEMENT`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `ID_STATUT` int(11) NOT NULL AUTO_INCREMENT,
  `LIB_STATUT` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID_STATUT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`ID_STATUT`, `LIB_STATUT`) VALUES
(1, 'Professeur'),
(2, 'Directeur');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_FAIRE` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `professeur` (`ID_PERSONNE`),
  ADD CONSTRAINT `FK_DEPENDRE` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `etablissement` (`ID_ETABLISSEMENT`);

--
-- Contraintes pour la table `commune`
--
ALTER TABLE `commune`
  ADD CONSTRAINT `FK_ETRE_DANS` FOREIGN KEY (`ID_PAYS`) REFERENCES `pays` (`ID_PAYS`);

--
-- Contraintes pour la table `dev`
--
ALTER TABLE `dev`
  ADD CONSTRAINT `FK_HERITAGE_2` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_POSSEDER_2` FOREIGN KEY (`ID_AGENDA`) REFERENCES `agenda` (`ID_AGENDA`),
  ADD CONSTRAINT `FK_APARTENIR` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`),
  ADD CONSTRAINT `FK_APPARTENIR_3` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `etablissement` (`ID_ETABLISSEMENT`),
  ADD CONSTRAINT `FK_HERITAGE_3` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`);

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
  ADD CONSTRAINT `FK_EXERCER2` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `eleve` (`ID_PERSONNE`),
  ADD CONSTRAINT `FK_EXERCER` FOREIGN KEY (`ID_EXERCICE`) REFERENCES `exercice` (`ID_EXERCICE`);

--
-- Contraintes pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `dev` (`ID_PERSONNE`),
  ADD CONSTRAINT `FK_APPARTENIR_2` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `niveau` (`ID_NIVEAU`),
  ADD CONSTRAINT `FK_CONCERNER` FOREIGN KEY (`ID_MATIERE`) REFERENCES `matiere` (`ID_MATIERE`);

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_AVOIR_2` FOREIGN KEY (`ID_AGENDA`) REFERENCES `agenda` (`ID_AGENDA`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `FK_APPARTENIR_` FOREIGN KEY (`ID_ETABLISSEMENT`) REFERENCES `etablissement` (`ID_ETABLISSEMENT`),
  ADD CONSTRAINT `FK_ETRE` FOREIGN KEY (`ID_STATUT`) REFERENCES `statut` (`ID_STATUT`),
  ADD CONSTRAINT `FK_HERITAGE_1` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `personne` (`ID_PERSONNE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
