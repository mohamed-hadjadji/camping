-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 25 jan. 2020 à 02:11
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
-- Base de données :  `gestioncamping`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `sejour` text NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `type`, `lieu`, `sejour`, `debut`, `fin`, `option1`, `option2`, `option3`, `total`, `id_utilisateur`, `pseudo`) VALUES
(37, 'Tente', 'Plage', '2', '2020-01-22', '2020-01-24', 'borne', 'disco', '', '138', 3, 'admin'),
(38, 'Tente', 'Pins', '4', '2020-01-27', '2020-01-31', 'borne', 'disco', '', '276', 3, 'admin'),
(39, 'Tente', 'Plage', '2', '2020-02-01', '2020-02-03', 'borne', 'disco', '', '118', 3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `tarif2`
--

DROP TABLE IF EXISTS `tarif2`;
CREATE TABLE IF NOT EXISTS `tarif2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tente` int(11) NOT NULL,
  `campingcar` int(11) NOT NULL,
  `borne` int(11) NOT NULL,
  `disco` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tarif2`
--

INSERT INTO `tarif2` (`id`, `tente`, `campingcar`, `borne`, `disco`, `pack`, `id_reservation`) VALUES
(1, 10, 20, 2, 17, 30, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(2, 'mohamed', '$2y$12$yyyg9gBSupo.jRFrJFwAo.wxg3AxuynV.0Zt3z.J8FvFSXUO8H7v2'),
(3, 'admin', '$2y$12$WEUVwglxQ8sVyZFVjJoPEeneTTeaS/lZ6txk0Pci4Ql4HbPgHJXiy');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
