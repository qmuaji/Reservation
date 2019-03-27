-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.6.25 - MySQL Community Server (GPL)
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for Lan's Musikstudio
CREATE DATABASE IF NOT EXISTS `Lan's Musikstudio` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Lan's Musikstudio`;


-- Dumping structure for table Lan's Musikstudio.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `studio_id` bigint(20) unsigned NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `i_time` tinyint(4) unsigned NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Lan's Musikstudio.deposit
CREATE TABLE IF NOT EXISTS `deposit` (
  `deposit_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `trans_date` date NOT NULL,
  `add_saldo` int(10) unsigned NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `user_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `admin_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`deposit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Lan's Musikstudio.profit
CREATE TABLE IF NOT EXISTS `profit` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `p_in` int(11) unsigned NOT NULL,
  `p_out` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Lan's Musikstudio.studios
CREATE TABLE IF NOT EXISTS `studios` (
  `studio_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(128) NOT NULL,
  PRIMARY KEY (`studio_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Lan's Musikstudio.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `studio_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `q` tinyint(3) unsigned NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`trans_id`),
  UNIQUE KEY `book_code` (`book_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Lan's Musikstudio.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `saldo` int(11) unsigned DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `tlp` varchar(16) DEFAULT NULL,
  `address` text,
  `img` tinytext,
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `email_code` varchar(64) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
