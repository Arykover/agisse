-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 23 Janvier 2017 à 09:38
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gisse`
--

-- --------------------------------------------------------

--
-- Structure de la table `civilite`
--

CREATE TABLE `civilite` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `cle` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`id`, `login`, `pass`, `nom`, `prenom`, `mail`, `type`, `cle`) VALUES
(1, 'administrateur', 'administrateur', 'administrateur', 'administrateur', 'administrateur', 1, 'e0ca758d-dd99-11e6-8dfd-7a791935ce5f');

--
-- Déclencheurs `comptes`
--
DELIMITER $$
CREATE TRIGGER `fiche_eleve` AFTER INSERT ON `comptes` FOR EACH ROW BEGIN
	if new.type = 3 then
		insert INTO fiches(id) VALUES (new.id);
    end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generation_cle` BEFORE INSERT ON `comptes` FOR EACH ROW SET new.cle = uuid()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `discipline`
--

CREATE TABLE `discipline` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `annee_par_cycle` int(11) DEFAULT NULL,
  `cycle_etude_actuel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `fiches`
--

CREATE TABLE `fiches` (
  `id` int(11) NOT NULL,
  `nom_usage` varchar(100) DEFAULT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `comp_adresse` varchar(150) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `date_naiss` date DEFAULT NULL,
  `dept_naiss` varchar(2) DEFAULT NULL,
  `commune_naissance` varchar(100) DEFAULT NULL,
  `num_secu` varchar(15) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `justificatif` smallint(6) DEFAULT NULL,
  `observations_eleve` varchar(250) DEFAULT NULL,
  `observations_gest` varchar(250) DEFAULT NULL,
  `discipline` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `nationalite` varchar(5) DEFAULT NULL,
  `civilite` int(11) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `mutuelle` varchar(5) DEFAULT NULL,
  `date_effet_affiliation` date DEFAULT NULL,
  `date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `info_etablissmeent`
--

CREATE TABLE `info_etablissmeent` (
  `id` int(11) NOT NULL,
  `denomination` varchar(100) DEFAULT NULL,
  `caisse_prim` varchar(6) DEFAULT NULL,
  `n_agrement` varchar(6) DEFAULT NULL,
  `annee_scolaire` varchar(9) DEFAULT NULL,
  `code_grand_regime` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `mutuelle`
--

CREATE TABLE `mutuelle` (
  `code` varchar(5) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `nationalite`
--

CREATE TABLE `nationalite` (
  `code` varchar(5) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `code` int(11) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `libelle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `libelle`) VALUES
(1, 'administrateur'),
(2, 'gestionnaire'),
(3, 'eleve');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `civilite`
--
ALTER TABLE `civilite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Index pour la table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id`);


--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`code`);

--
--
-- Index pour la table `fiches`
--
ALTER TABLE `fiches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discipline` (`discipline`),
  ADD KEY `statut` (`statut`),
  ADD KEY `nationalite` (`nationalite`),
  ADD KEY `civilite` (`civilite`),
  ADD KEY `mutuelle` (`mutuelle`),
  ADD KEY `etat` (`etat`);

--
-- Index pour la table `info_etablissmeent`
--
ALTER TABLE `info_etablissmeent`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mutuelle`
--
ALTER TABLE `mutuelle`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `nationalite`
--
ALTER TABLE `nationalite`
  ADD PRIMARY KEY (`code`);


-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `civilite`
--
ALTER TABLE `civilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `info_etablissmeent`
--
ALTER TABLE `info_etablissmeent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `fiches`
--
ALTER TABLE `fiches`
  ADD CONSTRAINT `fiches_ibfk_1` FOREIGN KEY (`id`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `fiches_ibfk_2` FOREIGN KEY (`discipline`) REFERENCES `discipline` (`id`),
  ADD CONSTRAINT `fiches_ibfk_3` FOREIGN KEY (`statut`) REFERENCES `statut` (`id`),
  ADD CONSTRAINT `fiches_ibfk_4` FOREIGN KEY (`nationalite`) REFERENCES `nationalite` (`code`),
  ADD CONSTRAINT `fiches_ibfk_5` FOREIGN KEY (`civilite`) REFERENCES `civilite` (`id`),
  ADD CONSTRAINT `fiches_ibfk_6` FOREIGN KEY (`mutuelle`) REFERENCES `mutuelle` (`code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
