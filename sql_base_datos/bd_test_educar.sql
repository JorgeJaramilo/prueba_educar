/*
SQLyog Ultimate
MySQL - 5.7.22 : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `movimiento` */

CREATE TABLE `movimiento` (
  `id_movi` int(11) NOT NULL AUTO_INCREMENT,
  `id_usu` int(11) NOT NULL,
  `saldo_ant` float NOT NULL,
  `saldo_nue` float NOT NULL,
  `fech_mov` date NOT NULL,
  `hora_mov` time NOT NULL,
  `tipo_mov` int(11) NOT NULL,
  `usua_mov` int(11) NOT NULL,
  `saldo_mov` float NOT NULL,
  PRIMARY KEY (`id_movi`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `movimiento` */

insert  into `movimiento`(`id_movi`,`id_usu`,`saldo_ant`,`saldo_nue`,`fech_mov`,`hora_mov`,`tipo_mov`,`usua_mov`,`saldo_mov`) values (10,1,1000,500,'2021-05-13','17:39:28',2,2,500);
insert  into `movimiento`(`id_movi`,`id_usu`,`saldo_ant`,`saldo_nue`,`fech_mov`,`hora_mov`,`tipo_mov`,`usua_mov`,`saldo_mov`) values (11,2,1000,1500,'2021-05-13','17:39:28',3,1,500);
insert  into `movimiento`(`id_movi`,`id_usu`,`saldo_ant`,`saldo_nue`,`fech_mov`,`hora_mov`,`tipo_mov`,`usua_mov`,`saldo_mov`) values (12,2,1500,1000,'2021-05-13','17:45:23',2,1,500);
insert  into `movimiento`(`id_movi`,`id_usu`,`saldo_ant`,`saldo_nue`,`fech_mov`,`hora_mov`,`tipo_mov`,`usua_mov`,`saldo_mov`) values (13,1,500,1000,'2021-05-13','17:45:23',3,2,500);

/*Table structure for table `tipo_movimiento` */

CREATE TABLE `tipo_movimiento` (
  `id_movi` int(11) NOT NULL AUTO_INCREMENT,
  `desc_movi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_movi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_movimiento` */

insert  into `tipo_movimiento`(`id_movi`,`desc_movi`) values (1,'recargar');
insert  into `tipo_movimiento`(`id_movi`,`desc_movi`) values (2,'transferir');
insert  into `tipo_movimiento`(`id_movi`,`desc_movi`) values (3,'transferencia');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `saldo` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (1,'usuario','uno',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (2,'usuario','dos',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (3,'usuario','tres',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (4,'usuario','cuatro',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (5,'usuario','cinco',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (6,'usuario','seis',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (7,'usuario','siete',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (8,'usuario','ocho',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (9,'usuario','nueve',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (10,'usuario','diez ',1000);
insert  into `users`(`id`,`nombre`,`apellidos`,`saldo`) values (11,'','',1000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
