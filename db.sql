
--
-- Base de données :  `db`
--

-- --------------------------------------------------------

-- -------------------------------------
-- Structure de la table `adresse`
-- -------------------------------------
DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `Id_Adresse` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Client` int(10) NOT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Postal_Code` int(6) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Pays` char(255) DEFAULT NULL,
  `Status` char(1) DEFAULT NULL,  -- 'P' si c'est l'adresse principal du client,
                                  -- 'B' si c'est l'adresse d'une boutique,
                                  -- 'S' si c'est l'adresse secondaire du client
  PRIMARY KEY (`Id_Adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Structure de la table `boutique`
-- -------------------------------------
DROP TABLE IF EXISTS `boutique`;
CREATE TABLE IF NOT EXISTS `boutique` (
  `ID_Boutique` int(10) NOT NULL AUTO_INCREMENT,
  `Dirigeant` varchar(255) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Url_Boutique` varchar(255) DEFAULT NULL,
  `Horaire` text DEFAULT NULL,
  PRIMARY KEY (`ID_Boutique`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Structure de la table `commande`
-- -------------------------------------
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


-- -------------------------------------
-- Structure de la table `compte`
-- -------------------------------------
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
  `Status` char(1) DEFAULT NULL,  -- 'C' si c'est client,
                                  -- 'E' si c'est employee
                                  -- 'A' si c'est admin
  PRIMARY KEY (`ID_Client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Structure de la table `emplacement_`
-- -------------------------------------
DROP TABLE IF EXISTS `emplacement_`;
CREATE TABLE IF NOT EXISTS `emplacement_` (
  `Id_Emplacement` int(10) NOT NULL AUTO_INCREMENT,
  `Couloir` varchar(6) DEFAULT NULL,
  `Trave` varchar(6) DEFAULT NULL,
  `Etagere` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`Id_Emplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------
-- Structure de la table `est_placer`
-- -------------------------------------
DROP TABLE IF EXISTS `est_placer`;
CREATE TABLE IF NOT EXISTS `est_placer` (
  `Id_Emplacement` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Produit` int(10) NOT NULL,
  `Quantite_stock` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Emplacement`,`Id_Produit`),
  KEY `FK_Est_placer_Id_Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Structure de la table `lignecommande`
-- -------------------------------------
DROP TABLE IF EXISTS `lignecommande`;
CREATE TABLE IF NOT EXISTS `lignecommande` (
  `Quantite` varchar(20) DEFAULT NULL,
  `Id_Commande` int(10) NOT NULL,
  `Id_Produit` int(10) NOT NULL,
  PRIMARY KEY (`Id_Commande`, `Id_Produit`),
  KEY `FK_LigneCommande_Id_Commande` (`Id_Commande`),
  KEY `FK_LigneCommande_Id_Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Structure de la table `produit`
-- -------------------------------------
DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_Produit` int(10) NOT NULL AUTO_INCREMENT,
  `Prix` float DEFAULT NULL,
  `Ref` varchar(10) DEFAULT NULL,   -- Ref = {Base, Compose}
  `Nombre_boites` int(10) DEFAULT NULL,
  `Poids` int(10) DEFAULT NULL,
  `Marque` varchar(30) DEFAULT NULL,
  `Gamme` varchar(60) DEFAULT NULL,
  `Famille` varchar(60) DEFAULT NULL,
  `Designation` varchar(40) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Url_Image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_Produit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Intermediare `produit` et commande
-- -------------------------------------
DROP TABLE IF EXISTS `produitboutique`;
CREATE TABLE IF NOT EXISTS `produitboutique` (
  `pid` int(10) NOT NULL,
  `bid` int(10) NOT NULL,
  `Quantite` int(10) DEFAULT NULL,
  PRIMARY KEY (`pid`, `bid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


-- -------------------------------------
-- Déchargement des données de la table `produit` et 'compte'
-- -------------------------------------

INSERT INTO `produit` (`Prix`, `Ref`, `Nombre_boites`, `Poids`, `Marque`, `Gamme`, `Famille`, `Designation`, `Description`, `Url_Image`) VALUES
(10, 'Base', 2, '100', 'Tradition', 'Sardine', 'Classique', 'produit de gamme1 marque1 et famille1', 'description bal bla ici', 'images/sardine1.jpg'),
(20, 'Base', 1, '120', 'Tradition', 'Coquillage', 'Classique', 'produit de gamme2 marque2 et famille2', 'c\'est du pipo', 'images/sardine3.jpg'),
(10, 'Compose', 10, '100', 'Ocean', 'Sardine', 'Assortiment', 'produit de gamme3 marque3 et famille3', 'c\'est bon ce truc', 'images/sardine1.jpg'),
(12, 'Compose', 6, '290', 'Ocean', 'Coquillage', 'Classique', 'Heyheyhey', 'description', 'images/sardine3.jpg'),
(20, 'Base', 4, '400', 'Lac', 'Sardine', 'Assortiment', 'Heyheyhey5', 'description5', 'images/sardine3.jpg');

INSERT INTO `compte` (`nom`, `prenom`, `tel`, `email`, `civilite`, `password`, `status`) VALUES
('Admin', 'LEMAITRE', '0101010101', 'admin@lvs.fr', 'M', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'A'),
('Employ', 'LESOUS', '0201010101', 'employe@lvs.fr', 'Mme', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'E'),
('Pigeon', 'TOURISTE', '0234890101', 'pigeon@gmail.fr', 'M', '3ca7f3b5755bba5adabe0790c216d55b3bdf30587efb4f0561556bbf1c75b5e6', 'C');
--password pour employe@lvs.fr et admin@lvs.fr => root
--password pour pigeon@gmail.fr => dauphine