-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 05 avr. 2018 à 00:56
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`Id_Adresse`, `Id_Client`, `Adresse`, `Postal_Code`, `Ville`, `Pays`, `Status`) VALUES
(1, 10, '8 Rue Jean Jack - Digicode 2536A', 75016, 'Paris', 'France', 'L'),
(2, 1, '2 Rue de la pompe', 75016, 'Paris', 'France', 'B'),
(5, 10, '8 rue FRANCIS DE CROISSET, résidence Francis de Croisset, bâtiment B studio 510', 75018, 'PARIS 18', 'France', 'L'),
(6, 10, '8 rue FRANCIS DE CROISSET, résidence Francis de Croisset, bâtiment B studio 510', 75018, 'PARIS 18', 'Francisco', 'L');

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Id_Commande`, `Date`, `Date_Livraison`, `Etat`, `ID_Client`) VALUES
(54, '2018-04-03 22:00:00', '2018-04-07', 'En cours de prÃ©paration', 10);

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
  `Autorisation` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_Client`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`ID_Client`, `Nom`, `PRENOM`, `Tel`, `Email`, `Password`, `Civilite`, `Tel2`, `Status`, `Autorisation`) VALUES
(1, 'Admin', 'LEMAITRE', '0101010101', 'a@a.com', '', 'Mme', NULL, 'A', 0),
(2, 'MEMBER', 'Staff', '0201010101', 'employe@lvs.fr', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'Mme', NULL, 'E', 0),
(3, 'Pigeon', 'TOURIST', '0234890101', 'pigeon@gmail.fr', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'Mme', NULL, 'C', 0),
(5, 'Johnson', 'Joe', '0602523265', 'sebastien91941@hotmail.com', '5ccca5bb6d737c724c872058d9633da7faa3faecc75a81ac96b87126d6829816', 'M', NULL, 'C', 0),
(7, 'Marchal', 'Sebastien', '+33649079493', 'seb@seb.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'M', NULL, 'E', 0),
(8, 'Akimkin', 'Max', '154', 'bdsf@qdsf.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'M', NULL, 'C', 0),
(9, 'Marchal', 'Seb', '0649079493', 'admin@test.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'M', NULL, 'A', 0),
(12, 'Nizar', 'OUAZZANI', '0661803954', 'nizarouazzani@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'Madame', '', 'C', 0);

-- --------------------------------------------------------

--
-- Structure de la table `emplacement_`
--

DROP TABLE IF EXISTS `emplacement_`;
CREATE TABLE IF NOT EXISTS `emplacement_` (
  `Id_Emplacement` int(10) NOT NULL,
  `Couloir` varchar(6) DEFAULT NULL,
  `Trave` varchar(6) DEFAULT NULL,
  `Etagere` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`Id_Emplacement`),
  UNIQUE KEY `Id_Emplacement` (`Id_Emplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplacement_`
--

INSERT INTO `emplacement_` (`Id_Emplacement`, `Couloir`, `Trave`, `Etagere`) VALUES
(0, '0', '0', '0'),
(1, '0', '0', '1'),
(2, '0', '0', '2'),
(3, '0', '0', '3'),
(4, '0', '0', '4'),
(100, '0', '1', '0'),
(101, '0', '1', '1'),
(102, '0', '1', '2'),
(103, '0', '1', '3'),
(104, '0', '1', '4'),
(200, '0', '2', '0'),
(201, '0', '2', '1'),
(202, '0', '2', '2'),
(203, '0', '2', '3'),
(204, '0', '2', '4'),
(300, '0', '3', '0'),
(301, '0', '3', '1'),
(302, '0', '3', '2'),
(303, '0', '3', '3'),
(304, '0', '3', '4'),
(400, '0', '4', '0'),
(401, '0', '4', '1'),
(402, '0', '4', '2'),
(403, '0', '4', '3'),
(404, '0', '4', '4'),
(500, '0', '5', '0'),
(501, '0', '5', '1'),
(502, '0', '5', '2'),
(503, '0', '5', '3'),
(504, '0', '5', '4'),
(600, '0', '6', '0'),
(601, '0', '6', '1'),
(602, '0', '6', '2'),
(603, '0', '6', '3'),
(604, '0', '6', '4'),
(700, '0', '7', '0'),
(701, '0', '7', '1'),
(702, '0', '7', '2'),
(703, '0', '7', '3'),
(704, '0', '7', '4'),
(800, '0', '8', '0'),
(801, '0', '8', '1'),
(802, '0', '8', '2'),
(803, '0', '8', '3'),
(804, '0', '8', '4'),
(900, '0', '9', '0'),
(901, '0', '9', '1'),
(902, '0', '9', '2'),
(903, '0', '9', '3'),
(904, '0', '9', '4'),
(10000, '1', '0', '0'),
(10001, '1', '0', '1'),
(10002, '1', '0', '2'),
(10003, '1', '0', '3'),
(10004, '1', '0', '4'),
(10100, '1', '1', '0'),
(10101, '1', '1', '1'),
(10102, '1', '1', '2'),
(10103, '1', '1', '3'),
(10104, '1', '1', '4'),
(10200, '1', '2', '0'),
(10201, '1', '2', '1'),
(10202, '1', '2', '2'),
(10203, '1', '2', '3'),
(10204, '1', '2', '4'),
(10300, '1', '3', '0'),
(10301, '1', '3', '1'),
(10302, '1', '3', '2'),
(10303, '1', '3', '3'),
(10304, '1', '3', '4'),
(10400, '1', '4', '0'),
(10401, '1', '4', '1'),
(10402, '1', '4', '2'),
(10403, '1', '4', '3'),
(10404, '1', '4', '4'),
(10500, '1', '5', '0'),
(10501, '1', '5', '1'),
(10502, '1', '5', '2'),
(10503, '1', '5', '3'),
(10504, '1', '5', '4'),
(10600, '1', '6', '0'),
(10601, '1', '6', '1'),
(10602, '1', '6', '2'),
(10603, '1', '6', '3'),
(10604, '1', '6', '4'),
(10700, '1', '7', '0'),
(10701, '1', '7', '1'),
(10702, '1', '7', '2'),
(10703, '1', '7', '3'),
(10704, '1', '7', '4'),
(10800, '1', '8', '0'),
(10801, '1', '8', '1'),
(10802, '1', '8', '2'),
(10803, '1', '8', '3'),
(10804, '1', '8', '4'),
(10900, '1', '9', '0'),
(10901, '1', '9', '1'),
(10902, '1', '9', '2'),
(10903, '1', '9', '3'),
(10904, '1', '9', '4'),
(20000, '2', '0', '0'),
(20001, '2', '0', '1'),
(20002, '2', '0', '2'),
(20003, '2', '0', '3'),
(20004, '2', '0', '4'),
(20100, '2', '1', '0'),
(20101, '2', '1', '1'),
(20102, '2', '1', '2'),
(20103, '2', '1', '3'),
(20104, '2', '1', '4'),
(20200, '2', '2', '0'),
(20201, '2', '2', '1'),
(20202, '2', '2', '2'),
(20203, '2', '2', '3'),
(20204, '2', '2', '4'),
(20300, '2', '3', '0'),
(20301, '2', '3', '1'),
(20302, '2', '3', '2'),
(20303, '2', '3', '3'),
(20304, '2', '3', '4'),
(20400, '2', '4', '0'),
(20401, '2', '4', '1'),
(20402, '2', '4', '2'),
(20403, '2', '4', '3'),
(20404, '2', '4', '4'),
(20500, '2', '5', '0'),
(20501, '2', '5', '1'),
(20502, '2', '5', '2'),
(20503, '2', '5', '3'),
(20504, '2', '5', '4'),
(20600, '2', '6', '0'),
(20601, '2', '6', '1'),
(20602, '2', '6', '2'),
(20603, '2', '6', '3'),
(20604, '2', '6', '4'),
(20700, '2', '7', '0'),
(20701, '2', '7', '1'),
(20702, '2', '7', '2'),
(20703, '2', '7', '3'),
(20704, '2', '7', '4'),
(20800, '2', '8', '0'),
(20801, '2', '8', '1'),
(20802, '2', '8', '2'),
(20803, '2', '8', '3'),
(20804, '2', '8', '4'),
(20900, '2', '9', '0'),
(20901, '2', '9', '1'),
(20902, '2', '9', '2'),
(20903, '2', '9', '3'),
(20904, '2', '9', '4'),
(30000, '3', '0', '0'),
(30001, '3', '0', '1'),
(30002, '3', '0', '2'),
(30003, '3', '0', '3'),
(30004, '3', '0', '4'),
(30100, '3', '1', '0'),
(30101, '3', '1', '1'),
(30102, '3', '1', '2'),
(30103, '3', '1', '3'),
(30104, '3', '1', '4'),
(30200, '3', '2', '0'),
(30201, '3', '2', '1'),
(30202, '3', '2', '2'),
(30203, '3', '2', '3'),
(30204, '3', '2', '4'),
(30300, '3', '3', '0'),
(30301, '3', '3', '1'),
(30302, '3', '3', '2'),
(30303, '3', '3', '3'),
(30304, '3', '3', '4'),
(30400, '3', '4', '0'),
(30401, '3', '4', '1'),
(30402, '3', '4', '2'),
(30403, '3', '4', '3'),
(30404, '3', '4', '4'),
(30500, '3', '5', '0'),
(30501, '3', '5', '1'),
(30502, '3', '5', '2'),
(30503, '3', '5', '3'),
(30504, '3', '5', '4'),
(30600, '3', '6', '0'),
(30601, '3', '6', '1'),
(30602, '3', '6', '2'),
(30603, '3', '6', '3'),
(30604, '3', '6', '4'),
(30700, '3', '7', '0'),
(30701, '3', '7', '1'),
(30702, '3', '7', '2'),
(30703, '3', '7', '3'),
(30704, '3', '7', '4'),
(30800, '3', '8', '0'),
(30801, '3', '8', '1'),
(30802, '3', '8', '2'),
(30803, '3', '8', '3'),
(30804, '3', '8', '4'),
(30900, '3', '9', '0'),
(30901, '3', '9', '1'),
(30902, '3', '9', '2'),
(30903, '3', '9', '3'),
(30904, '3', '9', '4'),
(40000, '4', '0', '0'),
(40001, '4', '0', '1'),
(40002, '4', '0', '2'),
(40003, '4', '0', '3'),
(40004, '4', '0', '4'),
(40100, '4', '1', '0'),
(40101, '4', '1', '1'),
(40102, '4', '1', '2'),
(40103, '4', '1', '3'),
(40104, '4', '1', '4'),
(40200, '4', '2', '0'),
(40201, '4', '2', '1'),
(40202, '4', '2', '2'),
(40203, '4', '2', '3'),
(40204, '4', '2', '4'),
(40300, '4', '3', '0'),
(40301, '4', '3', '1'),
(40302, '4', '3', '2'),
(40303, '4', '3', '3'),
(40304, '4', '3', '4'),
(40400, '4', '4', '0'),
(40401, '4', '4', '1'),
(40402, '4', '4', '2'),
(40403, '4', '4', '3'),
(40404, '4', '4', '4'),
(40500, '4', '5', '0'),
(40501, '4', '5', '1'),
(40502, '4', '5', '2'),
(40503, '4', '5', '3'),
(40504, '4', '5', '4'),
(40600, '4', '6', '0'),
(40601, '4', '6', '1'),
(40602, '4', '6', '2'),
(40603, '4', '6', '3'),
(40604, '4', '6', '4'),
(40700, '4', '7', '0'),
(40701, '4', '7', '1'),
(40702, '4', '7', '2'),
(40703, '4', '7', '3'),
(40704, '4', '7', '4'),
(40800, '4', '8', '0'),
(40801, '4', '8', '1'),
(40802, '4', '8', '2'),
(40803, '4', '8', '3'),
(40804, '4', '8', '4'),
(40900, '4', '9', '0'),
(40901, '4', '9', '1'),
(40902, '4', '9', '2'),
(40903, '4', '9', '3'),
(40904, '4', '9', '4'),
(50000, '5', '0', '0'),
(50001, '5', '0', '1'),
(50002, '5', '0', '2'),
(50003, '5', '0', '3'),
(50004, '5', '0', '4'),
(50100, '5', '1', '0'),
(50101, '5', '1', '1'),
(50102, '5', '1', '2'),
(50103, '5', '1', '3'),
(50104, '5', '1', '4'),
(50200, '5', '2', '0'),
(50201, '5', '2', '1'),
(50202, '5', '2', '2'),
(50203, '5', '2', '3'),
(50204, '5', '2', '4'),
(50300, '5', '3', '0'),
(50301, '5', '3', '1'),
(50302, '5', '3', '2'),
(50303, '5', '3', '3'),
(50304, '5', '3', '4'),
(50400, '5', '4', '0'),
(50401, '5', '4', '1'),
(50402, '5', '4', '2'),
(50403, '5', '4', '3'),
(50404, '5', '4', '4'),
(50500, '5', '5', '0'),
(50501, '5', '5', '1'),
(50502, '5', '5', '2'),
(50503, '5', '5', '3'),
(50504, '5', '5', '4'),
(50600, '5', '6', '0'),
(50601, '5', '6', '1'),
(50602, '5', '6', '2'),
(50603, '5', '6', '3'),
(50604, '5', '6', '4'),
(50700, '5', '7', '0'),
(50701, '5', '7', '1'),
(50702, '5', '7', '2'),
(50703, '5', '7', '3'),
(50704, '5', '7', '4'),
(50800, '5', '8', '0'),
(50801, '5', '8', '1'),
(50802, '5', '8', '2'),
(50803, '5', '8', '3'),
(50804, '5', '8', '4'),
(50900, '5', '9', '0'),
(50901, '5', '9', '1'),
(50902, '5', '9', '2'),
(50903, '5', '9', '3'),
(50904, '5', '9', '4'),
(60000, '6', '0', '0'),
(60001, '6', '0', '1'),
(60002, '6', '0', '2'),
(60003, '6', '0', '3'),
(60004, '6', '0', '4'),
(60100, '6', '1', '0'),
(60101, '6', '1', '1'),
(60102, '6', '1', '2'),
(60103, '6', '1', '3'),
(60104, '6', '1', '4'),
(60200, '6', '2', '0'),
(60201, '6', '2', '1'),
(60202, '6', '2', '2'),
(60203, '6', '2', '3'),
(60204, '6', '2', '4'),
(60300, '6', '3', '0'),
(60301, '6', '3', '1'),
(60302, '6', '3', '2'),
(60303, '6', '3', '3'),
(60304, '6', '3', '4'),
(60400, '6', '4', '0'),
(60401, '6', '4', '1'),
(60402, '6', '4', '2'),
(60403, '6', '4', '3'),
(60404, '6', '4', '4'),
(60500, '6', '5', '0'),
(60501, '6', '5', '1'),
(60502, '6', '5', '2'),
(60503, '6', '5', '3'),
(60504, '6', '5', '4'),
(60600, '6', '6', '0'),
(60601, '6', '6', '1'),
(60602, '6', '6', '2'),
(60603, '6', '6', '3'),
(60604, '6', '6', '4'),
(60700, '6', '7', '0'),
(60701, '6', '7', '1'),
(60702, '6', '7', '2'),
(60703, '6', '7', '3'),
(60704, '6', '7', '4'),
(60800, '6', '8', '0'),
(60801, '6', '8', '1'),
(60802, '6', '8', '2'),
(60803, '6', '8', '3'),
(60804, '6', '8', '4'),
(60900, '6', '9', '0'),
(60901, '6', '9', '1'),
(60902, '6', '9', '2'),
(60903, '6', '9', '3'),
(60904, '6', '9', '4'),
(70000, '7', '0', '0'),
(70001, '7', '0', '1'),
(70002, '7', '0', '2'),
(70003, '7', '0', '3'),
(70004, '7', '0', '4'),
(70100, '7', '1', '0'),
(70101, '7', '1', '1'),
(70102, '7', '1', '2'),
(70103, '7', '1', '3'),
(70104, '7', '1', '4'),
(70200, '7', '2', '0'),
(70201, '7', '2', '1'),
(70202, '7', '2', '2'),
(70203, '7', '2', '3'),
(70204, '7', '2', '4'),
(70300, '7', '3', '0'),
(70301, '7', '3', '1'),
(70302, '7', '3', '2'),
(70303, '7', '3', '3'),
(70304, '7', '3', '4'),
(70400, '7', '4', '0'),
(70401, '7', '4', '1'),
(70402, '7', '4', '2'),
(70403, '7', '4', '3'),
(70404, '7', '4', '4'),
(70500, '7', '5', '0'),
(70501, '7', '5', '1'),
(70502, '7', '5', '2'),
(70503, '7', '5', '3'),
(70504, '7', '5', '4'),
(70600, '7', '6', '0'),
(70601, '7', '6', '1'),
(70602, '7', '6', '2'),
(70603, '7', '6', '3'),
(70604, '7', '6', '4'),
(70700, '7', '7', '0'),
(70701, '7', '7', '1'),
(70702, '7', '7', '2'),
(70703, '7', '7', '3'),
(70704, '7', '7', '4'),
(70800, '7', '8', '0'),
(70801, '7', '8', '1'),
(70802, '7', '8', '2'),
(70803, '7', '8', '3'),
(70804, '7', '8', '4'),
(70900, '7', '9', '0'),
(70901, '7', '9', '1'),
(70902, '7', '9', '2'),
(70903, '7', '9', '3'),
(70904, '7', '9', '4'),
(80000, '8', '0', '0'),
(80001, '8', '0', '1'),
(80002, '8', '0', '2'),
(80003, '8', '0', '3'),
(80004, '8', '0', '4'),
(80100, '8', '1', '0'),
(80101, '8', '1', '1'),
(80102, '8', '1', '2'),
(80103, '8', '1', '3'),
(80104, '8', '1', '4'),
(80200, '8', '2', '0'),
(80201, '8', '2', '1'),
(80202, '8', '2', '2'),
(80203, '8', '2', '3'),
(80204, '8', '2', '4'),
(80300, '8', '3', '0'),
(80301, '8', '3', '1'),
(80302, '8', '3', '2'),
(80303, '8', '3', '3'),
(80304, '8', '3', '4'),
(80400, '8', '4', '0'),
(80401, '8', '4', '1'),
(80402, '8', '4', '2'),
(80403, '8', '4', '3'),
(80404, '8', '4', '4'),
(80500, '8', '5', '0'),
(80501, '8', '5', '1'),
(80502, '8', '5', '2'),
(80503, '8', '5', '3'),
(80504, '8', '5', '4'),
(80600, '8', '6', '0'),
(80601, '8', '6', '1'),
(80602, '8', '6', '2'),
(80603, '8', '6', '3'),
(80604, '8', '6', '4'),
(80700, '8', '7', '0'),
(80701, '8', '7', '1'),
(80702, '8', '7', '2'),
(80703, '8', '7', '3'),
(80704, '8', '7', '4'),
(80800, '8', '8', '0'),
(80801, '8', '8', '1'),
(80802, '8', '8', '2'),
(80803, '8', '8', '3'),
(80804, '8', '8', '4'),
(80900, '8', '9', '0'),
(80901, '8', '9', '1'),
(80902, '8', '9', '2'),
(80903, '8', '9', '3'),
(80904, '8', '9', '4'),
(90000, '9', '0', '0'),
(90001, '9', '0', '1'),
(90002, '9', '0', '2'),
(90003, '9', '0', '3'),
(90004, '9', '0', '4'),
(90100, '9', '1', '0'),
(90101, '9', '1', '1'),
(90102, '9', '1', '2'),
(90103, '9', '1', '3'),
(90104, '9', '1', '4'),
(90200, '9', '2', '0'),
(90201, '9', '2', '1'),
(90202, '9', '2', '2'),
(90203, '9', '2', '3'),
(90204, '9', '2', '4'),
(90300, '9', '3', '0'),
(90301, '9', '3', '1'),
(90302, '9', '3', '2'),
(90303, '9', '3', '3'),
(90304, '9', '3', '4'),
(90400, '9', '4', '0'),
(90401, '9', '4', '1'),
(90402, '9', '4', '2'),
(90403, '9', '4', '3'),
(90404, '9', '4', '4'),
(90500, '9', '5', '0'),
(90501, '9', '5', '1'),
(90502, '9', '5', '2'),
(90503, '9', '5', '3'),
(90504, '9', '5', '4'),
(90600, '9', '6', '0'),
(90601, '9', '6', '1'),
(90602, '9', '6', '2'),
(90603, '9', '6', '3'),
(90604, '9', '6', '4'),
(90700, '9', '7', '0'),
(90701, '9', '7', '1'),
(90702, '9', '7', '2'),
(90703, '9', '7', '3'),
(90704, '9', '7', '4'),
(90800, '9', '8', '0'),
(90801, '9', '8', '1'),
(90802, '9', '8', '2'),
(90803, '9', '8', '3'),
(90804, '9', '8', '4'),
(90900, '9', '9', '0'),
(90901, '9', '9', '1'),
(90902, '9', '9', '2'),
(90903, '9', '9', '3'),
(90904, '9', '9', '4');

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
(1, 13, 20),
(1, 14, 20),
(1, 15, 10),
(1, 16, 20),
(1, 17, 10);

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
('1', 54, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Id_Produit`, `Prix`, `Ref`, `Nombre_boites`, `Poids`, `Marque`, `Gamme`, `Famille`, `Designation`, `Description`, `Url_Image`) VALUES
(10, 19.9, 'CO4444', 6, 600, 'Nouveauté Ocean', 'Sardine', 'Coffret', 'Assortiment de sardines ', ' 6 conserves de 100 g.  Une invitation à la découverte et aux saveurs onctueuses de la sardine \r\n1- sardines à l\'huile d\'olive \r\n1 - sardines à l\'huile d\'olive et citron \r\n1 - sardines à l\'huile d\'olive et piment\r\n1 - sardines à l\'huile de colza \r\n1 - sardines à la tomate\r\n1 - sardines au beurre de baratte\r\n', 'images/Produits/coffret/coffret.jpg'),
(11, 15.9, 'CO3333', 3, 450, 'Tradition Ocean', 'Thon', 'Coffret ', 'Assortiment Thon', '3 conserves de 100 g.  Une invitation à la découverte et aux saveurs onctueuses du thon blanc germon.\r\nUn assortiment varié de thons en tranche au naturel, à l\'huile d\'olive vierge extra, au poivre vert et aux épices et aromates.\r\n', 'images/Produits/coffret/coffret3.jpg'),
(12, 11.9, 'CO2222', 3, 300, 'Nouveauté Ocean', 'Multiples', 'Coffret ', 'Coffrets émiettés multiples', '3 conserves de 100 g.  Une association inédite d’émiettés, idéale en accompagnement de pâtes, en salade, en quiche ou même à l’apéritif.\r\nPour la première fois, un assortiment d’émiettés permet de s’amuser à comparer les saveurs du thon, le caractère du maquereau et la délicatesse de la sardine. \r\n', 'images/Produits/coffret/coffret4.jpg'),
(13, 18.9, 'CO1111', 4, 800, 'Tradition Ocean', 'Maquereaux', 'Coffret', 'Assortiment de filets de maquereaux\r\n', '4 conserves de 100 g.  Un assortiment varié de filets de maquereaux marinés au vin blanc et aux aromates, aux herbes de Provence et épices Harissa, au curry et amandes, à la tomate, à la moutarde, à l\'huile d\'olive citron et 5 baies ou encore façon diablesse.\r\n\r\n', 'images/Produits/coffret/coffret5.jpg'),
(14, 18.9, 'CO5555', 4, 400, 'Tradition Ocean', 'Sardine', 'Coffret ', 'Assortiment illustré de sardines\r\n', ' 4 conserves de 100 g.  Ce beau coffret est à découvrir ou à offrir. Il contient 4 boîtes de sardines de 100 g chacune. \r\n-La sardine au pastis \r\n-La Pescadou \r\n-Les sardines à l’huile d’olive vierge extra \r\n-Les pitchounettes sont des petites sardines (et donc moins grasse) à l’huile d’olive.\r\n', 'images/Produits/coffret/coffret2.jpg'),
(15, 3.9, 'CC2222', 1, 100, 'Nouveauté Ocean', 'Maquereaux', 'Conserve', 'Filet de maquereau aux blanc\r\n', ' Les maquereaux à l’huile d’olive est l’accompagnement idéal pour vos entrées, apéritifs dînatoires ou sandwichs.\r\n', 'images/Produits/conserves/conserves2.jpg'),
(16, 3.9, 'CC1111', 1, 100, 'Nouveauté Ocean', 'Thon', 'Conserve', 'Thon à l’huile de Tournesol', 'Les maquereaux à l’huile d’olive est l’accompagnement idéal pour vos entrées, apéritifs dînatoires ou sandwichs.\r\n', 'images/Produits/conserves/conserves.jpg'),
(17, 4.9, 'CC3333', 1, 100, 'Tradition Ocean', 'Sardine', 'Conserve', 'Sardines sans arêtes', ' Les maquereaux à l’huile d’olive est l’accompagnement idéal pour vos entrées, apéritifs dînatoires ou sandwichs.\r\n', 'images/Produits/conserves/conserves4.jpg'),
(18, 3.9, 'CC4444', 1, 100, 'Nouveauté Ocean', 'Sardine', 'Conserve', 'Sardines cuites à la vapeur', 'Sardine cuite à la vapeur. Produit plus digeste et plus légère.', 'images/Produits/conserves/conserves3.jpg'),
(19, 14.9, 'PP2222\r\n', 1, 400, 'Tradition Ocean', 'Sardine', 'Plat', 'Ravioli de thon au coulis de Langoustines', ' Farcis de sardine et à la ricotta, nos raviolis sont accompagnés d\'une délicieuse sauce préparée à partir de langoustines entières. . Pour 2 à 3 Personnes', 'images/Produits/plats_prepares/platprepare.jpg'),
(21, 10.9, 'PP3333', 1, 400, 'Tradition Ocean', 'Thon', 'Plat', 'Thon à la bretonne à la crème et aux poireaux\r\n', NULL, 'images/Produits/plats_prepares/platprepare3.jpg'),
(26, 12.9, 'PP1111', 1, 400, 'Tradition Ocean', 'Thon', 'Plat', 'Thon à la concarnoise', 'De beaux morceaux de thon  et une sauce made in Bretagne : des oignons et des échalotes revenus dans du beurre et du vin blanc et un tour de main incontestable pour vous faire plaisir en un clin d\'oeil . Pour 2 à 3 Personnes', 'images/Produits/plats_prepares/platprepare4.jpg'),
(27, 3.9, 'CC5555', 1, 100, 'Tradition  Ocean', 'Thon', 'Conserve', ' Thon naturel', 'Le thon listao naturel pleine de fraîcheur et légèrement acidulé pour égayer l\'été.\r\n', 'images/Produits/conserves/conserves5.jpg'),
(28, 4.9, 'CC5566', 1, 100, 'Tradition  Ocean', 'Thon', 'Conserve', 'Sardine à l’ancienne au citron', ' Le sardine naturel pleine de fraîcheur et légèrement acidulé au citron pour égayer l\'été\r\n', 'images/Produits/conserves/conserves6.jpg'),
(29, 4.9, 'CC5567', 1, 100, 'Tradition  Ocean', 'Thon', 'Conserve', 'Sardine à l’ancienne au piment d\'espelette', 'Le sardine naturel pleine de fraîcheur et légèrement acidulé au piment d\'espelette pour égayer l\'été.', 'images/Produits/conserves/conserves7.jpg'),
(30, 4.9, 'CC7777', 1, 100, 'Tradition  Ocean', 'Thon', 'Conserve', 'Sardine à la tomate', 'Le sardine naturel pleine de fraîcheur et légèrement acidulé pour égayer l\'été.\r\n', 'images/Produits/conserves/conserves8.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `retour`
--

DROP TABLE IF EXISTS `retour`;
CREATE TABLE IF NOT EXISTS `retour` (
  `Id_Commande` int(11) NOT NULL,
  `id_Produit` int(11) NOT NULL,
  `raison` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `Date_limite` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `retour`
--

INSERT INTO `retour` (`Id_Commande`, `id_Produit`, `raison`, `description`, `Date_limite`) VALUES
(54, 15, 'Produit non conforme', 'Description', '2018-04-05'),
(54, 15, 'Produit non conforme', 'Description', '2018-04-05'),
(54, 15, 'Emballage abimé', 'Pas cool', '2018-04-05'),
(54, 15, 'Emballage abimé', 'hey', '2018-04-05'),
(54, 15, 'Emballage abimé', 'heh', '2018-04-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
