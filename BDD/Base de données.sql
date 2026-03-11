-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2026 at 09:11 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DefiCyber`
--

-- --------------------------------------------------------

DROP DATABASE IF EXISTS `DefiCyber`;

CREATE DATABASE IF NOT EXISTS `DefiCyber`;

USE `DefiCyber`;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
    `id` int NOT NULL AUTO_INCREMENT,
    `Pseudo` varchar(50) NOT NULL,
    `Hash_MDP` text NOT NULL,
    `Mail` varchar(50) DEFAULT NULL,
    `idRole` int NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `Pseudo` (`Pseudo`),
    FOREIGN KEY (`idRole`) REFERENCES `Roles`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='liste des d''utilisateurs et de leur droit administrateur ';
COMMIT;

INSERT INTO `User` (`Pseudo`, `Hash_MDP`, `idRole`) VALUES
('user', 'b512d97e7cbf97c273e4db073bbb547aa65a84589227f8f3d9e4a72b9372a24d', 0),
('admin', 'c1c224b03cd9bc7b6a86d77f5dace40191766c485cd55dc48caf9ac873335d6f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
CREATE TABLE IF NOT EXISTS `Roles` (
    `id` int NOT NULL AUTO_INCREMENT,
    `tag` varchar(50) NOT NULL,
    `description` varchar(50) DEFAULT NULL,
    `Personnalisation` boolean default 0,
    `Administration` boolean default 0, 
    `Statistisque` boolean default 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `tag` (`tag`)
);

insert into `Roles` (`tag`, `description`, `Personnalisation`, `Administration`, `Statistisque`) values
('User', 'Utilisateur standard', 0, 0, 0),
('SuperAdmin', 'Super Utilisateur ayant tous les droits', 1, 1, 1),
('Éditeur', 'Éditeur de contenu', 1, 0, 0),
('Administrateur', 'Administrateur des utilisateurs', 0, 1, 0),
('Data Analyst', 'Analyste de données', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

DROP TABLE IF EXISTS `Score`;
CREATE TABLE IF NOT EXISTS `Score` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `Score` int NOT NULL,
  `Temps` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idUser`) REFERENCES `User`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tableaux de score des utilisateurs';

-- --------------------------------------------------------

--
-- Table structure for table `Catégorie`
--

DROP TABLE IF EXISTS `Catégorie`;
CREATE TABLE IF NOT EXISTS `Catégorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Ordre`
--

DROP TABLE IF EXISTS `Ordre`;
CREATE TABLE IF NOT EXISTS `Ordre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idQuestion` int DEFAULT NULL,
  `idDiapo` int DEFAULT NULL,
  `idCatégorie` int NOT NULL,
  `ordre` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idQuestion`) REFERENCES `Question`(`id`),
  FOREIGN KEY (`idDiapo`) REFERENCES `Diapo`(`id`),
  FOREIGN KEY (`idCatégorie`) REFERENCES `Catégorie`(`id`),
  UNIQUE KEY `Ordre` (`ordre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Diapo`
--

DROP TABLE IF EXISTS `Diapo`;
CREATE TABLE IF NOT EXISTS `Diapo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(75) NOT NULL,
  `texte` text NOT NULL,
  `idOrdre` int NOT NULL,
  `idImage` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idImage`) REFERENCES `Image`(`id`),
  FOREIGN KEY (`idOrdre`) REFERENCES `Ordre`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
CREATE TABLE IF NOT EXISTS `Image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `Url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idAuteur`) REFERENCES `Credit`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Credit`
--

DROP TABLE IF EXISTS `Credit`;
CREATE TABLE IF NOT EXISTS `Credit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Auteurs` varchar(35) NOT NULL,
  `siteAuteur` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

DROP TABLE IF EXISTS `Question`;
CREATE TABLE IF NOT EXISTS `Question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idOrdre` int NOT NULL,
  `idImage` int NOT NULL,
  `texte` text NOT NULL,
  `explication` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idOrdre`) REFERENCES `Ordre`(`id`),
  FOREIGN KEY (`idImage`) REFERENCES `Image`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Reponse`
--

DROP TABLE IF EXISTS `Reponse`;
CREATE TABLE IF NOT EXISTS `Reponse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `est_correcte` boolean NOT NULL DEFAULT false,
  `idQuestion` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idQuestion`) REFERENCES `Question`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Statistiques`
--

DROP TABLE IF EXISTS `Statistiques`;
CREATE TABLE IF NOT EXISTS `Statistiques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `T_Moyen` int DEFAULT 0,
  `T_Min` int DEFAULT 0,
  `T_Max` int DEFAULT 0,
  `NBonneRéponse` int DEFAULT 0,
  `NRéponse` int DEFAULT 0,
  `idQuestion` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idQuestion`) REFERENCES `Question`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ReponseChoisie`
--

DROP TABLE IF EXISTS `ReponseChoisie`;
CREATE TABLE IF NOT EXISTS `ReponseChoisie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idReponse` int NOT NULL,
  `idStat` int NOT NULL,
  `Nombre_de_fois_choisi` int DEFAULT 0,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idReponse`) REFERENCES `Reponse`(`id`),
  FOREIGN KEY (`idStat`) REFERENCES `Statistiques`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
