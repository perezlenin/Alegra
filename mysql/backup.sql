-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: alegra
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `historialcompras`
--

DROP TABLE IF EXISTS `historialcompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historialcompras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idingrediente` int NOT NULL,
  `idpedido` int NOT NULL,
  `cantidad_compra` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historialcompras`
--

LOCK TABLES `historialcompras` WRITE;
/*!40000 ALTER TABLE `historialcompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `historialcompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ingrediente` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_disponible` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientes`
--

LOCK TABLES `ingredientes` WRITE;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` VALUES (1,'tomato',5,'2021-11-17 21:04:16','2021-11-17 21:04:16',NULL),(2,'lemon',5,'2021-11-17 21:04:21','2021-11-17 21:04:21',NULL),(3,'potato',5,'2021-11-17 21:04:24','2021-11-17 21:04:24',NULL),(4,'rice',5,'2021-11-17 21:04:28','2021-11-17 21:04:28',NULL),(5,'ketchup',5,'2021-11-17 21:04:32','2021-11-17 21:04:32',NULL),(6,'lettuce',5,'2021-11-17 21:04:35','2021-11-17 21:04:35',NULL),(7,'onion',5,'2021-11-17 21:04:39','2021-11-17 21:04:39',NULL),(8,'cheese',5,'2021-11-17 21:04:44','2021-11-17 21:04:44',NULL),(9,'meat',5,'2021-11-17 21:04:48','2021-11-17 21:04:48',NULL),(10,'chicken',5,'2021-11-17 21:04:51','2021-11-17 21:04:51',NULL);
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021_11_14_161140_receta',1),(2,'2021_11_14_183914_receta_ingredientes',1),(3,'2021_11_14_201842_ingredientes',2),(4,'2021_11_14_211455_historialcompras',3),(5,'2021_11_15_154953_pedidos',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idreceta` int NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta`
--

DROP TABLE IF EXISTS `receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `receta` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta`
--

LOCK TABLES `receta` WRITE;
/*!40000 ALTER TABLE `receta` DISABLE KEYS */;
INSERT INTO `receta` VALUES (1,'Ecabeche de pollo','2021-11-17 21:01:42','2021-11-17 21:01:42',NULL),(2,'Pollo al horno','2021-11-17 21:05:54','2021-11-17 21:05:54',NULL),(3,'Asado de Res','2021-11-17 21:06:29','2021-11-17 21:06:29',NULL),(4,'Pasta con queso','2021-11-17 21:07:12','2021-11-17 21:07:12',NULL),(5,'Sopa de arroz','2021-11-17 21:08:15','2021-11-17 21:08:15',NULL),(6,'Pure de papa','2021-11-17 21:09:54','2021-11-17 21:09:54',NULL);
/*!40000 ALTER TABLE `receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta_ingredientes`
--

DROP TABLE IF EXISTS `receta_ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receta_ingredientes` (
  `idreceta` int NOT NULL,
  `idingrediente` int NOT NULL,
  `cantidad_ingrediente` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta_ingredientes`
--

LOCK TABLES `receta_ingredientes` WRITE;
/*!40000 ALTER TABLE `receta_ingredientes` DISABLE KEYS */;
INSERT INTO `receta_ingredientes` VALUES (1,4,3,'2021-11-17 21:01:42','2021-11-17 21:01:42',NULL),(1,7,2,'2021-11-17 21:01:42','2021-11-17 21:01:42',NULL),(1,1,1,'2021-11-17 21:01:42','2021-11-17 21:01:42',NULL),(1,6,2,'2021-11-17 21:01:42','2021-11-17 21:01:42',NULL),(1,10,2,'2021-11-17 21:01:42','2021-11-17 21:01:42',NULL),(2,4,3,'2021-11-17 21:05:54','2021-11-17 21:05:54',NULL),(2,3,2,'2021-11-17 21:05:54','2021-11-17 21:05:54',NULL),(2,7,1,'2021-11-17 21:05:54','2021-11-17 21:05:54',NULL),(2,6,2,'2021-11-17 21:05:54','2021-11-17 21:05:54',NULL),(2,10,2,'2021-11-17 21:05:54','2021-11-17 21:05:54',NULL),(3,2,3,'2021-11-17 21:06:29','2021-11-17 21:06:29',NULL),(3,3,2,'2021-11-17 21:06:29','2021-11-17 21:06:29',NULL),(3,7,1,'2021-11-17 21:06:29','2021-11-17 21:06:29',NULL),(3,6,2,'2021-11-17 21:06:29','2021-11-17 21:06:29',NULL),(3,9,2,'2021-11-17 21:06:29','2021-11-17 21:06:29',NULL),(4,8,3,'2021-11-17 21:07:12','2021-11-17 21:07:12',NULL),(4,1,2,'2021-11-17 21:07:12','2021-11-17 21:07:12',NULL),(4,7,1,'2021-11-17 21:07:12','2021-11-17 21:07:12',NULL),(4,3,2,'2021-11-17 21:07:12','2021-11-17 21:07:12',NULL),(4,10,2,'2021-11-17 21:07:12','2021-11-17 21:07:12',NULL),(5,1,3,'2021-11-17 21:08:15','2021-11-17 21:08:15',NULL),(5,3,2,'2021-11-17 21:08:15','2021-11-17 21:08:15',NULL),(5,4,1,'2021-11-17 21:08:15','2021-11-17 21:08:15',NULL),(5,7,2,'2021-11-17 21:08:15','2021-11-17 21:08:15',NULL),(5,10,2,'2021-11-17 21:08:15','2021-11-17 21:08:15',NULL),(6,5,2,'2021-11-17 21:09:54','2021-11-17 21:09:54',NULL),(6,3,3,'2021-11-17 21:09:54','2021-11-17 21:09:54',NULL),(6,2,2,'2021-11-17 21:09:54','2021-11-17 21:09:54',NULL),(6,7,2,'2021-11-17 21:09:54','2021-11-17 21:09:54',NULL),(6,1,1,'2021-11-17 21:09:54','2021-11-17 21:09:54',NULL),(6,10,2,'2021-11-17 21:09:54','2021-11-17 21:09:54',NULL);
/*!40000 ALTER TABLE `receta_ingredientes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-18  2:11:08
