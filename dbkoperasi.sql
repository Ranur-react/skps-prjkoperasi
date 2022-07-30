/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.20-MariaDB : Database - dbkop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbkop` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `dbkop`;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `noanggota` char(50) NOT NULL,
  `namaanggota` varchar(150) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` int(15) NOT NULL,
  `tglmasuk` date NOT NULL,
  KEY `noanggota` (`noanggota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `anggota` */

insert  into `anggota`(`noanggota`,`namaanggota`,`pekerjaan`,`alamat`,`telepon`,`tglmasuk`) values 
('a001','diana riska','mahasiswa','alahan panjang',81234111,'2022-03-16'),
('a002','iqbal fajri','mahasiswa','padang',8636665,'2022-03-13');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2022-03-16-060307','App\\Database\\Migrations\\pegawai','default','App',1647410874,1),
(2,'2022-03-16-060316','App\\Database\\Migrations\\anggota','default','App',1647410874,1),
(3,'2022-03-16-060322','App\\Database\\Migrations\\simpanan','default','App',1647410874,1);

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `nik` char(150) NOT NULL,
  `namapegawai` varchar(150) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gajipokok` double NOT NULL,
  `status` varchar(50) NOT NULL,
  KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pegawai` */

insert  into `pegawai`(`nik`,`namapegawai`,`jabatan`,`gajipokok`,`status`) values 
('931000','abdul','staff',1000,'aktif'),
('94811','riski','hrd',2000,'aktif');

/*Table structure for table `simpanan` */

DROP TABLE IF EXISTS `simpanan`;

CREATE TABLE `simpanan` (
  `nosimpanan` char(20) NOT NULL,
  `simnoanggota` char(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `jml` double NOT NULL,
  `ket` varchar(150) NOT NULL,
  `tglsimpan` date NOT NULL,
  PRIMARY KEY (`nosimpanan`),
  KEY `simpanan_simnoanggota_foreign` (`simnoanggota`),
  CONSTRAINT `simpanan_simnoanggota_foreign` FOREIGN KEY (`simnoanggota`) REFERENCES `anggota` (`noanggota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `simpanan` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
