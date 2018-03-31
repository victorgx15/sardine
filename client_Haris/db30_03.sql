-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 30 mars 2018 à 01:29
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
  `Id_Adresse` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Client` int(10) NOT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Postal_Code` int(6) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Pays` char(255) DEFAULT NULL,
  `Status` char(1) DEFAULT NULL,
  PRIMARY KEY (`Id_Adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`Id_Adresse`, `Id_Client`, `Adresse`, `Postal_Code`, `Ville`, `Pays`, `Status`) VALUES
(1, 10, '8 Rue Jean Jack - Digicode 2536A', 75016, 'Paris', 'France', 'L'),
(2, 1, '2 Rue de la pompe', 75016, 'Paris', 'France', 'B');

-- --------------------------------------------------------

--
-- Structure de la table `boutique`
--

DROP TABLE IF EXISTS `boutique`;
CREATE TABLE IF NOT EXISTS `boutique` (
  `ID_Boutique` int(10) NOT NULL AUTO_INCREMENT,
  `Dirigeant` varchar(255) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Url_Boutique` varchar(255) DEFAULT NULL,
  `Horaire` text,
  PRIMARY KEY (`ID_Boutique`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boutique`
--

INSERT INTO `boutique` (`ID_Boutique`, `Dirigeant`, `Telephone`, `Url_Boutique`, `Horaire`) VALUES
(1, 'Thomas', '02030303', 'http://localhost/siaproject_v0.1/client', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_Commande` int(10) NOT NULL AUTO_INCREMENT,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Date_Livraison` date DEFAULT NULL,
  `Etat` char(50) DEFAULT 'Commandé',
  `ID_Client` int(10) NOT NULL,
  PRIMARY KEY (`Id_Commande`),
  KEY `FK_Commande_ID_Client` (`ID_Client`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Id_Commande`, `Date`, `Date_Livraison`, `Etat`, `ID_Client`) VALUES
(13, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(14, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(15, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(16, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(17, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(18, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(19, '2018-03-11 23:00:00', '2018-03-15', 'En cours de prÃ©paration', 10),
(20, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(21, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(22, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(23, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(24, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(25, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(26, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(27, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(28, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(29, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(30, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(31, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(32, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(33, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(34, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(35, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(36, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(37, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(38, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(39, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(40, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(41, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(42, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(43, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(44, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(45, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(46, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(47, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10),
(48, '2018-03-12 23:00:00', '2018-03-16', 'En cours de prÃ©paration', 10);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `ID_Client` int(10) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `Tel` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Civilite` varchar(12) DEFAULT NULL,
  `Tel2` varchar(20) DEFAULT NULL,
  `Status` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_Client`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`ID_Client`, `Nom`, `PRENOM`, `Tel`, `Email`, `Password`, `Civilite`, `Tel2`, `Status`) VALUES
(1, 'Admin', 'LEMAITRE', '0101010101', 'a@a.com', '', 'Mme', NULL, 'A'),
(2, 'MEMBER', 'Staff', '0201010101', 'employe@lvs.fr', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'Mme', NULL, 'E'),
(3, 'Pigeon', 'TOURIST', '0234890101', 'pigeon@gmail.fr', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'Mme', NULL, 'C'),
(5, 'Johnson', 'Joe', '0602523265', 'sebastien91941@hotmail.com', '5ccca5bb6d737c724c872058d9633da7faa3faecc75a81ac96b87126d6829816', 'M', NULL, 'C'),
(7, 'Marchal', 'Sebastien', '+33649079493', 'seb@seb.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'M', NULL, 'E'),
(8, 'Akimkin', 'Max', '154', 'bdsf@qdsf.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'M', NULL, 'C'),
(9, 'Marchal', 'Seb', '0649079493', 'admin@test.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'M', NULL, 'A'),
(10, 'Ouazzani Chahdi', 'Nizar', '0101', 'nizarouazzanichahdi17@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Mll', '0101', 'A'),
(11, 'hola', 'puta', '0101', 'nizarouazzanichahdi@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Mme', '0101', 'C'),
(12, 'Nizar', 'OUAZZANI', '0661803954', 'nizarouazzani@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'Madame', '', 'C'),
(13, 'arhtur', 'rambo', '0101', 'arthur@gmail.com', '07334386287751ba02a4588c1a0875dbd074a61bd9e6ab7c48d244eacd0c99e0', 'Madame', '', 'C'),
(14, 'Noznoz', 'bozboz', '0101', 'boz@gmail.com', 'a641f6f0abcd11424c522bc040a6da566f9b30116c29b0dd95f06dc7d655f73c', 'Madame', '', 'C'),
(15, 'boz', 'zob', '01', 'fdj@gmail.com', '3333b3a2a03230e79c63fcaf65da05a19515c06b28d33417c03749fd175ed4ec', 'Madame', '01', 'C'),
(16, 'bozbo', 'zbozbo', '0101', 'fjgf@gmail', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Madame', '', 'C');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplacement_`
--

INSERT INTO `emplacement_` (`Id_Emplacement`, `Couloir`, `Trave`, `Etagere`) VALUES
(1, '1', '1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `est_placer`
--

DROP TABLE IF EXISTS `est_placer`;
CREATE TABLE IF NOT EXISTS `est_placer` (
  `Id_Emplacement` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Produit` int(10) NOT NULL,
  `Quantite_stock` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Emplacement`,`Id_Produit`),
  KEY `FK_Est_placer_Id_Produit` (`Id_Produit`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `est_placer`
--

INSERT INTO `est_placer` (`Id_Emplacement`, `Id_Produit`, `Quantite_stock`) VALUES
(1, 10, 10),
(1, 12, 5),
(1, 13, 20);

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

DROP TABLE IF EXISTS `lignecommande`;
CREATE TABLE IF NOT EXISTS `lignecommande` (
  `Quantite` varchar(20) DEFAULT NULL,
  `Id_Commande` int(10) NOT NULL,
  `Id_Produit` int(10) NOT NULL,
  PRIMARY KEY (`Id_Commande`,`Id_Produit`),
  KEY `FK_LigneCommande_Id_Commande` (`Id_Commande`),
  KEY `FK_LigneCommande_Id_Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignecommande`
--

INSERT INTO `lignecommande` (`Quantite`, `Id_Commande`, `Id_Produit`) VALUES
('5', 10, 10),
('3', 10, 12),
('10', 10, 13),
('5', 12, 10),
('3', 12, 12),
('10', 12, 13),
('5', 47, 10),
('3', 47, 12),
('10', 47, 13),
('5', 48, 10),
('3', 48, 12),
('10', 48, 13);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_Produit` int(10) NOT NULL AUTO_INCREMENT,
  `Prix` float DEFAULT NULL,
  `Ref` varchar(50) DEFAULT NULL,
  `Nombre_boites` int(10) DEFAULT NULL,
  `Poids` int(10) DEFAULT NULL,
  `Marque` varchar(30) DEFAULT NULL,
  `Gamme` varchar(60) DEFAULT NULL,
  `Famille` varchar(60) DEFAULT NULL,
  `Designation` varchar(255) DEFAULT NULL,
  `Description` text,
  `Url_Image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_Produit`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Id_Produit`, `Prix`, `Ref`, `Nombre_boites`, `Poids`, `Marque`, `Gamme`, `Famille`, `Designation`, `Description`, `Url_Image`) VALUES
(10, 10, 'Plats_thon', 2, 100, 'Tradition', 'Sardine', 'Classique', 'produit de gamme1 marque1 et famille1', 'description bal bla ici', 'images/Produits/coffret/coffret.jpg'),
(11, 20, 'Plats_thon', 1, 120, 'Tradition', 'Coquillage', 'Classique', 'produit de gamme2 marque2 et famille2', 'c\'est du pipo', 'images/Produits/coffret/coffret3.jpg'),
(12, 10, 'Plats_thon', 10, 100, 'Ocean', 'Sardine', 'Assortiment', 'produit de gamme3 marque3 et famille3', 'c\'est bon ce truc', 'images/Produits/coffret/coffret4.jpg'),
(13, 12, 'Plats_thon', 6, 290, 'Nouveauté\r\nOcéan', 'Coquillage', 'Classique', 'PETITE MARMITE NOISETTES DE ST-JACQUES COCO', 'Cette petite marmite a été cuisinée pour vous offrir un bouquet de saveurs parfumées et originales.\r\nInspiration exotique pour cette petite marmite : le piquant du gingembre\r\nréveille les Saint-Jacques, la douceur du lait de coco arrondit l\'ensemble, des oignons rissolés ajoutent une touche délicatement sucrée…', 'images/Produits/coffret/coffret5.jpg'),
(14, 20, 'Plats_thon', 4, 400, 'Lac', 'Sardine', 'Assortiment', 'Heyheyhey5', 'description5', 'images/Produits/coffret/coffret2.jpg'),
(15, 12, 'Coffrets_thon', 1, 10, NULL, NULL, NULL, 'Rivoli', NULL, 'images/Produits/conserves/conserves2.jpg'),
(16, 15, 'Coffrets_thon', NULL, 10, NULL, NULL, NULL, 'Roseti', NULL, 'images/Produits/conserves/conserves.jpg'),
(17, 12, 'Coffrets_thon', 1, 10, NULL, NULL, NULL, 'Nostra', NULL, 'images/Produits/conserves/conserves4.jpg'),
(18, 8, 'Coffrets_thon', NULL, 10, NULL, NULL, NULL, 'Arbeo', NULL, 'images/Produits/conserves/conserves3.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
