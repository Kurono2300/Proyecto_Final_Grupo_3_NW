-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: tienda

-- IMPORTANTE LEER!

-- De preferencia usar el script database - copia V2.0.sql
-- Ese fue el script creado previo al ingreso de datos a la BD, por lo tanto no habra conflictos con las relaciones.

-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Camisas'),(2,'Pantalones'),(3,'Gorras'),(4,'Zapatos'),(5,'Ropa Interior'),(6,'Medias'),(7,'Accesorios');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea_pedidos`
--

DROP TABLE IF EXISTS `linea_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linea_pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `unidades` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_pedidos` (`pedido_id`),
  KEY `fk_linea_producto` (`producto_id`),
  CONSTRAINT `fk_linea_pedidos` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_pedidos`
--

LOCK TABLES `linea_pedidos` WRITE;
/*!40000 ALTER TABLE `linea_pedidos` DISABLE KEYS */;
INSERT INTO `linea_pedidos` VALUES (1,1,3,2),(2,2,4,1),(3,3,4,1),(4,4,3,1),(5,4,4,1),(6,5,4,1),(7,5,3,1),(8,6,7,1),(9,7,8,1),(10,8,6,1),(11,8,3,1),(12,8,10,1);
/*!40000 ALTER TABLE `linea_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `municipio` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `costo` float(15,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedidos_usuario` (`usuario_id`),
  CONSTRAINT `fk_pedidos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,3,'Cortes','SPS','Col.Miraflores Calle 10',24000.00,'sended','2021-03-18','18:20:34'),(2,2,'Cortes','SPS','Col.Miraflores Calle 10',15000.00,'sended','2021-03-18','19:00:49'),(3,3,'Cortes','SPS','Col.Miraflores Calle 10',15000.00,'preparation','2021-03-23','19:48:10'),(4,3,'Cortes','SPS','Col.Miraflores Calle 10',27000.00,'confirmed','2021-03-26','14:37:13'),(5,3,'Cortes','SPS','Col.Miraflores Calle 10',27000.00,'confirmed','2021-04-08','19:27:01'),(6,23,'Cortes','SPS','Col.Miraflores Calle 10',200.00,'confirmed','2021-04-11','20:36:52'),(7,23,'Cortes','SPS','Col.Miraflores Calle 10',100.00,'confirmed','2021-04-11','22:43:25'),(8,23,'Cortes','SPS','Col.Miraflores Calle 10',180.00,'confirmed','2021-04-11','22:44:26');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria_id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `precio` float(15,2) NOT NULL,
  `stock` int NOT NULL,
  `oferta` varchar(5) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categorias` (`categoria_id`),
  CONSTRAINT `fk_producto_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (3,1,'Polo','Polo de excelente calidad',120.00,10,NULL,'2017-06-15','camisa2.jpg'),(4,2,'Adidas','Buzo negro de alta calidad de costura',150.00,6,'','2017-06-06','PANTALONES1.jpg'),(6,3,'Nike','Gorra de Prueba ',10.00,9,NULL,'2021-04-11','gorra2.jpg'),(7,4,'Tommy','Zapatillas de prueba',200.00,9,NULL,'2021-04-11','TENIS 1.jpg'),(8,1,'Camisa de Prueba 2','Probando la segunda camisa al azar',100.00,9,NULL,'2021-04-11','camisa3.jpg'),(9,2,'Pantalon de Prueba 2','Pantalon de Prueba numero 2',200.00,13,NULL,'2021-04-11','PANTALONES2.jpg'),(10,6,'Medias de Prueba','Medias de intento numero 1',50.00,10,NULL,'2021-04-11','media2.jpg'),(11,7,'Accesorio de Prueba','Intentando el rand de Accesorio de prueab',30.00,15,NULL,'2021-04-11','accesorio3.jpg'),(12,1,'Camisa de Prueba 3','Intento Post Prueba',200.00,50,NULL,'2021-04-13','camisa.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'ADMIN','ADMIN','ADMIN@ADMIN.COM','ADMIN','ADMIN',NULL),(2,'Emilio','Escoto','pruebas@gmail.com','$2y$04$NAWh9w5luZkW2bW2oflwt.92ZjQ70EXAfGnBHLyNEWNjzq/oifoiq','admin',NULL),(3,'Kurono','Ems','probando@gmail.com','$2y$04$ZiPlEuIuN3OKJhOV8v6eKOHZItT.3nE6pH0zWu0Z1HBQW9mNDkcUS','user',NULL),(22,'Emilio','Funez','emifunez@gmail.com','aa7f2be7e596b8d666d0acc35ecba0a7f7b877e36715083332239dc6da588f32','admin',NULL),(23,'Kuro','Shiro','kuro@gmail.com','aa7f2be7e596b8d666d0acc35ecba0a7f7b877e36715083332239dc6da588f32','user',NULL),(25,'Neo','Lang','neo@gmail.com','a28e550eda56925ca10c1dfeeae57fc92791af2b8d5b3948075bf4d73f3c7960','user',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tienda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-13 18:46:22
