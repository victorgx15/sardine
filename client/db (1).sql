-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 26 fév. 2018 à 13:31
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `Id_Client` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Adresse` int(10) DEFAULT NULL,
  `Postal_Code` int(6) DEFAULT NULL,
  `Ville` varchar(20) DEFAULT NULL,
  `Status` char(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `boutique`
--

DROP TABLE IF EXISTS `boutique`;
CREATE TABLE IF NOT EXISTS `boutique` (
  `ID_Boutique` int(10) NOT NULL AUTO_INCREMENT,
  `Dirigent_` char(30) DEFAULT NULL,
  `Adresse` char(30) DEFAULT NULL,
  `Code_Postal` int(6) DEFAULT NULL,
  `ville` varchar(10) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Url_Boutique` varchar(100) DEFAULT NULL,
  `Pays` char(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Boutique`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_Commande` int(10) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Date_Livraison` date DEFAULT NULL,
  `Etat` char(50) DEFAULT NULL,
  `ID_Client` int(10) NOT NULL,
  PRIMARY KEY (`Id_Commande`),
  KEY `FK_Commande_ID_Client` (`ID_Client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `ID_Client` int(10) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) DEFAULT NULL,
  `PRENOM` varchar(30) DEFAULT NULL,
  `Tel` varchar(50) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `PW` varchar(8) DEFAULT NULL,
  `Civilite` varchar(2) DEFAULT NULL,
  `Tel2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `emplacement_`
--

DROP TABLE IF EXISTS `emplacement_`;
CREATE TABLE IF NOT EXISTS `emplacement_` (
  `Id_Emplacement` int(10) NOT NULL AUTO_INCREMENT,
  `Couloir` varchar(6) DEFAULT NULL,
  `Trave` varchar(6) DEFAULT NULL,
  `Etagere` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`Id_Emplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `est_placer`
--

DROP TABLE IF EXISTS `est_placer`;
CREATE TABLE IF NOT EXISTS `est_placer` (
  `Id_Emplacement` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Produit` int(10) NOT NULL,
  `Quantite_stock` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Emplacement`,`Id_Produit`),
  KEY `FK_Est_placer_Id_Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

DROP TABLE IF EXISTS `lignecommande`;
CREATE TABLE IF NOT EXISTS `lignecommande` (
  `Id_Ligne` int(10) NOT NULL AUTO_INCREMENT,
  `Quantité_Commandé` varchar(20) DEFAULT NULL,
  `Id_Commande` int(10) NOT NULL,
  `Id_Produit` int(10) NOT NULL,
  PRIMARY KEY (`Id_Ligne`),
  KEY `FK_LigneCommande_Id_Commande` (`Id_Commande`),
  KEY `FK_LigneCommande_Id_Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_Produit` int(10) NOT NULL AUTO_INCREMENT,
  `Prix` float DEFAULT NULL,
  `Ref` varchar(10) DEFAULT NULL,
  `Poids` varchar(10) DEFAULT NULL,
  `Marque` varchar(30) DEFAULT NULL,
  `Gamme` varchar(60) DEFAULT NULL,
  `Famille` varchar(60) DEFAULT NULL,
  `Designation` varchar(40) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Url_Image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_Produit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Id_Produit`, `Prix`, `Ref`, `Poids`, `Marque`, `Gamme`, `Famille`, `Designation`, `Description`, `Url_Image`) VALUES
(1, 100, '1010', '10', 'marque1', 'gamme1', 'famille1', 'produit de gamme1 marque1 et famille1', 'description ici', 'images/sardine1.jpg'),
(2, 200, '1020', '12', 'marque2', 'gamme2', 'famille2', 'produit de gamme2 marque2 et famille2', 'description ici', 'images/sardine3.jpg'),
(3, 100, '1030', '10', 'marque3', 'gamme3', 'famille3', 'produit de gamme3 marque3 et famille3', 'description ici', 'images/sardine1.jpg'),
(4, 120, '1022', '29', 'marque4', 'gamme4', 'famille4', 'Heyheyhey', 'description', 'images/sardine3.jpg'),
(5, 20, '1022', '40', 'marque5', 'gamme5', 'famille5', 'Heyheyhey5', 'description5', 'images/sardine3.jpg'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, 'produit6', NULL, 'images/sardine3.jpg'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, 'produit7', NULL, 'images/sardine3.jpg'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, 'image8', NULL, 'images/sardine3.jpg'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, 'image9', 'i', 'images/sardine3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(4) NOT NULL,
  `username` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `tel1` varchar(100) NOT NULL,
  `tel2` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `civilite`, `username`, `lastname`, `tel1`, `tel2`, `email`, `password`) VALUES
(1, 'Mr', 'Nizar', 'OUAZZANI', '0661803954', '0661803954', 'nizarouazzanichahdi17@gmail.com', 'db9e0e81988b9b0e007d67caa8c67eae02c4fa14c90ddc5e362590d2ccabdb59');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_Adresse_ID_Client` FOREIGN KEY (`Id_Client`) REFERENCES `compte` (`ID_Client`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_Commande_ID_Client` FOREIGN KEY (`ID_Client`) REFERENCES `compte` (`ID_Client`);

--
-- Contraintes pour la table `est_placer`
--
ALTER TABLE `est_placer`
  ADD CONSTRAINT `FK_Est_placer_Id_Emplacement` FOREIGN KEY (`Id_Emplacement`) REFERENCES `emplacement_` (`Id_Emplacement`),
  ADD CONSTRAINT `FK_Est_placer_Id_Produit` FOREIGN KEY (`Id_Produit`) REFERENCES `produit` (`Id_Produit`);

--
-- Contraintes pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD CONSTRAINT `FK_LigneCommande_Id_Commande` FOREIGN KEY (`Id_Commande`) REFERENCES `commande` (`Id_Commande`),
  ADD CONSTRAINT `FK_LigneCommande_Id_Produit` FOREIGN KEY (`Id_Produit`) REFERENCES `produit` (`Id_Produit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
