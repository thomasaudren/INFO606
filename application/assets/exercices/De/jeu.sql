--
-- Base de données: `jeu`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `uti_id` int(11) NOT NULL AUTO_INCREMENT,
  `uti_login` text NOT NULL,
  `uti_nom` text NOT NULL,
  `uti_motdepasse` text NOT NULL,
  PRIMARY KEY (`uti_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`uti_id`, `uti_login`, `uti_nom`, `uti_motdepasse`) VALUES
(1, 'toto', 'Toto de Toto', 'f71dbe52628a3f83a77ab494817525c6');
