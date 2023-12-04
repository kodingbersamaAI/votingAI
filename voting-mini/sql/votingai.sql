-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table votingai.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `usernameAdmin` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `passwordAdmin` varchar(250) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `namaAdmin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table votingai.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id`, `usernameAdmin`, `passwordAdmin`, `namaAdmin`) VALUES
	(1, 'admin', '$2y$10$H1VaTcGqPdd9AgeBy1YF/Op1B5jThgSK.HSIMVLmWL7o/8eF8GWmS', 'Nuur M');

-- Dumping structure for table votingai.pemilih
CREATE TABLE IF NOT EXISTS `pemilih` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idPemilih` varchar(250) DEFAULT NULL,
  `passwordPemilih` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namaPemilih` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelaminPemilih` varchar(250) DEFAULT NULL,
  `statusPemilih` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table votingai.pemilih: ~0 rows (approximately)

-- Dumping structure for table votingai.pilihan
CREATE TABLE IF NOT EXISTS `pilihan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idPilihan` varchar(250) DEFAULT NULL,
  `fotoPilihan` varchar(250) DEFAULT NULL,
  `namaPilihan` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelaminPilihan` varchar(250) DEFAULT NULL,
  `lahirPilihan` varchar(250) DEFAULT NULL,
  `visiPilihan` longtext,
  `misiPilihan` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table votingai.pilihan: ~0 rows (approximately)

-- Dumping structure for table votingai.vote
CREATE TABLE IF NOT EXISTS `vote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namaPilihan` varchar(250) DEFAULT NULL,
  `idPemilih` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table votingai.vote: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
