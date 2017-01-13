/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.15-0ubuntu0.16.04.1 : Database - dbproject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbproject` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;

USE `dbproject`;

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id` char(14) COLLATE utf8_spanish2_ci NOT NULL,
  `role` smallint(6) NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` char(60) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_person_employee` FOREIGN KEY (`id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `employee` */

insert  into `employee`(`id`,`role`,`user`,`password`) values ('Eblvye4xn92b3e',1,'w4XCl8Kewp7CpQ==','$2y$10$FwMZHj/6I.dWybzlIzho7epRI3jFKOWnFOo1VaLOZtcdGL0nWIfIG');

/*Table structure for table `person` */

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `id` char(14) COLLATE utf8_spanish2_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lastname` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `secondlastname` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `person` */

insert  into `person`(`id`,`name`,`lastname`,`secondlastname`) values ('Eblvye4xn92b3e','jose','guillermo','inche');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
