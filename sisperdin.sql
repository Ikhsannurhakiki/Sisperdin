/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.11-MariaDB : Database - sisperdin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sisperdin` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sisperdin`;

/*Table structure for table `datakwitansi` */

DROP TABLE IF EXISTS `datakwitansi`;

CREATE TABLE `datakwitansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nospt` varchar(15) NOT NULL,
  `peruntukkandana` text NOT NULL,
  `dana` bigint(20) NOT NULL,
  `ket` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kwitansinospt` (`nospt`),
  CONSTRAINT `kwitansinospt` FOREIGN KEY (`nospt`) REFERENCES `dataspt` (`nospt`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4;

/*Data for the table `datakwitansi` */

insert  into `datakwitansi`(`id`,`nospt`,`peruntukkandana`,`dana`,`ket`) values (103,'001/SPT/XII/20','Transportasi',500000,NULL),(104,'001/SPT/XII/20','Konsumsi',250000,NULL),(105,'003/SPT/XII/20','Transportasi',200000,NULL),(109,'001/SPT/II/21','Transportasi',600000,'2 orang PP');

/*Table structure for table `datapegawai` */

DROP TABLE IF EXISTS `datapegawai`;

CREATE TABLE `datapegawai` (
  `nip` char(21) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` char(14) NOT NULL,
  `tempatlahir` varchar(20) NOT NULL,
  `tanggallahir` date NOT NULL,
  `golongan` int(2) NOT NULL,
  `jabatan` int(2) NOT NULL DEFAULT 3,
  `foto` varchar(100) NOT NULL,
  `namaaslifoto` varchar(100) NOT NULL,
  `statusarsippegawai` enum('tidak','ya') NOT NULL,
  PRIMARY KEY (`nip`),
  KEY `golongan` (`golongan`),
  KEY `jabatan` (`jabatan`),
  CONSTRAINT `golongan` FOREIGN KEY (`golongan`) REFERENCES `dmgolongan` (`idgolongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jabatan` FOREIGN KEY (`jabatan`) REFERENCES `dmjabatan` (`idjabatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `datapegawai` */

insert  into `datapegawai`(`nip`,`nama`,`alamat`,`nohp`,`tempatlahir`,`tanggallahir`,`golongan`,`jabatan`,`foto`,`namaaslifoto`,`statusarsippegawai`) values ('197001121994121002','Zulfendra, S.Pd','Pematang Reba','080000000000','Pematang Reba','1970-01-01',1,5,'5ff4878be2391.jpg','no-image.jpg','tidak'),('197004051992031013','Syahrial, S.Sos','Jl Azkiaris','080000000000','Rengat','1970-01-01',10,6,'5ff487abd0382.jpg','no-image.jpg','tidak'),('197004051992031019','Ikhsan Nur Hakiki','Jl Air Dingin','081291829382','Pekanbaru','2020-04-06',7,18,'603751f045edf.jpeg','WhatsApp Image 2021-01-25 at 8.04.36 AM.jpeg','tidak'),('197409011997031004','Riswidiantoro, SE','Pematang Reba','080000000000','Pematang Reba','1974-01-01',10,1,'5ff49f2f64f04.jpg','no-image.jpg','tidak');

/*Table structure for table `datasppd` */

DROP TABLE IF EXISTS `datasppd`;

CREATE TABLE `datasppd` (
  `nosppd` varchar(15) NOT NULL,
  `nospt` varchar(15) NOT NULL,
  `nip` varchar(21) NOT NULL,
  `ttdsppd` int(11) NOT NULL,
  `tglinput` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`nosppd`),
  KEY `nospt` (`nospt`),
  KEY `nipsppd` (`nip`),
  KEY `ttdssppd` (`ttdsppd`),
  CONSTRAINT `nipsppd` FOREIGN KEY (`nip`) REFERENCES `datapegawai` (`nip`),
  CONSTRAINT `nospt` FOREIGN KEY (`nospt`) REFERENCES `dataspt` (`nospt`),
  CONSTRAINT `ttdssppd` FOREIGN KEY (`ttdsppd`) REFERENCES `dmpejabatttdsppd` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `datasppd` */

insert  into `datasppd`(`nosppd`,`nospt`,`nip`,`ttdsppd`,`tglinput`) values ('001/SPPD/II/21','001/SPT/II/21','197001121994121002',9,'2021-02-25 08:32:39'),('001/SPPD/XII/20','001/SPT/XII/20','197001121994121002',10,'2020-12-17 20:08:42'),('003/SPPD/XII/20','003/SPT/XII/20','197001121994121002',9,'2020-12-24 11:07:10');

/*Table structure for table `datasppdpengikut` */

DROP TABLE IF EXISTS `datasppdpengikut`;

CREATE TABLE `datasppdpengikut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nosppd` varchar(15) NOT NULL,
  `nospt` varchar(15) NOT NULL,
  `nip` varchar(21) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nospt` (`nospt`),
  KEY `nipsppd` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

/*Data for the table `datasppdpengikut` */

insert  into `datasppdpengikut`(`id`,`nosppd`,`nospt`,`nip`) values (75,'003/SPPD/XII/20','003/SPT/XII/20','197004051992031013'),(78,'001/SPPD/II/21','001/SPT/II/21','197004051992031019');

/*Table structure for table `dataspt` */

DROP TABLE IF EXISTS `dataspt`;

CREATE TABLE `dataspt` (
  `nospt` varchar(15) NOT NULL,
  `tglberangkat` date NOT NULL,
  `tglkembali` date NOT NULL,
  `lamaperjalanan` int(11) NOT NULL,
  `kotatujuan` varchar(100) NOT NULL,
  `maksudtujuan` text NOT NULL,
  `ket` text NOT NULL,
  `tglinput` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ttdspt` int(11) NOT NULL,
  `ttdsppd` int(11) NOT NULL,
  `ttdkomitmen` int(11) NOT NULL,
  `namaaslidokumen` varchar(100) DEFAULT NULL,
  `namaarsipdokumen` varchar(100) DEFAULT NULL,
  `namaaslilaporan` varchar(100) DEFAULT NULL,
  `namaarsiplaporan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nospt`),
  KEY `pgwperdin` (`tglberangkat`),
  KEY `idttdspt` (`ttdspt`),
  KEY `idttdsppd` (`ttdsppd`),
  KEY `idttdkomit` (`ttdkomitmen`),
  KEY `kotatujuan` (`kotatujuan`),
  CONSTRAINT `idttdkomit` FOREIGN KEY (`ttdkomitmen`) REFERENCES `dmpejabatttdkomitmen` (`id`),
  CONSTRAINT `idttdsppd` FOREIGN KEY (`ttdsppd`) REFERENCES `dmpejabatttdsppd` (`id`),
  CONSTRAINT `idttdspt` FOREIGN KEY (`ttdspt`) REFERENCES `dmpejabatttdspt` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `dataspt` */

insert  into `dataspt`(`nospt`,`tglberangkat`,`tglkembali`,`lamaperjalanan`,`kotatujuan`,`maksudtujuan`,`ket`,`tglinput`,`ttdspt`,`ttdsppd`,`ttdkomitmen`,`namaaslidokumen`,`namaarsipdokumen`,`namaaslilaporan`,`namaarsiplaporan`) values ('001/SPT/II/21','2021-02-25','2021-02-25',1,'Air Molek','Sosialisasi','','2021-02-25 14:36:04',17,9,9,'gunawansyahputra_173510125(Cyber).pdf','603753647fbaa.pdf',NULL,NULL),('001/SPT/XII/20','2020-12-08','2020-12-10',3,'Pekanbaru','Mengikuti pelatihan meningkatkan kualitas desa','Pelatihan dilaksanakan di hotel orime park pekanbaru yang diadakan selama 3 hari','2021-01-06 00:13:40',17,9,9,'data-pegawai.pdf','5ff49e3748e73.pdf','data-pegawai.pdf','5ff49e449219a.pdf'),('003/SPT/XII/20','2020-12-24','2020-12-26',3,'Jakarta','Melakukan pertemuan dengan dinas pusat','','2021-01-06 00:14:43',17,9,9,'data-pegawai.pdf','5ff49e67b2503.pdf','data-pegawai.pdf','5ff49e83a6a58.pdf');

/*Table structure for table `dmgolongan` */

DROP TABLE IF EXISTS `dmgolongan`;

CREATE TABLE `dmgolongan` (
  `idgolongan` int(2) NOT NULL AUTO_INCREMENT,
  `namapangkat` varchar(20) NOT NULL,
  `golongan` char(5) NOT NULL,
  `ruang` char(2) NOT NULL,
  `statusarsip` enum('tidak','ya') NOT NULL,
  PRIMARY KEY (`idgolongan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dmgolongan` */

insert  into `dmgolongan`(`idgolongan`,`namapangkat`,`golongan`,`ruang`,`statusarsip`) values (1,'Pembina','IV','A','tidak'),(2,'Pembina Tingkat I','IV','B','tidak'),(3,'Pembina Utama Muda','IV','C','tidak'),(4,'Pembina Utama Madya','IV','D','tidak'),(5,'Pembina Utama','IV','E','tidak'),(6,'Penata Muda','III','A','tidak'),(7,'Penata Muda Tingkat','III','B','tidak'),(9,'Penata','III','C','tidak'),(10,'Penata Tingkat I','III','D','tidak');

/*Table structure for table `dmjabatan` */

DROP TABLE IF EXISTS `dmjabatan`;

CREATE TABLE `dmjabatan` (
  `idjabatan` int(2) NOT NULL AUTO_INCREMENT,
  `namajabatan` text NOT NULL,
  `statusarsip` enum('tidak','ya') NOT NULL,
  PRIMARY KEY (`idjabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dmjabatan` */

insert  into `dmjabatan`(`idjabatan`,`namajabatan`,`statusarsip`) values (1,'Kepala Dinas','tidak'),(2,'Sekretaris','tidak'),(5,'Kepala Sub Bagian Umum','tidak'),(6,'Kepala Sub Bagian Program dan Keuangan','tidak'),(8,'Kepala Bidang Pemerintahan Desa','tidak'),(9,'Kepala Bidang Bina Keuangan dan Aset Desa','tidak'),(10,'Kepala Bidang Pemberdayaan Masyarakat Ekonomi Desa dab Teknologi Tepat Guna','tidak'),(11,'Kepala Seksi Kelembagaan dan Administrasi Pemerintahan Desa','tidak'),(13,'Kepala Seksi Kerjasama Usaha Ekonomi Desa dan Partisipasi Masyarakat','tidak'),(14,'Kepala Seksi Penataan dan Kerjasama Desa','tidak'),(15,'Kepala Seksi Penatausahaan Keuangan Desa','tidak'),(16,'Kepala Seksi Pemberdayaan Lembaga Kemasyarakatan dan Lembaga Adat','tidak'),(17,'Kepala Seksi Pembinaan Perangkat Desa','tidak'),(18,'Kepala Seksi Aset Desa','tidak'),(19,'Kepala Seksi Pedayagunaan Sumber Daya Alam dan Teknologi Tepat Guna','tidak'),(20,'-','tidak'),(23,'Bendahara','tidak');

/*Table structure for table `dmpejabatttdkomitmen` */

DROP TABLE IF EXISTS `dmpejabatttdkomitmen`;

CREATE TABLE `dmpejabatttdkomitmen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) NOT NULL,
  `statusarsip` enum('tidak','ya') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nip` (`nip`),
  CONSTRAINT `ttdkomit` FOREIGN KEY (`nip`) REFERENCES `datapegawai` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dmpejabatttdkomitmen` */

insert  into `dmpejabatttdkomitmen`(`id`,`nip`,`statusarsip`) values (9,'197409011997031004','tidak'),(10,'197004051992031013','tidak');

/*Table structure for table `dmpejabatttdsppd` */

DROP TABLE IF EXISTS `dmpejabatttdsppd`;

CREATE TABLE `dmpejabatttdsppd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) NOT NULL,
  `statusarsip` enum('tidak','ya') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nip` (`nip`),
  CONSTRAINT `ttdsppd` FOREIGN KEY (`nip`) REFERENCES `datapegawai` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dmpejabatttdsppd` */

insert  into `dmpejabatttdsppd`(`id`,`nip`,`statusarsip`) values (9,'197409011997031004','tidak'),(10,'197001121994121002','tidak');

/*Table structure for table `dmpejabatttdspt` */

DROP TABLE IF EXISTS `dmpejabatttdspt`;

CREATE TABLE `dmpejabatttdspt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) NOT NULL,
  `statusarsip` enum('tidak','ya') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nip` (`nip`),
  CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `datapegawai` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dmpejabatttdspt` */

insert  into `dmpejabatttdspt`(`id`,`nip`,`statusarsip`) values (17,'197409011997031004','tidak');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` char(14) NOT NULL,
  `namafotoasli` varchar(100) NOT NULL,
  `namafotorandom` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`alamat`,`nohp`,`namafotoasli`,`namafotorandom`,`status`) values (9,'Admin','$2y$10$jYtv//lpSe4wol3xYSM.GevVtt.LAPcC2IsXg1qdo8RZEN4WT7bBa','Jl Asia Afrika','081273848229','no-image.jpg','5ff488ca6bd40.jpg','Admin'),(10,'Super Admin2','$2y$10$5gGcsRT0I68RukKF7BDpkuHfkZoWqPZd4Iq6iLf3YOHnbuiaLAi7.','Jl Kuantan Timur','082285742234','chip.png','6035c15fbd26b.png','Super Admin'),(12,'Ikhsan Nur Hakiki','$2y$10$2pARXug0VjFSgK8GR7KHXOq4QQJqa2wT6LTYS0SYX7y7aVvfI9Mgy','Jl Pasir Putih','081291829382','chip.png','603754827ae4b.png','Super Admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
