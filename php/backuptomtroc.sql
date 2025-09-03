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
-- Table structure for table `Auteurs`
--

DROP TABLE IF EXISTS `Auteurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Auteurs` (
  `ID` bigint NOT NULL AUTO_INCREMENT,
  `Nom_Auteur` varchar(150) NOT NULL,
  `Prenom_Auteur` varchar(100) NOT NULL,
  `Pseudo_Auteur` varchar(50) NOT NULL,
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DteModif` timestamp NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDX_Auteurs_Nom_Auteur` (`Nom_Auteur`),
  KEY `IDX_Auteurs_Pseudo_Auteur` (`Pseudo_Auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Auteurs`
--

LOCK TABLES `Auteurs` WRITE;
/*!40000 ALTER TABLE `Auteurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `Auteurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Livres`
--

DROP TABLE IF EXISTS `Livres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Livres` (
  `ID` bigint NOT NULL AUTO_INCREMENT,
  `Titre_Livre` varchar(255) NOT NULL,
  `ID_Auteur` bigint NOT NULL DEFAULT '-1',
  `Photo_livre` varchar(255) NOT NULL,
  `ID_Utilisateur` bigint NOT NULL DEFAULT '-1',
  `DteCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DteModif` timestamp NOT NULL,
  `Memo_Livre` longtext NOT NULL,
  `Statut_Livre` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `IDX_Livres_Titre_Livre` (`Titre_Livre`),
  KEY `IDX_Livres_ID_Auteur` (`ID_Auteur`),
  KEY `IDX_Livres_ID_Utilisateur` (`ID_Utilisateur`),
  KEY `IDX_Livres_Statut_Livre` (`Statut_Livre`),
  CONSTRAINT `livres_ibfk_1` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `livres_ibfk_2` FOREIGN KEY (`ID_Auteur`) REFERENCES `Auteurs` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Livres`
--

LOCK TABLES `Livres` WRITE;
/*!40000 ALTER TABLE `Livres` DISABLE KEYS */;
/*!40000 ALTER TABLE `Livres` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`ID`),
  KEY `IDX_Messagerie_DteCreation` (`DteCreation`),
  KEY `IDX_Messagerie_De_Messagerie` (`De_Messagerie`),
  KEY `IDX_Messagerie_Pour_Messagerie` (`Pour_Messagerie`),
  CONSTRAINT `messagerie_ibfk_1` FOREIGN KEY (`De_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `messagerie_ibfk_2` FOREIGN KEY (`Pour_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messagerie`
--

LOCK TABLES `Messagerie` WRITE;
/*!40000 ALTER TABLE `Messagerie` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilisateurs`
--

LOCK TABLES `Utilisateurs` WRITE;
/*!40000 ALTER TABLE `Utilisateurs` DISABLE KEYS */;
INSERT INTO `Utilisateurs` (`ID`, `Pseudo_Utilisateur`, `Photo_Utilisateur`, `Mail_Utilisateur`, `Pwd_Utilisateur`, `DteCreation`, `DteModif`) VALUES (4,'ludovic COQUEMERT','PROFIL-0000004-082025.jpeg','ludo@free.fr','YXZkZnYwM0tUdUVhUENYdTlSeEtpZz09','2025-04-15 09:49:38','2025-08-24 13:35:54');
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

-- Dump completed on 2025-08-24 21:32:21
