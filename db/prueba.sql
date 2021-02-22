-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba
CREATE DATABASE IF NOT EXISTS `prueba` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `prueba`;

-- Volcando estructura para tabla prueba.history
CREATE TABLE IF NOT EXISTS `history` (
  `date` datetime DEFAULT NULL,
  `user_web` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_bd` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `action` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `module` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla prueba.history: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` (`date`, `user_web`, `user_bd`, `action`, `module`) VALUES
	('2021-02-22 15:09:09', '1', 'root@localhost', 'Insert', 'PQR'),
	('2021-02-22 15:59:40', 'prueba', 'root@localhost', 'Insert', 'Users'),
	('2021-02-22 16:56:46', 'prueba', 'root@localhost', 'Insert', 'Users'),
	('2021-02-22 17:04:01', '1', 'root@localhost', 'Insert', 'PQR'),
	('2021-02-22 17:04:56', '1', 'root@localhost', 'Update', 'PQR'),
	('2021-02-22 17:05:48', '1', 'root@localhost', 'Update', 'PQR'),
	('2021-02-22 17:22:39', 'prueba2', 'root@localhost', 'Insert', 'Users'),
	('2021-02-22 17:44:35', 'prueba11', 'root@localhost', 'Insert', 'Users');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.type_pqr
CREATE TABLE IF NOT EXISTS `type_pqr` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla prueba.type_pqr: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `type_pqr` DISABLE KEYS */;
INSERT INTO `type_pqr` (`id_type`, `description`) VALUES
	(1, 'Peticion'),
	(2, 'Queja'),
	(3, 'Reclamo');
/*!40000 ALTER TABLE `type_pqr` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.type_users
CREATE TABLE IF NOT EXISTS `type_users` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla prueba.type_users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `type_users` DISABLE KEYS */;
INSERT INTO `type_users` (`id_type`, `description`) VALUES
	(1, 'Admin'),
	(2, 'standar');
/*!40000 ALTER TABLE `type_users` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `type_user` int(11) DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `type_user` (`type_user`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_user`) REFERENCES `type_users` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla prueba.users: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `name`, `password`, `type_user`, `last_edit`) VALUES
	(1, 'admin', '$argon2id$v=19$m=1024,t=2,p=2$a1hGQ3JDUEsyTkw4Lmk1dg$xtUgl5ZfP6JTT/SpR4fMuq3/nhN0WyjmdcQ1DgrFCew', 1, NULL),
	(2, 'estandar', '$argon2id$v=19$m=1024,t=2,p=2$Z0wvSUdaejNrSGEvUXI0NA$chv818VsYYD7wZm7PbTCRkPPc8AQdC872PUvsWhiEFU', 2, NULL),
	(4, 'prueba', '$argon2id$v=19$m=65536,t=4,p=1$M0p4RVhGM25yQWZ1eUVpeg$T8VuAuCl7TpbiWBSkaJmR8svumxWtnpUHlxSofOKetc', 2, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.users_pqr
CREATE TABLE IF NOT EXISTS `users_pqr` (
  `id_pqr` int(11) NOT NULL AUTO_INCREMENT,
  `type_pqr` int(11) DEFAULT NULL,
  `subject` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_spanish_ci DEFAULT 'Nuevo',
  `id_user` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_limit` date DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pqr`),
  KEY `type_pqr` (`type_pqr`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `users_pqr_ibfk_1` FOREIGN KEY (`type_pqr`) REFERENCES `type_pqr` (`id_type`),
  CONSTRAINT `users_pqr_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla prueba.users_pqr: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users_pqr` DISABLE KEYS */;
INSERT INTO `users_pqr` (`id_pqr`, `type_pqr`, `subject`, `state`, `id_user`, `date_create`, `date_limit`, `last_edit`) VALUES
	(3, 1, 'Se daño la puerta', 'Nuevo', 2, '2021-02-22', '2021-03-01', 1),
	(4, 1, 'se daño la puerta', 'Cerrado', 4, '2021-02-22', '2021-03-01', 1);
/*!40000 ALTER TABLE `users_pqr` ENABLE KEYS */;

-- Volcando estructura para disparador prueba.after_pqr
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `after_pqr` AFTER INSERT ON `users_pqr` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),new.last_edit,CURRENT_USER(),'Insert','PQR');
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador prueba.after_pqr_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `after_pqr_delete` AFTER DELETE ON `users_pqr` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),old.last_edit,CURRENT_USER(),'Delete','PQR');
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador prueba.after_pqr_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `after_pqr_update` AFTER UPDATE ON `users_pqr` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),new.last_edit,CURRENT_USER(),'Update','PQR');
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador prueba.after_user
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `after_user` AFTER INSERT ON `users` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),new.name,CURRENT_USER(),'Insert','Users');
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador prueba.after_user_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `after_user_delete` BEFORE DELETE ON `history` FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),'1',CURRENT_USER(),'Delete','Users');
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador prueba.after_user_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `after_user_update` BEFORE UPDATE ON `history` FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),'1',CURRENT_USER(),'Update','Users');
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
