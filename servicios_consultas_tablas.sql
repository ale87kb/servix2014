-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-11-07 06:39:21
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table servix_db.consultas_servicios
DROP TABLE IF EXISTS `consultas_servicios`;
CREATE TABLE IF NOT EXISTS `consultas_servicios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(10) DEFAULT '0',
  `id_usuario` int(10) DEFAULT '0',
  `fecha` datetime DEFAULT NULL,
  `consulta` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table servix_db.consultas_servicios: ~0 rows (approximately)
DELETE FROM `consultas_servicios`;
/*!40000 ALTER TABLE `consultas_servicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultas_servicios` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
