-- MySQL dump 10.13  Distrib 5.1.36, for Win32 (ia32)
--
-- Host: localhost    Database: clinica
-- ------------------------------------------------------
-- Server version	5.1.36-community-log

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
-- Table structure for table `_socialize_config`
--

DROP TABLE IF EXISTS `_socialize_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_socialize_config` (
  `config_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `config_key` varchar(50) NOT NULL,
  `config_value` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_socialize_config`
--

LOCK TABLES `_socialize_config` WRITE;
/*!40000 ALTER TABLE `_socialize_config` DISABLE KEYS */;
INSERT INTO `_socialize_config` VALUES (1,'migration_current','3');
/*!40000 ALTER TABLE `_socialize_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_socialize_users`
--

DROP TABLE IF EXISTS `_socialize_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_socialize_users` (
  `user_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(40) NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_socialize_users`
--

LOCK TABLES `_socialize_users` WRITE;
/*!40000 ALTER TABLE `_socialize_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `_socialize_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_socialize_users_networks`
--

DROP TABLE IF EXISTS `_socialize_users_networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_socialize_users_networks` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(9) unsigned NOT NULL,
  `network_user_id` varchar(150) NOT NULL,
  `network` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_socialize_users_networks`
--

LOCK TABLES `_socialize_users_networks` WRITE;
/*!40000 ALTER TABLE `_socialize_users_networks` DISABLE KEYS */;
/*!40000 ALTER TABLE `_socialize_users_networks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atencion`
--

DROP TABLE IF EXISTS `atencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_rut` varchar(50) NOT NULL,
  `examen_id` int(11) NOT NULL,
  `usuario_user_name` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `confirmacion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paciente_examen_paciente1` (`paciente_rut`),
  KEY `fk_paciente_examen_examen1` (`examen_id`),
  KEY `fk_atencion_usuario1` (`usuario_user_name`),
  CONSTRAINT `fk_atencion_usuario1` FOREIGN KEY (`usuario_user_name`) REFERENCES `usuario` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_paciente_examen_examen1` FOREIGN KEY (`examen_id`) REFERENCES `examen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_paciente_examen_paciente1` FOREIGN KEY (`paciente_rut`) REFERENCES `paciente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atencion`
--

LOCK TABLES `atencion` WRITE;
/*!40000 ALTER TABLE `atencion` DISABLE KEYS */;
INSERT INTO `atencion` VALUES (1,'13456334-2',2,'juan_maldonado','examen insulina','2010-10-14 19:09:05','confirmado'),(2,'12334223-2',1,'juan_maldonado','','2010-09-16 19:09:32','confirmado'),(3,'736376',2,'gonzalo_vidal','examen hormonal','2010-09-16 20:49:14','confirmado'),(4,'9.456.456-7',6,'juan_maldonado','examen de calcio','2010-12-17 02:27:56','confirmado'),(5,'5.567.543-7',5,'juan_maldonado','hematocritos','2010-12-23 02:29:15','suspendido');
/*!40000 ALTER TABLE `atencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('1a9e92bee2c324a3a2d3d2998a2a5dfe','127.0.0.1','Mozilla/5.0 (Windows; U; Windows NT 6.1; es-ES; rv',1291831072,''),('bc49520e6fef0e98cebeed18b213bd33','127.0.0.1','Mozilla/5.0 (Windows; U; Windows NT 6.1; es-ES; rv',1291826067,'');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen`
--

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
INSERT INTO `examen` VALUES (1,'orina','hormonal','ayuno antes del examen por 12 horas'),(2,'sangre','hormonal',''),(4,'fibrinogeno','hematologia','ayuno 24 hrs'),(5,'colesterol','bioquimica','ayuno 24 hrs'),(6,'calcemia','bioquimica','ingesta agua 6 horas'),(7,'hematocrito','hematologia','ninguna'),(9,'linfocitos','hematologia','orina por la mañana');
/*!40000 ALTER TABLE `examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ficha_clinica`
--

DROP TABLE IF EXISTS `ficha_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ficha_clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_sanguineo` varchar(45) NOT NULL,
  `enfermedades` text NOT NULL,
  `operaciones` text NOT NULL,
  `item_ficha_clinica_id` int(11) NOT NULL,
  `paciente_rut` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ficha_clinica_item_ficha_clinica1` (`item_ficha_clinica_id`),
  KEY `fk_ficha_clinica_paciente1` (`paciente_rut`),
  CONSTRAINT `fk_ficha_clinica_item_ficha_clinica1` FOREIGN KEY (`item_ficha_clinica_id`) REFERENCES `item_ficha_clinica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ficha_clinica_paciente1` FOREIGN KEY (`paciente_rut`) REFERENCES `paciente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ficha_clinica`
--

LOCK TABLES `ficha_clinica` WRITE;
/*!40000 ALTER TABLE `ficha_clinica` DISABLE KEYS */;
INSERT INTO `ficha_clinica` VALUES (1,'rh','diabetes','higado',1,'12334223-2'),(2,'rh2','reumatismo','ninguna',2,'13456334-2'),(4,'rh2','diabetes mellitus II','transplante de miocardio',3,'9.456.456-7');
/*!40000 ALTER TABLE `ficha_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_ficha_clinica`
--

DROP TABLE IF EXISTS `item_ficha_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_ficha_clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `observacion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_ficha_clinica`
--

LOCK TABLES `item_ficha_clinica` WRITE;
/*!40000 ALTER TABLE `item_ficha_clinica` DISABLE KEYS */;
INSERT INTO `item_ficha_clinica` VALUES (1,'2010-11-01 19:11:05','se le administro insulina'),(2,'2010-11-01 19:12:33','se le administro diazepam'),(3,'2010-12-17 02:27:56','examen diabetes tipo ii'),(4,'2010-06-06 00:00:00','se le administro calmante'),(5,'1990-06-06 00:00:00','se le administro aspirina');
/*!40000 ALTER TABLE `item_ficha_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `rut` varchar(50) NOT NULL,
  `prevision_id` int(11) NOT NULL,
  `nombre` char(20) NOT NULL,
  `apellido_paterno` char(20) NOT NULL,
  `apellido_materno` char(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  PRIMARY KEY (`rut`),
  KEY `fk_paciente_prevision1` (`prevision_id`),
  CONSTRAINT `fk_paciente_prevision1` FOREIGN KEY (`prevision_id`) REFERENCES `prevision` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES ('12.345.567-8',2,'miguel','fuentes','villalobos','1985-12-13',25,'avenida del mar 5'),('12.666.766-8',1,'raul','jara','jara','1960-04-01',60,'arauco 34'),('12334223-2',1,'maria','cortez','vergara','1985-11-07',40,'los libertadores 02'),('13.456.666-7',3,'antonia','rivera','cortes','1988-12-17',23,'avenida paraguay 34'),('13456334-2',2,'carlos','salas','ponce','1985-11-17',42,'girasoles 634'),('14.654.566-7',4,'roberto','muñoz','contreras','1985-12-21',28,'avenida brasil 34'),('33.456.123-7',3,'nicolas','vargas','salinas','1985-12-13',28,'baquedano 344'),('5.567.543-7',6,'sandra','pavez','alvarez','1976-03-09',44,'avenida bolivia 34'),('736376',4,'cortes','cortes','da','2010-11-09',20,'das'),('9.456.456-7',3,'claudia','flores','galvez','1985-11-09',25,'avenida paraguay 34');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_cancha`
--

DROP TABLE IF EXISTS `pi_cancha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_cancha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `lugar_id` int(11) DEFAULT NULL,
  `modalidad` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '5x5, 7x7, etc\n',
  `superficie` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'es el tipo de suelo, cemento, pasto, etc',
  PRIMARY KEY (`id`),
  KEY `fk_pi_cancha_pi_lugar1` (`lugar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_cancha`
--

LOCK TABLES `pi_cancha` WRITE;
/*!40000 ALTER TABLE `pi_cancha` DISABLE KEYS */;
INSERT INTO `pi_cancha` VALUES (1,22222,1500,2,'7X7','2500'),(2,2800,3434,2,'7X7','1256'),(10,2222,12344,2,'11X11','CEMENTO');
/*!40000 ALTER TABLE `pi_cancha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_lugar`
--

DROP TABLE IF EXISTS `pi_lugar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_lugar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `comuna` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `cont_nombre` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `cont_mail` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `cont_telefono` varchar(45) COLLATE ucs2_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE ucs2_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_lugar`
--

LOCK TABLES `pi_lugar` WRITE;
/*!40000 ALTER TABLE `pi_lugar` DISABLE KEYS */;
INSERT INTO `pi_lugar` VALUES (1,'QUILIN','COMPLEJO QUILIN','PEÑALOLEN','332232','323','323','323','323'),(2,'COMPLEJO ACME','TOBALABA 1234','TOBALABA','2323232','C C','C@NIC.CL','433434','DESC');
/*!40000 ALTER TABLE `pi_lugar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prevision`
--

DROP TABLE IF EXISTS `prevision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prevision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prevision`
--

LOCK TABLES `prevision` WRITE;
/*!40000 ALTER TABLE `prevision` DISABLE KEYS */;
INSERT INTO `prevision` VALUES (1,'dipreca','a'),(2,'capredena','a'),(3,'fonasa','a'),(4,'fonasa ','b'),(5,'indigente',''),(6,'isapre',''),(9,'isapre','b');
/*!40000 ALTER TABLE `prevision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `user_name` varchar(20) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nombre` char(20) NOT NULL,
  `apellido_paterno` char(20) NOT NULL,
  `apellido_materno` char(20) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `rut` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `especialidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('admin','1234','juan','gonzalez','gonzalez','administrador','activo','17.112.123-7','baquedano 334','1989-11-10','administrador'),('federicos','1234','federico','santander','sweet','medico','acivo','13.456.222-6','peñuelas 34','1980-12-12','endocrinologo'),('gabrielad','1234','gabriela','diaz','alvarez','tecnologo','','12.456.678-9','avenida sauce 466','1977-12-24','tecnologo'),('gonzalo_vidal','1234','gonzalo','vidal','cortes','medico','activo','12.334.223-2','brasil 102','1985-11-16','nefrologo'),('juan_maldonado','1234','juan','maldonado','rivera','medico','activo','12.345.333-2','julio vasquez 888','1988-10-12','tecnologo'),('secretaria','1234','valeria','fernandez','fernandez','secretaria','activo','12.345.456-2','vicuña 444','1985-05-13',''),('vanessav','1234','vanessa','villarroel','vidal','medico','acivo','11.665.567-k','avenida salvador a. 545','1979-12-21','tecnologo');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-12-08 15:11:58
