/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.1.38-MariaDB : Database - prueba
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`prueba` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `prueba`;

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `date` datetime DEFAULT NULL,
  `user_web` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_bd` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `action` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `module` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `history` */

/*Table structure for table `type_pqr` */

DROP TABLE IF EXISTS `type_pqr`;

CREATE TABLE `type_pqr` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `type_pqr` */

insert  into `type_pqr`(`id_type`,`description`) values 
(1,'Petición'),
(2,'Queja'),
(3,'Reclamo');

/*Table structure for table `type_users` */

DROP TABLE IF EXISTS `type_users`;

CREATE TABLE `type_users` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `type_users` */

insert  into `type_users`(`id_type`,`description`) values 
(1,'Admin'),
(2,'standar');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `type_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `type_user` (`type_user`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_user`) REFERENCES `type_users` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `users` */

insert  into `users`(`id_user`,`name`,`password`,`type_user`) values 
(1,'admin','$argon2id$v=19$m=1024,t=2,p=2$a1hGQ3JDUEsyTkw4Lmk1dg$xtUgl5ZfP6JTT/SpR4fMuq3/nhN0WyjmdcQ1DgrFCew',1),
(2,'estandar','$argon2id$v=19$m=1024,t=2,p=2$Z0wvSUdaejNrSGEvUXI0NA$chv818VsYYD7wZm7PbTCRkPPc8AQdC872PUvsWhiEFU',2);

/*Table structure for table `users_pqr` */

DROP TABLE IF EXISTS `users_pqr`;

CREATE TABLE `users_pqr` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `users_pqr` */

/* Trigger structure for table `users` */

DELIMITER $$

USE `prueba`$$

DROP TRIGGER /*!50032 IF EXISTS */ `after_pqr`$$

CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `after_pqr` AFTER INSERT ON `users_pqr` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),new.last_edit,CURRENT_USER(),'Insert','PQR');
    END;
$$

DELIMITER  ;

/* Trigger structure for table `users_pqr` */

DELIMITER $$

USE `prueba`$$

DROP TRIGGER /*!50032 IF EXISTS */ `after_pqr_delete`$$

CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `after_pqr_delete` AFTER DELETE ON `users_pqr` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),old.last_edit,CURRENT_USER(),'Delete','PQR');
    END;
$$

DELIMITER ;

/* Trigger structure for table `users_pqr` */

DELIMITER $$

USE `prueba`$$

DROP TRIGGER /*!50032 IF EXISTS */ `after_pqr_update`$$

CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `after_pqr_update` AFTER UPDATE ON `users_pqr` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),new.last_edit,CURRENT_USER(),'Update','PQR');
    END;
$$

DELIMITER ;

/* Trigger structure for table `users_pqr` */

DELIMITER $$

USE `prueba`$$

DROP TRIGGER /*!50032 IF EXISTS */ `after_user`$$

CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `after_user` AFTER INSERT ON `users` 
    FOR EACH ROW BEGIN
  INSERT INTO history (history.`date`,history.`user_web`,history.`user_bd`,history.`action`,history.`module`)
  VALUES(NOW(),new.name,CURRENT_USER(),'Insert','Users');
    END;
$$

DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
