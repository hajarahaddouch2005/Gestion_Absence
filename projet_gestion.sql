-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 28 juin 2024 à 17:35
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
-- Base de données :  `projet_gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stag` int(11) NOT NULL,
  `crn_horaire` varchar(255) NOT NULL,
  `date_absence` date NOT NULL,
  `formateur` varchar(255) NOT NULL,
  `type_absence` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id`, `id_stag`, `crn_horaire`, `date_absence`, `formateur`, `type_absence`) VALUES
(2, 2, '8-9', '2024-06-28', 'abdo', 'Absence justifiée'),
(8, 1, '8-9', '2024-06-14', 'abdo', 'Absence justifiée'),
(4, 3, '8-9', '2024-06-27', 'abdo', 'Absence justifiée'),
(9, 2, '8-9', '2024-06-27', 'abdo', 'Absence justifiée');

-- --------------------------------------------------------

--
-- Structure de la table `autorisation`
--

DROP TABLE IF EXISTS `autorisation`;
CREATE TABLE IF NOT EXISTS `autorisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stag` int(11) NOT NULL,
  `date_aut` date NOT NULL,
  `crn_horaire` int(11) NOT NULL,
  `formateur` varchar(255) NOT NULL,
  `type_au` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `autorisation`
--

INSERT INTO `autorisation` (`id`, `id_stag`, `date_aut`, `crn_horaire`, `formateur`, `type_au`) VALUES
(1, 3, '2024-06-27', 8, 'abdo', 'Autoriser'),
(3, 3, '2024-06-28', 8, 'abdo', 'Non Autoriser'),
(4, 1, '2024-06-28', 8, 'toto', 'Autoriser');

-- --------------------------------------------------------

--
-- Structure de la table `directeur`
--

DROP TABLE IF EXISTS `directeur`;
CREATE TABLE IF NOT EXISTS `directeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `matricule` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `directeur`
--

INSERT INTO `directeur` (`id`, `id_user`, `nom`, `prenom`, `matricule`) VALUES
(1, 1, 'DOUSKI', 'ZINEB', 'jk'),
(2, 7, 'nihal', 'nihal', 'hhhhhhh');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `formateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `formateur`) VALUES
(1, 'SMI', 'abdo'),
(2, 'SRI', 'abdo'),
(3, 'DVL', 'nono'),
(5, 'SMI', 'nono');

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `matricule` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `id_user`, `nom`, `prenom`, `matricule`) VALUES
(2, 5, 'abdo', 'hadq', 'test'),
(3, 6, 'nono', 'uu', 'dd');

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

DROP TABLE IF EXISTS `gestionnaire`;
CREATE TABLE IF NOT EXISTS `gestionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `matricule` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`id`, `id_user`, `nom`, `prenom`, `matricule`) VALUES
(2, 4, 'toto', 'sara', 'jk');

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

DROP TABLE IF EXISTS `presence`;
CREATE TABLE IF NOT EXISTS `presence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stag` int(11) NOT NULL,
  `date_presence` date NOT NULL,
  `formateur` varchar(255) NOT NULL,
  `crn_horaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `retard`
--

DROP TABLE IF EXISTS `retard`;
CREATE TABLE IF NOT EXISTS `retard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stag` int(11) NOT NULL,
  `date_Retad` date NOT NULL,
  `formateur` varchar(255) NOT NULL,
  `crn_horaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `retard`
--

INSERT INTO `retard` (`id`, `id_stag`, `date_Retad`, `formateur`, `crn_horaire`) VALUES
(1, 1, '2024-06-27', 'abdo', '8'),
(2, 3, '2024-06-27', 'abdo', '8');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datee` date NOT NULL,
  `date_debut` int(11) NOT NULL,
  `date_fin` int(11) NOT NULL,
  `formateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id`, `datee`, `date_debut`, `date_fin`, `formateur`) VALUES
(1, '2024-06-21', 17, 9, 'abdo');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `CIN` varchar(100) NOT NULL,
  `Filiere` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `CIN`, `Filiere`) VALUES
(1, 'DOUSKI', 'ZINEB', 'SH189195', 'SMI'),
(2, 'neeraj', 'jjjjjj', 'ggggggggggg', 'SMI'),
(3, 'admin', 'hhhhhh', 'kkkkkkkk', 'SMI'),
(4, 'fffffffff', 'hhhhhhh', 'nbnb', 'SMI'),
(6, 'ooooooooooo', 'pppppppppp', 'SH189195', 'SRI'),
(7, 'rachida', 'fghyt', 'SH189195', 'SRI');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `type`) VALUES
(1, 'sara', 'cc', 'directeur'),
(4, 'zineb', 'cc', 'gestionnaire'),
(5, 'abdo', 'cc', 'formateur'),
(6, 'kk', 'cc', 'formateur'),
(7, 'nihal', 'cc', 'directeur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
