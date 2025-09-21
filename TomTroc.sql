-- MySQL dump 10.13  Distrib 8.4.4, for macos15 (x86_64)
--
-- Host: localhost    Database: TOMTROC
-- ------------------------------------------------------
-- Server version	8.4.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Livres`
--

DROP TABLE IF EXISTS `Livres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Livres` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `titre_Livre` varchar(255) NOT NULL COMMENT 'Titre du livre',
  `nom_Auteur` varchar(255) NOT NULL COMMENT 'Nom auteur du livre',
  `photo_Livre` varchar(255) DEFAULT NULL COMMENT 'image couverture du livre',
  `id_Utilisateur` bigint NOT NULL DEFAULT '-1' COMMENT 'utilisateur qui est associé au livre (propriétaire)',
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DteModif` timestamp NULL DEFAULT NULL,
  `statut_Livre` tinyint NOT NULL DEFAULT '1' COMMENT '0=indisponible 1=disponible',
  `commentaire` text COMMENT 'résumé du livre',
  PRIMARY KEY (`id`),
  KEY `IDX_Livres_Titre_Livre` (`titre_Livre`),
  KEY `IDX_Livres_ID_Auteur` (`nom_Auteur`),
  KEY `IDX_Livres_ID_Utilisateur` (`id_Utilisateur`),
  KEY `IDX_Livres_Statut_Livre` (`statut_Livre`),
  CONSTRAINT `livres_ibfk_1` FOREIGN KEY (`id_Utilisateur`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Livres`
--

LOCK TABLES `Livres` WRITE;
/*!40000 ALTER TABLE `Livres` DISABLE KEYS */;
INSERT INTO `Livres` VALUES (5,'Harry Potter à l’école des sorciers','J.K. Rowling','../images/LIVRE-00005-092025.jpg',4,'2025-09-03 17:16:39','2025-09-05 15:55:13',1,'Premier tome de la célèbre saga Harry Potter, publié en 1997, ce roman raconte l’histoire de Harry, un orphelin maltraité par sa tante et son oncle. À l’âge de 11 ans, il découvre qu’il est en réalité un sorcier et qu’il a survécu, enfant, à l’attaque du terrible mage noir Voldemort. Invité à rejoindre l’école de magie de Poudlard, Harry se fait de nouveaux amis (Ron et Hermione) et découvre un monde merveilleux peuplé de créatures magiques et de mystères. Au fil de l’année, il se retrouve confronté à des épreuves qui le mènent jusqu’à l’affrontement avec l’ombre de Voldemort. Ce roman initie une saga qui a marqué des générations entières.'),(6,'La Maison du Fond','Coraline Dupin','../images/LIVRE-00006-092025.jpeg',4,'2025-09-04 12:06:18','2025-09-05 16:00:11',0,'Ceci est un livre de fantaisie très drôle et surtout on peut s\'évader immédiatement dans les 1er pages. '),(8,'La joie du pres','alain back','../images/LIVRE-00008-092025.jpeg',4,'2025-09-04 12:56:47','2025-09-05 16:00:43',1,'Ceci est une modification du texte, gestion modification de texte avec retour à la ligne\r\nCeci est une 2 ligne pour voir'),(10,'Le Petit Prince','Antoine de Saint-Exupéry','../images/LIVRE-00010-092025.jpeg',4,'2025-09-10 05:46:56','2025-09-10 06:12:42',1,'Publié en 1943, ce conte poétique et philosophique met en scène un aviateur tombé en panne dans le désert du Sahara, qui rencontre un mystérieux petit garçon venu d’une autre planète. À travers ses récits, le Petit Prince décrit sa traversée de divers astéroïdes habités par des personnages caricaturaux (un roi, un vaniteux, un buveur, un businessman, un allumeur de réverbères et un géographe), chacun illustrant un travers humain. Sa rencontre avec le renard lui révèle le secret de l’amitié et de l’amour : « On ne voit bien qu’avec le cœur. L’essentiel est invisible pour les yeux. » Ce livre universel explore la solitude, l’amitié, l’amour et le sens de la vie.'),(11,'La Peste ','Albert Camus','../images/LIVRE-00011-092025.jpg',13,'2025-09-10 08:12:25','2025-09-11 12:05:57',1,'Publié en 1947, La Peste raconte l’épidémie qui frappe la ville d’Oran, en Algérie, et plonge ses habitants dans une situation extrême. Le récit est porté par le docteur Rieux, qui devient le témoin impuissant et engagé contre la propagation du fléau. L’auteur explore les réactions humaines face à la crise : peur, déni, égoïsme, mais aussi solidarité et courage. Camus en fait une allégorie de la solidarité humaine contre l’oppression et le mal, affirmant que la lutte, même absurde, mérite d’être menée. Le roman s’inscrit dans la philosophie de l’absurde : reconnaître l’absence de sens ultime et choisir néanmoins la révolte par la dignité.'),(12,'Moby Dick','Herman Melville','../images/LIVRE-00012-092025.jpeg',13,'2025-09-10 08:52:22','2025-09-11 12:06:03',0,'Paru en 1851, ce roman relate l’expédition d’Ismaël, marin embarqué sur le baleinier Pequod, dirigé par le capitaine Achab. Obnubilé par sa haine pour Moby Dick, une gigantesque baleine blanche qui l’a mutilé, Achab entraîne son équipage dans une chasse tragique. À travers ce récit maritime, Melville aborde des thèmes universels : la lutte de l’homme contre la nature, la folie de l’obsession, la destinée et le mal. L’œuvre mêle descriptions réalistes de la chasse à la baleine, symbolisme biblique et méditations philosophiques. Véritable monument littéraire, Moby Dick est une réflexion sur la démesure humaine et la quête impossible de domination.'),(13,'La Chartreuse de Parme','Stendhal','../images/LIVRE-00013-092025.jpg',15,'2025-09-10 08:55:51','2025-09-17 16:56:15',0,'Ce roman de 1839 suit le destin de Fabrice del Dongo, jeune aristocrate italien animé par un idéalisme romantique. Fasciné par Napoléon, il part combattre à Waterloo mais découvre la confusion et l’absurdité de la guerre. De retour en Italie, il vit des amours passionnées, notamment avec la duchesse Sanseverina, tout en affrontant intrigues politiques et religieuses. Entre exaltation de la jeunesse et désillusion, La Chartreuse de Parme est une fresque vibrante où l’amour, l’histoire et la politique se mêlent. C’est aussi une réflexion sur les illusions de la gloire et la quête de bonheur dans un monde instable.'),(14,'Le Comte de Monte-Cristo','Alexandre Dumas','../images/LIVRE-00014-092025.jpg',15,'2025-09-10 11:56:02','2025-09-10 12:16:07',1,'Publié en 1844, ce roman d’aventures raconte le destin extraordinaire d’Edmond Dantès, jeune marin injustement emprisonné au château d’If à la suite d’un complot. Après quatorze années de captivité, il s’évade et découvre un immense trésor sur l’île de Monte-Cristo. Devenu riche et puissant, il se fait passer pour le mystérieux Comte de Monte-Cristo afin d’accomplir sa vengeance contre ceux qui l’ont trahi. Mais cette quête implacable soulève aussi la question de la justice, de la rédemption et du pardon. Véritable fresque mêlant amour, trahison, politique et complot, ce roman est un des plus grands chefs-d’œuvre du XIXᵉ siècle.'),(15,'Bel-Ami','Guy de Maupassant','../images/LIVRE-00015-092025.jpeg',15,'2025-09-10 12:52:49','2025-09-10 13:33:30',0,'Georges Duroy, ambitieux jeune homme sans scrupules, gravit les échelons de la société parisienne grâce à ses conquêtes féminines. Ce roman (1885) critique le pouvoir, la corruption et l’arrivisme.'),(16,'Shining ','Stephen King','../images/LIVRE-00016-092025.jpg',15,'2025-09-10 13:31:47','2025-09-10 13:31:47',1,'Jack Torrance devient gardien d’un hôtel isolé dans les montagnes du Colorado. Avec sa femme et son fils Danny, doté de dons psychiques, il sombre peu à peu dans la folie, manipulé par les forces maléfiques de l’hôtel.'),(17,'Don Quichotte','Miguel de Cervantès','../images/LIVRE-00017-092025.jpg',13,'2025-09-10 16:47:22','2025-09-11 12:05:29',1,'Considéré comme le premier grand roman moderne, Don Quichotte (1605) raconte l’histoire d’Alonso Quijano, un gentilhomme passionné de romans de chevalerie, qui perd la raison et se prend pour un chevalier errant. Accompagné de son fidèle écuyer Sancho Panza, il part à l’aventure pour défendre les opprimés. Sa vision idéalisée du monde l’amène à affronter des moulins à vent qu’il prend pour des géants, ou à confondre des auberges avec des châteaux. Derrière l’humour et la satire, Cervantès interroge la frontière entre illusion et réalité, folie et sagesse. C’est une œuvre universelle qui célèbre à la fois la puissance de l’imaginaire et la fragilité humaine.'),(18,'Crime et Châtiment ','Fiodor Dostoïevski','../images/LIVRE-00018-092025.jpg',4,'2025-09-10 17:42:38','2025-09-10 17:42:38',1,'Dans ce chef-d’œuvre de 1866, Rodion Raskolnikov, un étudiant en grande précarité à Saint-Pétersbourg, élabore la théorie selon laquelle certains individus, supérieurs aux autres, peuvent passer outre la morale et la loi pour réaliser de grandes choses. Il teste cette théorie en assassinant une vieille prêteuse sur gage. Mais la culpabilité l’assaillit, et sa conscience devient un bourreau psychologique. Il erre entre tourments spirituels, interrogations existentielles, et une rencontre salvatrice avec Sonia, une jeune prostituée au cœur pur. Cette relation plus humaine et moins idéologique lui offre une lueur de rédemption. Dostoïevski explore ainsi la profondeur de la culpabilité, la pertinence de la punition, la souffrance et l’espoir de salut à travers la foi ou l’amour.');
/*!40000 ALTER TABLE `Livres` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TBI_LIVRES` BEFORE INSERT ON `livres` FOR EACH ROW begin
    SET NEW.DteCreation = NOW();
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TBU_LIVRES` BEFORE UPDATE ON `livres` FOR EACH ROW begin
    SET NEW.DteModif = NOW();
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Messagerie`
--

DROP TABLE IF EXISTS `Messagerie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Messagerie` (
  `ID` bigint NOT NULL AUTO_INCREMENT,
  `Msg_Messagerie` longtext NOT NULL,
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `De_Messagerie` bigint NOT NULL DEFAULT '0',
  `Pour_Messagerie` bigint NOT NULL DEFAULT '0',
  `Message_new` tinyint NOT NULL DEFAULT '0',
  `Blocmessage` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDX_Messagerie_DteCreation` (`DteCreation`),
  KEY `IDX_Messagerie_De_Messagerie` (`De_Messagerie`),
  KEY `IDX_Messagerie_Pour_Messagerie` (`Pour_Messagerie`),
  CONSTRAINT `messagerie_ibfk_1` FOREIGN KEY (`De_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `messagerie_ibfk_2` FOREIGN KEY (`Pour_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messagerie`
--

LOCK TABLES `Messagerie` WRITE;
/*!40000 ALTER TABLE `Messagerie` DISABLE KEYS */;
INSERT INTO `Messagerie` VALUES (1,'Auriez-vous le même livre en version poche ?','2025-09-16 13:00:00',4,15,1,NULL),(2,'Oui, mais il n\'est pas en très bonne état,\nle voulez-vous comme même','2025-09-17 08:05:00',15,4,1,NULL),(3,'Ce n\'est pas grave, pouvez -vous me l\'envoyer','2025-09-17 12:30:00',4,15,1,NULL),(4,'ok , je le prepare et l\'expédie demain. bonne journée à vous','2025-09-17 13:11:00',15,4,1,NULL),(5,'merci et bonne journée à vous','2025-09-17 13:15:00',4,15,1,NULL),(6,'Bonjour,\nquelle édition avez-vous de Don Quichotte ?','2025-09-10 09:15:00',4,13,1,NULL),(7,'c\'est une réédition de 2005, mais il est broché','2025-09-10 09:22:00',13,4,1,NULL),(8,'comment envoyez vous le livre ?','2025-09-10 11:33:00',4,13,1,NULL),(9,'voulez-vous le recevoir en express ?','2025-09-10 13:27:00',13,4,1,NULL),(10,'Je peux aussi l\'envoyer en mode normal, cela prendra 3 jours , voulez vous cette solution ?','2025-09-11 11:53:45',13,4,1,NULL);
/*!40000 ALTER TABLE `Messagerie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utilisateurs`
--

DROP TABLE IF EXISTS `Utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Utilisateurs` (
  `ID` bigint NOT NULL AUTO_INCREMENT,
  `Pseudo_Utilisateur` varchar(50) NOT NULL,
  `Photo_Utilisateur` varchar(255) DEFAULT NULL,
  `Mail_Utilisateur` varchar(255) NOT NULL,
  `Pwd_Utilisateur` varchar(120) NOT NULL,
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DteModif` timestamp NOT NULL DEFAULT (now()),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilisateurs`
--

LOCK TABLES `Utilisateurs` WRITE;
/*!40000 ALTER TABLE `Utilisateurs` DISABLE KEYS */;
INSERT INTO `Utilisateurs` VALUES (4,'ludovic COQUEMERT','../images/user_picture/PROFIL-00004-092025.gif','ludo@free.fr','YXZkZnYwM0tUdUVhUENYdTlSeEtpZz09','2025-04-15 09:49:38','2025-09-05 15:50:55'),(13,'PIERRE','../images/user_picture/PROFIL-00013-092025.png','pierre@free.fr','U1B5em9VYlB4QU1WNFBJUlR5UmVDZz09','2025-08-10 06:00:00','2025-09-10 08:50:31'),(15,'VALERIE','../images/user_picture/PROFIL-00015-092025.png','valerie@free.fr','SDJUTHRjN2pTeXhrVmxObXRyNHhsZz09','2025-09-06 07:15:51','2025-09-10 08:56:29');
/*!40000 ALTER TABLE `Utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TBU_Utilisateurs` BEFORE UPDATE ON `utilisateurs` FOR EACH ROW begin
     SET NEW.DteModif = CURRENT_TIMESTAMP;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-19  7:19:12
