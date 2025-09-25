-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 24 sep. 2025 à 10:09
-- Version du serveur : 8.4.4
-- Version de PHP : 8.4.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `TOMTROC`
--
CREATE DATABASE IF NOT EXISTS `TOMTROC` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `TOMTROC`;

-- --------------------------------------------------------

--
-- Structure de la table `Livres`
--

CREATE TABLE `Livres` (
  `id` bigint NOT NULL,
  `titre_Livre` varchar(255) NOT NULL COMMENT 'Titre du livre',
  `nom_Auteur` varchar(255) NOT NULL COMMENT 'Nom auteur du livre',
  `photo_Livre` varchar(255) DEFAULT NULL COMMENT 'image couverture du livre',
  `id_Utilisateur` bigint NOT NULL DEFAULT '-1' COMMENT 'utilisateur qui est associé au livre (propriétaire)',
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DteModif` timestamp NULL DEFAULT NULL,
  `statut_Livre` tinyint NOT NULL DEFAULT '1' COMMENT '0=indisponible 1=disponible',
  `commentaire` text COMMENT 'résumé du livre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Livres`
--

INSERT INTO `Livres` (`id`, `titre_Livre`, `nom_Auteur`, `photo_Livre`, `id_Utilisateur`, `DteCreation`, `DteModif`, `statut_Livre`, `commentaire`) VALUES
(5, 'Harry Potter à l’école des sorciers', 'J.K. Rowling', '../images/LIVRE-00005-092025.jpg', 4, '2025-09-03 17:16:39', '2025-09-05 15:55:13', 1, 'Premier tome de la célèbre saga Harry Potter, publié en 1997, ce roman raconte l’histoire de Harry, un orphelin maltraité par sa tante et son oncle. À l’âge de 11 ans, il découvre qu’il est en réalité un sorcier et qu’il a survécu, enfant, à l’attaque du terrible mage noir Voldemort. Invité à rejoindre l’école de magie de Poudlard, Harry se fait de nouveaux amis (Ron et Hermione) et découvre un monde merveilleux peuplé de créatures magiques et de mystères. Au fil de l’année, il se retrouve confronté à des épreuves qui le mènent jusqu’à l’affrontement avec l’ombre de Voldemort. Ce roman initie une saga qui a marqué des générations entières.'),
(6, 'La Maison du Fond', 'Coraline Dupin', '../images/LIVRE-00006-092025.jpeg', 4, '2025-09-04 12:06:18', '2025-09-05 16:00:11', 0, 'Ceci est un livre de fantaisie très drôle et surtout on peut s\'évader immédiatement dans les 1er pages. '),
(8, 'La joie du pres', 'alain back', '../images/LIVRE-00008-092025.jpeg', 4, '2025-09-04 12:56:47', '2025-09-05 16:00:43', 1, 'Ceci est une modification du texte, gestion modification de texte avec retour à la ligne\r\nCeci est une 2 ligne pour voir'),
(10, 'Le Petit Prince', 'Antoine de Saint-Exupéry', '../images/LIVRE-00010-092025.jpeg', 4, '2025-09-10 05:46:56', '2025-09-10 06:12:42', 1, 'Publié en 1943, ce conte poétique et philosophique met en scène un aviateur tombé en panne dans le désert du Sahara, qui rencontre un mystérieux petit garçon venu d’une autre planète. À travers ses récits, le Petit Prince décrit sa traversée de divers astéroïdes habités par des personnages caricaturaux (un roi, un vaniteux, un buveur, un businessman, un allumeur de réverbères et un géographe), chacun illustrant un travers humain. Sa rencontre avec le renard lui révèle le secret de l’amitié et de l’amour : « On ne voit bien qu’avec le cœur. L’essentiel est invisible pour les yeux. » Ce livre universel explore la solitude, l’amitié, l’amour et le sens de la vie.'),
(11, 'La Peste ', 'Albert Camus', '../images/LIVRE-00011-092025.jpg', 13, '2025-09-10 08:12:25', '2025-09-11 12:05:57', 1, 'Publié en 1947, La Peste raconte l’épidémie qui frappe la ville d’Oran, en Algérie, et plonge ses habitants dans une situation extrême. Le récit est porté par le docteur Rieux, qui devient le témoin impuissant et engagé contre la propagation du fléau. L’auteur explore les réactions humaines face à la crise : peur, déni, égoïsme, mais aussi solidarité et courage. Camus en fait une allégorie de la solidarité humaine contre l’oppression et le mal, affirmant que la lutte, même absurde, mérite d’être menée. Le roman s’inscrit dans la philosophie de l’absurde : reconnaître l’absence de sens ultime et choisir néanmoins la révolte par la dignité.'),
(12, 'Moby Dick', 'Herman Melville', '../images/LIVRE-00012-092025.jpeg', 13, '2025-09-10 08:52:22', '2025-09-11 12:06:03', 0, 'Paru en 1851, ce roman relate l’expédition d’Ismaël, marin embarqué sur le baleinier Pequod, dirigé par le capitaine Achab. Obnubilé par sa haine pour Moby Dick, une gigantesque baleine blanche qui l’a mutilé, Achab entraîne son équipage dans une chasse tragique. À travers ce récit maritime, Melville aborde des thèmes universels : la lutte de l’homme contre la nature, la folie de l’obsession, la destinée et le mal. L’œuvre mêle descriptions réalistes de la chasse à la baleine, symbolisme biblique et méditations philosophiques. Véritable monument littéraire, Moby Dick est une réflexion sur la démesure humaine et la quête impossible de domination.'),
(13, 'La Chartreuse de Parme', 'Stendhal', '../images/LIVRE-00013-092025.jpg', 15, '2025-09-10 08:55:51', '2025-09-17 16:56:15', 0, 'Ce roman de 1839 suit le destin de Fabrice del Dongo, jeune aristocrate italien animé par un idéalisme romantique. Fasciné par Napoléon, il part combattre à Waterloo mais découvre la confusion et l’absurdité de la guerre. De retour en Italie, il vit des amours passionnées, notamment avec la duchesse Sanseverina, tout en affrontant intrigues politiques et religieuses. Entre exaltation de la jeunesse et désillusion, La Chartreuse de Parme est une fresque vibrante où l’amour, l’histoire et la politique se mêlent. C’est aussi une réflexion sur les illusions de la gloire et la quête de bonheur dans un monde instable.'),
(14, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', '../images/LIVRE-00014-092025.jpg', 15, '2025-09-10 11:56:02', '2025-09-10 12:16:07', 1, 'Publié en 1844, ce roman d’aventures raconte le destin extraordinaire d’Edmond Dantès, jeune marin injustement emprisonné au château d’If à la suite d’un complot. Après quatorze années de captivité, il s’évade et découvre un immense trésor sur l’île de Monte-Cristo. Devenu riche et puissant, il se fait passer pour le mystérieux Comte de Monte-Cristo afin d’accomplir sa vengeance contre ceux qui l’ont trahi. Mais cette quête implacable soulève aussi la question de la justice, de la rédemption et du pardon. Véritable fresque mêlant amour, trahison, politique et complot, ce roman est un des plus grands chefs-d’œuvre du XIXᵉ siècle.'),
(15, 'Bel-Ami', 'Guy de Maupassant', '../images/LIVRE-00015-092025.jpeg', 15, '2025-09-10 12:52:49', '2025-09-24 09:13:41', 1, 'Georges Duroy, ambitieux jeune homme sans scrupules, gravit les échelons de la société parisienne grâce à ses conquêtes féminines. Ce roman (1885) critique le pouvoir, la corruption et l’arrivisme.'),
(16, 'Shining ', 'Stephen King', '../images/LIVRE-00016-092025.jpg', 15, '2025-09-10 13:31:47', '2025-09-10 13:31:47', 1, 'Jack Torrance devient gardien d’un hôtel isolé dans les montagnes du Colorado. Avec sa femme et son fils Danny, doté de dons psychiques, il sombre peu à peu dans la folie, manipulé par les forces maléfiques de l’hôtel.'),
(17, 'Don Quichotte', 'Miguel de Cervantès', '../images/LIVRE-00017-092025.jpg', 13, '2025-09-10 16:47:22', '2025-09-11 12:05:29', 1, 'Considéré comme le premier grand roman moderne, Don Quichotte (1605) raconte l’histoire d’Alonso Quijano, un gentilhomme passionné de romans de chevalerie, qui perd la raison et se prend pour un chevalier errant. Accompagné de son fidèle écuyer Sancho Panza, il part à l’aventure pour défendre les opprimés. Sa vision idéalisée du monde l’amène à affronter des moulins à vent qu’il prend pour des géants, ou à confondre des auberges avec des châteaux. Derrière l’humour et la satire, Cervantès interroge la frontière entre illusion et réalité, folie et sagesse. C’est une œuvre universelle qui célèbre à la fois la puissance de l’imaginaire et la fragilité humaine.'),
(18, 'Crime et Châtiment ', 'Fiodor Dostoïevski', '../images/LIVRE-00018-092025.jpg', 4, '2025-09-10 17:42:38', '2025-09-10 17:42:38', 1, 'Dans ce chef-d’œuvre de 1866, Rodion Raskolnikov, un étudiant en grande précarité à Saint-Pétersbourg, élabore la théorie selon laquelle certains individus, supérieurs aux autres, peuvent passer outre la morale et la loi pour réaliser de grandes choses. Il teste cette théorie en assassinant une vieille prêteuse sur gage. Mais la culpabilité l’assaillit, et sa conscience devient un bourreau psychologique. Il erre entre tourments spirituels, interrogations existentielles, et une rencontre salvatrice avec Sonia, une jeune prostituée au cœur pur. Cette relation plus humaine et moins idéologique lui offre une lueur de rédemption. Dostoïevski explore ainsi la profondeur de la culpabilité, la pertinence de la punition, la souffrance et l’espoir de salut à travers la foi ou l’amour.');

--
-- Déclencheurs `Livres`
--
DELIMITER $$
CREATE TRIGGER `TBI_LIVRES` BEFORE INSERT ON `Livres` FOR EACH ROW begin
    SET NEW.DteCreation = NOW();
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TBU_LIVRES` BEFORE UPDATE ON `Livres` FOR EACH ROW begin
    SET NEW.DteModif = NOW();
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Messagerie`
--

CREATE TABLE `Messagerie` (
  `ID` bigint NOT NULL,
  `Msg_Messagerie` longtext NOT NULL,
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `De_Messagerie` bigint NOT NULL DEFAULT '0',
  `Pour_Messagerie` bigint NOT NULL DEFAULT '0',
  `Message_new` tinyint NOT NULL DEFAULT '0',
  `Blocmessage` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Messagerie`
--

INSERT INTO `Messagerie` (`ID`, `Msg_Messagerie`, `DteCreation`, `De_Messagerie`, `Pour_Messagerie`, `Message_new`, `Blocmessage`) VALUES
(1, 'Auriez-vous le même livre en version poche ?', '2025-09-16 13:00:00', 4, 15, 1, NULL),
(2, 'Oui, mais il n\'est pas en très bonne état,\nle voulez-vous comme même', '2025-09-17 08:05:00', 15, 4, 1, NULL),
(3, 'Ce n\'est pas grave, pouvez -vous me l\'envoyer', '2025-09-17 12:30:00', 4, 15, 1, NULL),
(4, 'ok , je le prepare et l\'expédie demain. bonne journée à vous', '2025-09-17 13:11:00', 15, 4, 1, NULL),
(5, 'merci et bonne journée à vous', '2025-09-17 13:15:00', 4, 15, 1, NULL),
(6, 'Bonjour,\nquelle édition avez-vous de Don Quichotte ?', '2025-09-10 09:15:00', 4, 13, 1, NULL),
(7, 'c\'est une réédition de 2005, mais il est broché', '2025-09-10 09:22:00', 13, 4, 1, NULL),
(8, 'comment envoyez vous le livre ?', '2025-09-10 11:33:00', 4, 13, 1, NULL),
(9, 'voulez-vous le recevoir en express ?', '2025-09-10 13:27:00', 13, 4, 1, NULL),
(10, 'Je peux aussi l\'envoyer en mode normal, cela prendra 3 jours , voulez vous cette solution ?', '2025-09-11 11:53:45', 13, 4, 1, NULL),
(11, 'quel est le prix pour le mode normal', '2025-09-23 12:28:43', 4, 13, 1, NULL),
(12, 'Puis je avoir les tarifs d\'envois', '2025-09-23 12:32:05', 4, 13, 1, NULL),
(13, 'Express = 8,50€ ', '2025-09-23 12:41:56', 13, 4, 1, NULL),
(14, 'Normal = 1,80€', '2025-09-23 12:42:29', 13, 4, 1, NULL),
(15, 'Quand pensez-vous que le livre sera de nouveau disponible', '2025-09-23 16:37:56', 13, 4, 1, NULL),
(16, 'Auriez-vous une information sur la disponibilté du livre Don Qui...', '2025-09-24 08:43:13', 15, 13, 1, NULL),
(17, 'Je peux vous aider à choisir', '2025-09-24 08:56:14', 15, 13, 0, NULL),
(18, 'Le livre est-il au format Poche ?', '2025-09-24 09:08:30', 13, 15, 0, NULL),
(19, 'Je peux l\'envoyer demain ', '2025-09-24 09:41:44', 4, 13, 0, NULL),
(20, 'Par quel transporteur envoyer vous le livre ? [pour info]', '2025-09-24 09:46:43', 4, 15, 0, NULL);

--
-- Déclencheurs `Messagerie`
--
DELIMITER $$
CREATE TRIGGER `TBI_Messagerie` BEFORE INSERT ON `Messagerie` FOR EACH ROW SET NEW.DteCreation = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `ID` bigint NOT NULL ,
  `Pseudo_Utilisateur` varchar(50) NOT NULL,
  `Photo_Utilisateur` varchar(255) DEFAULT NULL,
  `Mail_Utilisateur` varchar(255) NOT NULL,
  `Pwd_Utilisateur` varchar(120) NOT NULL,
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DteModif` timestamp NOT NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`ID`, `Pseudo_Utilisateur`, `Photo_Utilisateur`, `Mail_Utilisateur`, `Pwd_Utilisateur`, `DteCreation`, `DteModif`) VALUES
(4, 'ludovic COQUEMERT', '../images/user_picture/PROFIL-00004-092025.gif', 'ludo@free.fr', 'YXZkZnYwM0tUdUVhUENYdTlSeEtpZz09', '2025-04-15 09:49:38', '2025-09-05 15:50:55'),
(13, 'PIERRE', '../images/user_picture/PROFIL-00013-092025.png', 'pierre@free.fr', 'U1B5em9VYlB4QU1WNFBJUlR5UmVDZz09', '2025-08-10 06:00:00', '2025-09-10 08:50:31'),
(15, 'VALERIE', '../images/user_picture/PROFIL-00015-092025.png', 'valerie@free.fr', 'SDJUTHRjN2pTeXhrVmxObXRyNHhsZz09', '2025-09-06 07:15:51', '2025-09-10 08:56:29');

--
-- Déclencheurs `Utilisateurs`
--
DELIMITER $$
CREATE TRIGGER `TBU_Utilisateurs` BEFORE UPDATE ON `Utilisateurs` FOR EACH ROW begin
     SET NEW.DteModif = CURRENT_TIMESTAMP;
end
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Livres`
--
ALTER TABLE `Livres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_Livres_Titre_Livre` (`titre_Livre`),
  ADD KEY `IDX_Livres_ID_Auteur` (`nom_Auteur`),
  ADD KEY `IDX_Livres_ID_Utilisateur` (`id_Utilisateur`),
  ADD KEY `IDX_Livres_Statut_Livre` (`statut_Livre`);

--
-- Index pour la table `Messagerie`
--
ALTER TABLE `Messagerie`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDX_Messagerie_DteCreation` (`DteCreation`),
  ADD KEY `IDX_Messagerie_De_Messagerie` (`De_Messagerie`),
  ADD KEY `IDX_Messagerie_Pour_Messagerie` (`Pour_Messagerie`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Livres`
--
ALTER TABLE `Livres`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Messagerie`
--
ALTER TABLE `Messagerie`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Livres`
--
ALTER TABLE `Livres`
  ADD CONSTRAINT `livres_ibfk_1` FOREIGN KEY (`id_Utilisateur`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Messagerie`
--
ALTER TABLE `Messagerie`
  ADD CONSTRAINT `messagerie_ibfk_1` FOREIGN KEY (`De_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `messagerie_ibfk_2` FOREIGN KEY (`Pour_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
