-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for softuni_booking
CREATE DATABASE IF NOT EXISTS `softuni_booking` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `softuni_booking`;

-- Dumping structure for table softuni_booking.offers
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `days` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `picture_url` text NOT NULL,
  `room_id` int(11) NOT NULL,
  `town_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_occupied` bit(1) NOT NULL DEFAULT b'0',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_offers_rooms` (`room_id`),
  KEY `FK_offers_towns` (`town_id`),
  KEY `FK_offers_users` (`user_id`),
  CONSTRAINT `FK_offers_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  CONSTRAINT `FK_offers_towns` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`),
  CONSTRAINT `FK_offers_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table softuni_booking.offers: ~0 rows (approximately)
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;

-- Dumping structure for table softuni_booking.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table softuni_booking.rooms: ~3 rows (approximately)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `type`) VALUES
	(1, 'Single Room'),
	(2, 'Double Room'),
	(3, 'Maisonette');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

-- Dumping structure for table softuni_booking.towns
CREATE TABLE IF NOT EXISTS `towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table softuni_booking.towns: ~6 rows (approximately)
/*!40000 ALTER TABLE `towns` DISABLE KEYS */;
INSERT INTO `towns` (`id`, `name`) VALUES
	(1, 'Sofia'),
	(2, 'Varna'),
	(3, 'Plovdiv'),
	(4, 'Burgas'),
	(5, 'Pleven'),
	(6, 'Other');
/*!40000 ALTER TABLE `towns` ENABLE KEYS */;

-- Dumping structure for table softuni_booking.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `money_spent` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table softuni_booking.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
