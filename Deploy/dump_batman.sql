-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: batman
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `batman`
--

/*!40000 DROP DATABASE IF EXISTS `batman`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `batman` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `batman`;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameCustomer` tinytext NOT NULL,
  `adress` text DEFAULT NULL,
  `mailGeneric` tinytext DEFAULT NULL,
  `siren` varchar(14) DEFAULT NULL,
  `nameContact` tinytext DEFAULT NULL,
  `mailContact` tinytext DEFAULT NULL,
  `adressContact` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siren` (`siren`),
  FULLTEXT KEY `nameCustomer` (`nameCustomer`,`adress`,`mailGeneric`,`siren`,`nameContact`,`mailContact`,`adressContact`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (23,'Bouygues construct','3 rue des constructeurs','bouygues@bouygues.com','12345678912345','Norman','norman@bouygues.com','3 rue des constructeurs'),(24,'Eiffage construct','3 allée des sapins','eiffage@eiffage.com','98765432109876','Oswald','oswald@eiffage.com','3 allée des sapins'),(25,'SOGEA','15 chemin de terre','sogea@sogea.com','57894610258467','Rozenblummentalovitch','Rozenblummentalovitch@sogea.com','15 chemin de terre'),(26,'DOE Construction','3 rue du dodo','doe@doe.fr','51479238465217','John Doe','John@doe.fr','2 rue du dodo'),(28,'Smith & Wesson','44 rue du champs de tir','sw@sw.fr','54986325875698','Smith','smith@sw.fr','42 rue du champs de tir');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimate`
--

DROP TABLE IF EXISTS `estimate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameEstimate` tinytext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `idCustomer` int(11) NOT NULL,
  `driver` int(11) DEFAULT NULL,
  `imput` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameEstimate` (`nameEstimate`) USING HASH,
  UNIQUE KEY `imput` (`imput`),
  KEY `idCustomer` (`idCustomer`),
  KEY `driver` (`driver`) USING BTREE,
  CONSTRAINT `customer` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimate_ibfk_1` FOREIGN KEY (`driver`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimate`
--

LOCK TABLES `estimate` WRITE;
/*!40000 ALTER TABLE `estimate` DISABLE KEYS */;
INSERT INTO `estimate` VALUES (186,'Test JS','2024-06-05',23,10,2406002),(187,'test responsive','2024-06-06',23,NULL,NULL),(188,'responsive 2','2024-06-06',23,NULL,NULL),(189,'fzefz','2024-06-06',23,NULL,NULL);
/*!40000 ALTER TABLE `estimate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productbytask`
--

DROP TABLE IF EXISTS `productbytask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productbytask` (
  `idProductByTask` int(11) NOT NULL AUTO_INCREMENT,
  `row` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idTask` int(11) NOT NULL,
  `quantityProduct` int(11) NOT NULL,
  `unitPriceProduct` decimal(10,2) NOT NULL,
  `situation` int(11) NOT NULL DEFAULT 0,
  `expense` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idProductByTask`),
  KEY `productRef` (`idProduct`),
  KEY `idTask` (`idTask`),
  CONSTRAINT `productRef` FOREIGN KEY (`idProduct`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productbytask_ibfk_1` FOREIGN KEY (`idTask`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1535 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productbytask`
--

LOCK TABLES `productbytask` WRITE;
/*!40000 ALTER TABLE `productbytask` DISABLE KEYS */;
INSERT INTO `productbytask` VALUES (1529,1,38,788,50,6.56,10,328.00),(1530,2,43,788,100,45.00,100,4400.00),(1531,1,37,789,100,2.49,0,0.00),(1532,2,43,789,50,45.00,0,500.00),(1534,1,43,791,76,3.26,10,500.00);
/*!40000 ALTER TABLE `productbytask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `name` tinytext NOT NULL,
  `length` tinyint(4) NOT NULL,
  `recovery` float NOT NULL,
  `summary` tinytext NOT NULL,
  `descriptionProduct` varchar(500) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING HASH,
  UNIQUE KEY `name_2` (`name`) USING HASH,
  KEY `type` (`type`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (37,1,'ELASTOVAP',7,60,'','Élastovap est une feuille d’étanchéité constituée d’une armature en voile de verre et de bitume élastomère.',2.89),(38,1,'CHAPE ATLAS AR',7,60,'Chape Atlas AR est une chape souple de bitume élastomère armée par grille de verre – voile de verre.','Chape Atlas AR est une chape souple de bitume élastomère avec une armature grille de verre et voile de verre. Soudé en plein, il et utilisé comme pare-vapeur pour les toitures-terrasses en béton ou comme couche de finition autoprotégée pour les relevés d\'étanchéité. Le coloris Blanc Chagall avec un SRI de 59, fait partie de notre offre d\'étanchéité Cool Roof.',6.46),(39,2,'SAUCISSON',84,60,'','test redirection 5',2.00),(43,1,'COUVERTINE',3,20,'Une couvertine','De l\'alu en général',45.00),(44,2,'UN TEST',8,50,'Un résumé test','Encore un test mais en description',50.00),(53,2,'UN TEST ZINC',50,50,'un test zinc','Un test Zinc',50.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Assistant(e)'),(2,'Conducteur de travau'),(3,'Comptable'),(4,'Chef de Secteur'),(5,'Chef d\'agence'),(6,'Administrateur');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEstimate` int(11) NOT NULL,
  `taskNumber` int(11) DEFAULT NULL,
  `descriptionTask` text NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  `unitPrice` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEstimate` (`idEstimate`) USING BTREE,
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`idEstimate`) REFERENCES `estimate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=792 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (788,186,0,'Tache 1',NULL,NULL),(789,186,1,'Tache 2',NULL,NULL),(790,189,1,'Une tache',76,3.41),(791,189,1,'Une tache',76,3.41);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'ETANCHEITE'),(2,'ZINGUERIE');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `firstName` tinytext NOT NULL,
  `mail` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `role` (`role`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Plouz','Alex','eyola@gmail.com','$2y$10$g5pNZ04P669vMtLLuFtEherpsxH53XYx2vsCMwK94OmG2m78iGQui',6),(6,'Ronron','Siphy','ronron.siphy@gmail.com','$2y$10$YNMLobOQk0QtnUiDCqxEweWVWwaWxqes59vlbLo.5eO/61KAs1te2',6),(8,'conduc','1','conduc1@gmail.com','$2y$10$N4jTHif0oCytTvuLnpePNe9NKWWV3liYurqwVfyUvAzqwhpYbxCxu',2),(9,'secteur','2','secteur2@gmail.com','$2y$10$3e4bDDFI.8ltFh7pI6LyJ.1XM9QhlsWVmWYS7W7iTg8yoAKo8wyUq',4),(10,'agence','3','agence@gmail.com','$2y$10$0t4Qbw7jeLReEtQSOh9ik.bIYOaA8kJMwITC8Kw9eBPhJ4O0T/esG',5);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-11 16:20:40
