-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 04 Mai 2016 à 16:32
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `facture`
--

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `numfacture` varchar(25) NOT NULL,
  `datefac` date DEFAULT NULL,
  `echeance` date DEFAULT NULL,
  `compte_ligue` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`numfacture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `facture`
--


--
-- Structure de la table `ligne_facture`
--

CREATE TABLE IF NOT EXISTS `ligne_facture` (
  `numfacture` varchar(25) NOT NULL,
  `code_prestation` varchar(25) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`numfacture`,`code_prestation`),
  KEY `FK_LFAC_PREST` (`code_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ligne_facture`
--


--
-- Structure de la table `ligue`
--

CREATE TABLE IF NOT EXISTS `ligue` (
  `numcompte` int(11) NOT NULL,
  `intitule` varchar(25) DEFAULT NULL,
  `nomtresorier` varchar(25) DEFAULT NULL,
  `adressrue` varchar(50) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `Ville` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`numcompte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ligue`
--

INSERT INTO `ligue` (`numcompte`, `intitule`, `nomtresorier`, `adressrue`, `CP`, `Ville`) VALUES
(411007, 'Ligue Lorraine Escrime', 'Valerie', '', '', ''),
(411009, 'Ligue Lorraine de Basket', 'Mohamed Bourgard', '', '', ''),
(411010, 'Ligue de Babyfoot', 'Sylvain', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE IF NOT EXISTS `prestation` (
  `code` varchar(25) NOT NULL,
  `libelle` varchar(25) DEFAULT NULL,
  `pu` float(3,2) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `prestation`
--

INSERT INTO `prestation` (`code`, `libelle`, `pu`) VALUES
('AFFRAN', 'Affranchissement', 3.33),
('LETTRE', 'envoie de lettre', 0.30),
('PHOTOCOULEUR', 'Photocopie couleur', 0.24),
('PHOTON&B', 'Photocopie noir et blanc', 0.06),
('TRACEUR', 'utilisation du traceur', 0.36);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ligne_facture`
--
ALTER TABLE `ligne_facture`
  ADD CONSTRAINT `FK_LFAC_FAC` FOREIGN KEY (`numfacture`) REFERENCES `facture` (`numfacture`),
  ADD CONSTRAINT `FK_LFAC_PREST` FOREIGN KEY (`code_prestation`) REFERENCES `prestation` (`code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
