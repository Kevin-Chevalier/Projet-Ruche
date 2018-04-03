-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 03 Avril 2018 à 12:21
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ruche`
--

-- --------------------------------------------------------

--
-- Structure de la table `abeilles`
--

CREATE TABLE `abeilles` (
  `idabeilles` int(11) NOT NULL,
  `beeinside` tinyint(4) DEFAULT NULL,
  `beeoutside` varchar(45) DEFAULT NULL,
  `date` datetime NOT NULL,
  `ruches_idRuches` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Alertes_1hour`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Alertes_1hour` (
`tempval` float
,`date` datetime
,`poidsval` float
);

-- --------------------------------------------------------

--
-- Structure de la table `apiculteurs`
--

CREATE TABLE `apiculteurs` (
  `idapiculteurs` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `mdp` varchar(45) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `apiculteurs`
--

INSERT INTO `apiculteurs` (`idapiculteurs`, `login`, `mdp`, `nom`, `prenom`, `telephone`, `email`) VALUES
(1, '', '', 'Chevalier', 'Kevin', '0658280206', 'kevin.antoine.chevalier@gmail.com'),
(2, 'al_user', 'toto', 'Toshi', 'Algin', '0600000000', 'toshi.algin@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

CREATE TABLE `mesures` (
  `idonnees` int(11) NOT NULL,
  `eclairementval` float NOT NULL,
  `pressionval` float NOT NULL,
  `tempval` float NOT NULL,
  `poidsval` float NOT NULL,
  `date` datetime NOT NULL,
  `ruches_idRuches` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mesures`
--

INSERT INTO `mesures` (`idonnees`, `eclairementval`, `pressionval`, `tempval`, `poidsval`, `date`, `ruches_idRuches`) VALUES
(1, 20, 1020, 21, 45, '2018-03-30 08:30:00', 1),
(4, 0, 0, 41, 45, '2018-04-03 09:14:24', 1),
(5, 0, 0, 41, 45, '2018-04-03 09:15:46', 1),
(6, 0, 0, 41, 45, '2018-04-03 09:19:33', 1),
(7, 0, 0, 41, 45, '2018-04-03 09:22:24', 1),
(8, 0, 0, 41, 45, '2018-04-03 09:37:01', 1),
(9, 0, 0, 51, 45, '2018-04-03 09:45:56', 1),
(10, 0, 0, 18, 39, '2018-04-03 12:05:37', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ruches`
--

CREATE TABLE `ruches` (
  `idRuches` int(11) NOT NULL,
  `seuilPoids` float DEFAULT NULL,
  `seuilTempBasse` float DEFAULT NULL,
  `seuilTempHaute` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `lattitude` float DEFAULT NULL,
  `altitude` float DEFAULT NULL,
  `apiculteurs_idapiculteurs` int(11) NOT NULL,
  `descriptionRuche` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ruches`
--

INSERT INTO `ruches` (`idRuches`, `seuilPoids`, `seuilTempBasse`, `seuilTempHaute`, `longitude`, `lattitude`, `altitude`, `apiculteurs_idapiculteurs`, `descriptionRuche`) VALUES
(1, 40, -5, 20, 0.204433, 47.9957, 40, 1, '');

-- --------------------------------------------------------

--
-- Structure de la vue `Alertes_1hour`
--
DROP TABLE IF EXISTS `Alertes_1hour`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `Alertes_1hour`  AS  select `mesures`.`tempval` AS `tempval`,`mesures`.`date` AS `date`,`mesures`.`poidsval` AS `poidsval` from (`mesures` join `ruches`) where (((`mesures`.`tempval` > `ruches`.`seuilTempHaute`) or (`mesures`.`poidsval` < `ruches`.`seuilPoids`)) and (`mesures`.`date` >= (now() - interval 1 hour))) ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abeilles`
--
ALTER TABLE `abeilles`
  ADD PRIMARY KEY (`idabeilles`),
  ADD KEY `fk_abeilles_ruches1_idx` (`ruches_idRuches`);

--
-- Index pour la table `apiculteurs`
--
ALTER TABLE `apiculteurs`
  ADD PRIMARY KEY (`idapiculteurs`);

--
-- Index pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD PRIMARY KEY (`idonnees`),
  ADD KEY `fk_donneesval_ruches1_idx` (`ruches_idRuches`);

--
-- Index pour la table `ruches`
--
ALTER TABLE `ruches`
  ADD PRIMARY KEY (`idRuches`),
  ADD KEY `fk_ruches_apiculteurs_idx` (`apiculteurs_idapiculteurs`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `apiculteurs`
--
ALTER TABLE `apiculteurs`
  MODIFY `idapiculteurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `mesures`
--
ALTER TABLE `mesures`
  MODIFY `idonnees` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `ruches`
--
ALTER TABLE `ruches`
  MODIFY `idRuches` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abeilles`
--
ALTER TABLE `abeilles`
  ADD CONSTRAINT `fk_abeilles_ruches1` FOREIGN KEY (`ruches_idRuches`) REFERENCES `ruches` (`idRuches`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD CONSTRAINT `fk_donneesval_ruches1` FOREIGN KEY (`ruches_idRuches`) REFERENCES `ruches` (`idRuches`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ruches`
--
ALTER TABLE `ruches`
  ADD CONSTRAINT `fk_ruches_apiculteurs` FOREIGN KEY (`apiculteurs_idapiculteurs`) REFERENCES `apiculteurs` (`idapiculteurs`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
