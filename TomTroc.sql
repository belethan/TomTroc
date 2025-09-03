-- Base SGBDR MySQL

-- Création de la base de données TOMTROC
CREATE DATABASE IF NOT EXISTS TOMTROC;
USE TOMTROC;

-- Création de la table Auteurs
CREATE TABLE `Auteurs` (
    `ID` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Nom_Auteur` VARCHAR(150) NOT NULL,
    `Prenom_Auteur` VARCHAR(100) NOT NULL,
    `Pseudo_Auteur` VARCHAR(50) NOT NULL,
    `DteCreation` TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP(),
    `DteModif` TIMESTAMP NOT NULL);
CREATE INDEX `IDX_Auteurs_Nom_Auteur` ON `Auteurs` (`Nom_Auteur`);
CREATE INDEX `IDX_Auteurs_Pseudo_Auteur` ON `Auteurs` (`Pseudo_Auteur`);

-- Création de la table Livres
CREATE TABLE `Livres` (
    `ID` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Titre_Livre` VARCHAR(255) NOT NULL,
    `ID_Auteur` BIGINT NOT NULL DEFAULT -1,
    `Photo_livre` VARCHAR(255) NOT NULL,
    `ID_Utilisateur` BIGINT NOT NULL DEFAULT -1,
    `DteCreation` TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP(),
    `DteModif` TIMESTAMP NOT NULL,
    `Memo_Livre` LONGTEXT NOT NULL,
    `Statut_Livre` TINYINT NOT NULL DEFAULT 1);
CREATE INDEX `IDX_Livres_Titre_Livre` ON `Livres` (`Titre_Livre`);
CREATE INDEX `IDX_Livres_ID_Auteur` ON `Livres` (`ID_Auteur`);
CREATE INDEX `IDX_Livres_ID_Utilisateur` ON `Livres` (`ID_Utilisateur`);
CREATE INDEX `IDX_Livres_Statut_Livre` ON `Livres` (`Statut_Livre`);

-- Création de la table Messagerie
CREATE TABLE `Messagerie` (
    `ID` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Msg_Messagerie` LONGTEXT NOT NULL,
    `DteCreation` TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP(),
    `De_Messagerie` BIGINT NOT NULL DEFAULT 0,
    `Pour_Messagerie` BIGINT NOT NULL DEFAULT 0,
    `Message_new` TINYINT NOT NULL DEFAULT 0);
CREATE INDEX `IDX_Messagerie_DteCreation` ON `Messagerie` (`DteCreation`);
CREATE INDEX `IDX_Messagerie_De_Messagerie` ON `Messagerie` (`De_Messagerie`);
CREATE INDEX `IDX_Messagerie_Pour_Messagerie` ON `Messagerie` (`Pour_Messagerie`);

-- Création de la table Utilisateurs
CREATE TABLE `Utilisateurs` (
    `ID` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Nom_Utilisateur` VARCHAR(150) NOT NULL,
    `Prenom_Utilisateur` VARCHAR(100) ,
    `Pseudo_Utilisateur` VARCHAR(50) ,
    `Photo_Utilisateur` LONGBLOB ,
    `Mail_Utilisateur` VARCHAR(255) ,
    `Pwd_Utilisateur` VARCHAR(120) ,
    `DteCreation` TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP(),
    `DteModif` TIMESTAMP NOT NULL);
-- Contraintes d'intégrité
ALTER TABLE `Livres` ADD FOREIGN KEY (`ID_Utilisateur`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE;
ALTER TABLE `Livres` ADD FOREIGN KEY (`ID_Auteur`) REFERENCES `Auteurs` (`ID`);
ALTER TABLE `Messagerie` ADD FOREIGN KEY (`De_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE;
ALTER TABLE `Messagerie` ADD FOREIGN KEY (`Pour_Messagerie`) REFERENCES `Utilisateurs` (`ID`) ON DELETE CASCADE;
