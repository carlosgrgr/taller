-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: taller
-- ------------------------------------------------------
-- Server version	5.7.9-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellido1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'24111111p','cliente1','Pérez','Pérez','c/aguas blancas',958121212),(2,'24222222q','cliente2','Sánchez','Gómez','c/sorbete',958343434),(3,'24333333r','cliente3','Martín','Castillo','c/machado',666444333),(4,'24444444s','cliente4','Caldero','Suarez','c/sincero',668382910),(5,'76419414m','Carlos','García','García','calle adolfa gautier',948538273),(6,'83729183n','Francisco','garrido','abelardo','calle pareja',958486151);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallefactura`
--

DROP TABLE IF EXISTS `detallefactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallefactura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numFactura` int(11) NOT NULL,
  `detalles` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numFactura` (`numFactura`),
  CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`numFactura`) REFERENCES `factura` (`numFactura`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallefactura`
--

LOCK TABLES `detallefactura` WRITE;
/*!40000 ALTER TABLE `detallefactura` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallefactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `numFactura` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) NOT NULL,
  `vehiculo` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `mecanico` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`numFactura`),
  KEY `cliente` (`cliente`),
  KEY `vehiculo` (`vehiculo`),
  KEY `mecanico` (`mecanico`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculo` (`matricula`) ON UPDATE CASCADE,
  CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`mecanico`) REFERENCES `mecanico` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mecanico`
--

DROP TABLE IF EXISTS `mecanico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mecanico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellido1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mecanico`
--

LOCK TABLES `mecanico` WRITE;
/*!40000 ALTER TABLE `mecanico` DISABLE KEYS */;
INSERT INTO `mecanico` VALUES (12,'76419414','carlos','54948q','4846','8484',848);
/*!40000 ALTER TABLE `mecanico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculo` (
  `matricula` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motor` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anio` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `propietario` int(11) NOT NULL,
  PRIMARY KEY (`matricula`),
  KEY `propietario` (`propietario`),
  CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`propietario`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES ('4783CDS','Peugeot','207','1.2','2002',2);
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-27 12:02:23
