-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 avr. 2023 à 22:22
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `examgenerator`
--

-- --------------------------------------------------------

--
-- Structure de la table `anneescolaire`
--

DROP TABLE IF EXISTS `anneescolaire`;
CREATE TABLE IF NOT EXISTS `anneescolaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateDeb` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `anneescolaire`
--

INSERT INTO `anneescolaire` (`id`, `dateDeb`, `dateFin`) VALUES
(1, '2022-09-01 19:21:29', '2023-06-30 19:21:29');

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `idCursus` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`idCursus`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cursus`
--

INSERT INTO `cursus` (`idCursus`, `libelle`) VALUES
(55, 'Science de l\'ingenieur'),
(56, 'Informatique et Mobilite'),
(57, 'MIAGE'),
(58, 'STAPS');

-- --------------------------------------------------------

--
-- Structure de la table `cursusmatiere`
--

DROP TABLE IF EXISTS `cursusmatiere`;
CREATE TABLE IF NOT EXISTS `cursusmatiere` (
  `Cursus_idCursus` int(11) NOT NULL,
  `Matiere_idMatiere` int(11) NOT NULL,
  PRIMARY KEY (`Cursus_idCursus`,`Matiere_idMatiere`),
  KEY `fk_Cursus_has_Matiere_Matiere1_idx` (`Matiere_idMatiere`),
  KEY `fk_Cursus_has_Matiere_Cursus1_idx` (`Cursus_idCursus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cursusmatiere`
--

INSERT INTO `cursusmatiere` (`Cursus_idCursus`, `Matiere_idMatiere`) VALUES
(55, 4),
(58, 4),
(58, 41),
(55, 42),
(58, 43);

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `idExamen` int(11) NOT NULL,
  `intitule` varchar(200) NOT NULL,
  `coefficient` int(11) NOT NULL DEFAULT '1',
  `TypeEval_idTypeEval` int(11) NOT NULL,
  PRIMARY KEY (`idExamen`),
  KEY `fk_Examen_TypeEval1_idx` (`TypeEval_idTypeEval`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`idExamen`, `intitule`, `coefficient`, `TypeEval_idTypeEval`) VALUES
(1, 'POO n°1', 3, 2),
(2, 'POO & Archi n°1', 5, 1),
(3, 'Archi n°2', 1, 2),
(4, 'Examen Test', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `idMatiere` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(45) NOT NULL,
  PRIMARY KEY (`idMatiere`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`idMatiere`, `intitule`) VALUES
(4, 'Reconnaissance d\'images'),
(41, 'Architectures N-tiers'),
(42, 'Méthodes Agiles'),
(43, 'OpenGLES');

-- --------------------------------------------------------

--
-- Structure de la table `matieresujet`
--

DROP TABLE IF EXISTS `matieresujet`;
CREATE TABLE IF NOT EXISTS `matieresujet` (
  `Matiere_idMatiere` int(11) NOT NULL,
  `Sujet_idSujet` int(11) NOT NULL,
  PRIMARY KEY (`Matiere_idMatiere`,`Sujet_idSujet`),
  KEY `fk_Matiere_has_Sujet_Sujet1_idx` (`Sujet_idSujet`),
  KEY `fk_Matiere_has_Sujet_Matiere1_idx` (`Matiere_idMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matieresujet`
--

INSERT INTO `matieresujet` (`Matiere_idMatiere`, `Sujet_idSujet`) VALUES
(4, 1),
(43, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `idNiveau` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(10) NOT NULL,
  PRIMARY KEY (`idNiveau`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`idNiveau`, `intitule`) VALUES
(24, 'L1'),
(25, 'L2'),
(26, 'L3'),
(27, 'M1');

-- --------------------------------------------------------

--
-- Structure de la table `niveaucursus`
--

DROP TABLE IF EXISTS `niveaucursus`;
CREATE TABLE IF NOT EXISTS `niveaucursus` (
  `Niveau_idNiveau` int(11) NOT NULL,
  `Cursus_idCursus` int(11) NOT NULL,
  PRIMARY KEY (`Niveau_idNiveau`,`Cursus_idCursus`),
  KEY `fk_Niveau_has_Cursus_Cursus1_idx` (`Cursus_idCursus`),
  KEY `fk_Niveau_has_Cursus_Niveau1_idx` (`Niveau_idNiveau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `niveaucursus`
--

INSERT INTO `niveaucursus` (`Niveau_idNiveau`, `Cursus_idCursus`) VALUES
(27, 57),
(27, 58);

-- --------------------------------------------------------

--
-- Structure de la table `onglet`
--

DROP TABLE IF EXISTS `onglet`;
CREATE TABLE IF NOT EXISTS `onglet` (
  `idOnglet` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(45) NOT NULL,
  PRIMARY KEY (`idOnglet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `qestiondansexamen`
--

DROP TABLE IF EXISTS `qestiondansexamen`;
CREATE TABLE IF NOT EXISTS `qestiondansexamen` (
  `Question_id` int(11) NOT NULL,
  `Examen_idExamen` int(11) NOT NULL,
  `nbPointsPersonnalise` int(11) DEFAULT NULL,
  PRIMARY KEY (`Question_id`,`Examen_idExamen`),
  KEY `fk_Question_has_Examen_Examen1_idx` (`Examen_idExamen`),
  KEY `fk_Question_has_Examen_Question1_idx` (`Question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `qestiondansexamen`
--

INSERT INTO `qestiondansexamen` (`Question_id`, `Examen_idExamen`, `nbPointsPersonnalise`) VALUES
(251, 1, 1),
(251, 4, 1),
(252, 1, 1),
(252, 4, 1),
(253, 1, 1),
(254, 1, 5),
(254, 2, 1),
(255, 1, 1),
(255, 2, 1),
(256, 1, 1),
(256, 2, 1),
(257, 1, 1),
(257, 2, 1),
(259, 1, 1),
(259, 2, 1),
(260, 1, 1),
(260, 2, 1),
(261, 1, 1),
(261, 2, 1),
(262, 2, 1),
(263, 2, 1),
(264, 2, 1),
(265, 1, 1),
(265, 2, 5),
(265, 3, 1),
(265, 4, 3),
(266, 1, 1),
(266, 2, 5),
(266, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nbPointsDefaut` int(11) NOT NULL,
  `reponse` varchar(200) DEFAULT NULL,
  `question` varchar(200) NOT NULL,
  `Sujet_idSujet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Question_Sujet1_idx` (`Sujet_idSujet`)
) ENGINE=InnoDB AUTO_INCREMENT=267 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `nbPointsDefaut`, `reponse`, `question`, `Sujet_idSujet`) VALUES
(251, 1, 'Oui', 'Est-ce que nous pouvons changer le type de retour d’une méthode redéfinie dans une sous-classe ?', 1),
(252, 1, 'C’est la possibilité de changer le type de retour d’une méthode redéfinie dans une sous-classe', 'Qu’est-ce que la covariance de type de méthode redéfinie dans Java ?', 3),
(253, 1, 'C’est la possibilité de changer le type de paramètre d’une méthode redéfinie dans une sous-classe', 'Qu’est-ce que la contravariance de type de méthode redéfinie dans Java ?', 3),
(254, 1, 'C’est la possibilité d’appliquer une méthode sur un objet de type de la classe de cette méthode', 'Qu’est-ce que la réflexivité ?', 1),
(255, 1, 'Oui', 'Pouvons-nous avoir une méthode non abstraite à l’intérieur d’une interface ?', 1),
(256, 1, 'C’est la possibilité d’avoir plusieurs méthodes avec le même nom mais avec des paramètres différents', 'Qu’est-ce que la surcharge ?', 1),
(257, 1, 'Composition est une relation entre deux classes alors que l’héritage est une relation entre deux classes et une interface', 'Quelle est la différence entre Composition et Héritage dans la POO ?', 1),
(259, 1, 'Abstraction, Encapsulation et Héritage', 'Quels sont les 3 piliers de la programmation orienté objet ?', 1),
(260, 1, ' représenter un concept de la vie réelle', 'Quel est le rôle d\'un objet dans la programmation objet ?', 1),
(261, 1, 'La programmation orientée objet est un paradigme de programmation qui permet de modéliser des objets du monde réel en classes et d\'interagir entre eux', 'Expliquez brièvement ce que vous entendez par programmation orientée objet en Java ?', 1),
(262, 1, 'Non, Java est un langage orienté objet mais il est aussi un langage orienté procédure', 'Expliquez Java est-il un langage purement orienté objet ?', 1),
(263, 1, 'Une classe est un modèle de conception qui décrit les états et les comportements communs à tous les objets d\'un certain type. Un objet est une instance de classe', 'Décrivez la classe et l\'objet en Java ?', 3),
(264, 1, 'Une classe est un modèle de conception qui décrit les états et les comportements communs à tous les objets d\'un certain type. Un objet est une instance de classe', 'Quelles sont les différences entre la classe et les objets en Java ?', 3),
(265, 1, 'Oui, l\'architecture informatique est une partie de l\'organisation informatique', 'L\'architecture informatique est-elle différente d\'une organisation informatique ?', 2),
(266, 1, '___', 'Connaissez-vous les composants de base utilisés par un microprocesseur? Expliquer.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `saisie` varchar(255) NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponsequestion`
--

DROP TABLE IF EXISTS `reponsequestion`;
CREATE TABLE IF NOT EXISTS `reponsequestion` (
  `Reponse_idReponse` int(11) NOT NULL,
  `Question_id` int(11) NOT NULL,
  PRIMARY KEY (`Question_id`,`Reponse_idReponse`),
  KEY `fk_Reponse_has_Question_Question1_idx` (`Question_id`),
  KEY `fk_Reponse_has_Question_Reponse1_idx` (`Reponse_idReponse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponseutilisateur`
--

DROP TABLE IF EXISTS `reponseutilisateur`;
CREATE TABLE IF NOT EXISTS `reponseutilisateur` (
  `Utilisateur_id` int(11) NOT NULL,
  `Question_id` int(11) DEFAULT NULL,
  `dateHeure` datetime NOT NULL,
  `reponseSaisie` varchar(255) DEFAULT NULL,
  `noteAttribuee` int(11) DEFAULT NULL,
  `Question_id1` int(11) NOT NULL,
  PRIMARY KEY (`Utilisateur_id`,`Question_id1`),
  KEY `fk_Utilisateur_has_Question_Question1_idx` (`Question_id`),
  KEY `fk_Utilisateur_has_Question_Utilisateur_idx` (`Utilisateur_id`),
  KEY `fk_ReponseUtilisateur_Question1_idx` (`Question_id1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponseutilisateur`
--

INSERT INTO `reponseutilisateur` (`Utilisateur_id`, `Question_id`, `dateHeure`, `reponseSaisie`, `noteAttribuee`, `Question_id1`) VALUES
(4, 251, '2023-03-28 07:31:13', 'Je ne sais pas.', 1, 251),
(4, 252, '2023-03-28 10:11:53', 'hmmmm', 1, 252),
(4, 253, '2023-04-06 12:13:21', 'Ah la c\'est chaud', 1, 253),
(4, 254, '2023-03-28 07:31:13', 'Je ne sais pas.', 2, 254),
(4, 255, '2023-03-28 10:11:53', 'hmmmm', 5, 255),
(4, 256, '2023-04-06 12:13:21', 'Ah la c\'est chaud', 1, 256),
(4, 265, '2023-03-28 07:31:13', 'Je ne sais pas.', 1, 265),
(4, 266, '2023-03-28 10:11:53', 'hmmmm', 1, 266);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) NOT NULL,
  `dateLastUpdated` datetime NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `libelle`, `dateLastUpdated`) VALUES
(1, 'Enseignant', '2023-02-05 21:01:13'),
(2, 'Administrateur', '2023-02-05 21:01:13'),
(3, 'Elève', '2023-02-05 21:01:13');

-- --------------------------------------------------------

--
-- Structure de la table `roleonglet`
--

DROP TABLE IF EXISTS `roleonglet`;
CREATE TABLE IF NOT EXISTS `roleonglet` (
  `Role_idRole` int(11) NOT NULL,
  `Onglet_idOnglet` int(11) NOT NULL,
  PRIMARY KEY (`Role_idRole`,`Onglet_idOnglet`),
  KEY `fk_Role_has_Onglet_Onglet1_idx` (`Onglet_idOnglet`),
  KEY `fk_Role_has_Onglet_Role1_idx` (`Role_idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
  `idSujet` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(45) NOT NULL,
  PRIMARY KEY (`idSujet`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`idSujet`, `intitule`) VALUES
(1, 'Programmation Orienté Objet'),
(2, 'Architecture N-tier'),
(3, 'Java');

-- --------------------------------------------------------

--
-- Structure de la table `typeeval`
--

DROP TABLE IF EXISTS `typeeval`;
CREATE TABLE IF NOT EXISTS `typeeval` (
  `idTypeEval` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(45) NOT NULL,
  PRIMARY KEY (`idTypeEval`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeeval`
--

INSERT INTO `typeeval` (`idTypeEval`, `intitule`) VALUES
(1, 'CCI'),
(2, 'CCF');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateNaissance` datetime NOT NULL,
  `dateCreation` datetime NOT NULL,
  `dateLastUpdated` datetime NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `dateNaissance`, `dateCreation`, `dateLastUpdated`, `mdp`) VALUES
(3, 'enseignant', 'enseignant', 'enseignant@examgenerator.fr', '1999-10-24 00:00:00', '2023-02-05 20:03:14', '2023-04-10 23:42:22', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'eleve', 'eleve', 'eleve@examgenerator.fr', '1999-01-01 00:00:00', '2023-02-05 20:14:44', '2023-03-21 20:35:21', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(5, 'admin', 'admin', 'admin@examgenerator.fr', '1999-10-24 00:00:00', '2023-02-05 20:16:22', '2023-04-10 23:44:09', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(10, 'aaaa', 'aaaa', 'aaaa@examgenerator.fr', '2023-03-09 00:00:00', '2023-03-04 19:45:22', '2023-03-04 19:45:22', '70c881d4a26984ddce795f6f71817c9cf4480e79'),
(15, 'CHUPIN ', 'Pierre', 'a@examgenerator.fr', '1999-10-24 00:00:00', '2023-04-09 21:40:49', '2023-04-09 21:40:49', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurniveaucursus`
--

DROP TABLE IF EXISTS `utilisateurniveaucursus`;
CREATE TABLE IF NOT EXISTS `utilisateurniveaucursus` (
  `Utilisateur_id` int(11) NOT NULL,
  `NiveauCursus_Niveau_idNiveau` int(11) NOT NULL,
  `NiveauCursus_Cursus_idCursus` int(11) NOT NULL,
  `AnneeScolaire_id` int(11) NOT NULL,
  PRIMARY KEY (`Utilisateur_id`,`NiveauCursus_Niveau_idNiveau`,`NiveauCursus_Cursus_idCursus`,`AnneeScolaire_id`),
  KEY `fk_Utilisateur_has_NiveauCursus_NiveauCursus1_idx` (`NiveauCursus_Niveau_idNiveau`,`NiveauCursus_Cursus_idCursus`),
  KEY `fk_Utilisateur_has_NiveauCursus_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_UtilisateurNiveauCursus_AnneeScolaire1_idx` (`AnneeScolaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurrespannee`
--

DROP TABLE IF EXISTS `utilisateurrespannee`;
CREATE TABLE IF NOT EXISTS `utilisateurrespannee` (
  `Utilisateur_id` int(11) NOT NULL,
  `AnneeScolaire_id` int(11) NOT NULL,
  `Matiere_idMatiere` int(11) NOT NULL,
  PRIMARY KEY (`Utilisateur_id`,`AnneeScolaire_id`,`Matiere_idMatiere`),
  KEY `fk_Utilisateur_has_AnneeScolaire_AnneeScolaire1_idx` (`AnneeScolaire_id`),
  KEY `fk_Utilisateur_has_AnneeScolaire_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_UtilisateurRespAnnee_Matiere1_idx` (`Matiere_idMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurrespannee`
--

INSERT INTO `utilisateurrespannee` (`Utilisateur_id`, `AnneeScolaire_id`, `Matiere_idMatiere`) VALUES
(3, 1, 43),
(10, 1, 41),
(15, 1, 43);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurrole`
--

DROP TABLE IF EXISTS `utilisateurrole`;
CREATE TABLE IF NOT EXISTS `utilisateurrole` (
  `Utilisateur_id` int(11) NOT NULL,
  `Role_idRole` int(11) NOT NULL,
  PRIMARY KEY (`Utilisateur_id`,`Role_idRole`),
  KEY `fk_Utilisateur_has_Role_Role1_idx` (`Role_idRole`),
  KEY `fk_Utilisateur_has_Role_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurrole`
--

INSERT INTO `utilisateurrole` (`Utilisateur_id`, `Role_idRole`) VALUES
(3, 1),
(5, 2),
(4, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cursusmatiere`
--
ALTER TABLE `cursusmatiere`
  ADD CONSTRAINT `fk_Cursus_has_Matiere_Cursus1` FOREIGN KEY (`Cursus_idCursus`) REFERENCES `cursus` (`idCursus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cursus_has_Matiere_Matiere1` FOREIGN KEY (`Matiere_idMatiere`) REFERENCES `matiere` (`idMatiere`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `fk_Examen_TypeEval1` FOREIGN KEY (`TypeEval_idTypeEval`) REFERENCES `typeeval` (`idTypeEval`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `matieresujet`
--
ALTER TABLE `matieresujet`
  ADD CONSTRAINT `fk_Matiere_has_Sujet_Matiere1` FOREIGN KEY (`Matiere_idMatiere`) REFERENCES `matiere` (`idMatiere`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Matiere_has_Sujet_Sujet1` FOREIGN KEY (`Sujet_idSujet`) REFERENCES `sujet` (`idSujet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `niveaucursus`
--
ALTER TABLE `niveaucursus`
  ADD CONSTRAINT `fk_Niveau_has_Cursus_Cursus1` FOREIGN KEY (`Cursus_idCursus`) REFERENCES `cursus` (`idCursus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Niveau_has_Cursus_Niveau1` FOREIGN KEY (`Niveau_idNiveau`) REFERENCES `niveau` (`idNiveau`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `qestiondansexamen`
--
ALTER TABLE `qestiondansexamen`
  ADD CONSTRAINT `fk_Question_has_Examen_Examen1` FOREIGN KEY (`Examen_idExamen`) REFERENCES `examen` (`idExamen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Question_has_Examen_Question1` FOREIGN KEY (`Question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_Question_Sujet1` FOREIGN KEY (`Sujet_idSujet`) REFERENCES `sujet` (`idSujet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reponsequestion`
--
ALTER TABLE `reponsequestion`
  ADD CONSTRAINT `fk_Reponse_has_Question_Question1` FOREIGN KEY (`Question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reponse_has_Question_Reponse1` FOREIGN KEY (`Reponse_idReponse`) REFERENCES `reponse` (`idReponse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reponseutilisateur`
--
ALTER TABLE `reponseutilisateur`
  ADD CONSTRAINT `fk_ReponseUtilisateur_Question1` FOREIGN KEY (`Question_id1`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_Question_Question1` FOREIGN KEY (`Question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_Question_Utilisateur` FOREIGN KEY (`Utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `roleonglet`
--
ALTER TABLE `roleonglet`
  ADD CONSTRAINT `fk_Role_has_Onglet_Onglet1` FOREIGN KEY (`Onglet_idOnglet`) REFERENCES `onglet` (`idOnglet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Role_has_Onglet_Role1` FOREIGN KEY (`Role_idRole`) REFERENCES `role` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurniveaucursus`
--
ALTER TABLE `utilisateurniveaucursus`
  ADD CONSTRAINT `fk_UtilisateurNiveauCursus_AnneeScolaire1` FOREIGN KEY (`AnneeScolaire_id`) REFERENCES `anneescolaire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_NiveauCursus_NiveauCursus1` FOREIGN KEY (`NiveauCursus_Niveau_idNiveau`,`NiveauCursus_Cursus_idCursus`) REFERENCES `niveaucursus` (`Niveau_idNiveau`, `Cursus_idCursus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_NiveauCursus_Utilisateur1` FOREIGN KEY (`Utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurrespannee`
--
ALTER TABLE `utilisateurrespannee`
  ADD CONSTRAINT `fk_UtilisateurRespAnnee_Matiere1` FOREIGN KEY (`Matiere_idMatiere`) REFERENCES `matiere` (`idMatiere`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_AnneeScolaire_AnneeScolaire1` FOREIGN KEY (`AnneeScolaire_id`) REFERENCES `anneescolaire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_AnneeScolaire_Utilisateur1` FOREIGN KEY (`Utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurrole`
--
ALTER TABLE `utilisateurrole`
  ADD CONSTRAINT `fk_Utilisateur_has_Role_Role1` FOREIGN KEY (`Role_idRole`) REFERENCES `role` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utilisateur_has_Role_Utilisateur1` FOREIGN KEY (`Utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
