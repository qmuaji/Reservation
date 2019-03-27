
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2016 at 06:09 AM
-- Server version: 10.0.22-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u426975594_lans`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `studio_id` bigint(20) unsigned NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `i_time` tinyint(4) unsigned NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `studio_id`, `book_code`, `book_date`, `i_time`) VALUES
(113, 39, '0112150001', '2015-12-01', 10),
(114, 39, '0112150001', '2015-12-01', 11),
(115, 39, '0112150001', '2015-12-01', 12),
(116, 39, '0112150002', '2015-12-01', 15),
(117, 36, '0112150003', '2015-12-01', 16),
(118, 39, '1312150001', '2015-12-13', 13),
(119, 39, '1902160001', '2016-02-19', 10),
(120, 39, '1902160001', '2016-02-19', 11),
(121, 36, '2002160001', '2016-02-20', 10),
(122, 36, '2102160001', '2016-02-21', 10),
(123, 36, '2102160001', '2016-02-21', 11);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `deposit_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `trans_date` date NOT NULL,
  `add_saldo` int(10) unsigned NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `user_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `admin_confirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`deposit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `trans_date`, `add_saldo`, `no_rek`, `user_confirm`, `admin_confirm`) VALUES
(0, 15, '2015-12-01', 300015, '321123321', 1, 1),
(34, 15, '2015-12-04', 50015, '', 1, 1),
(35, 15, '0000-00-00', 50015, '', 0, 0),
(36, 15, '0000-00-00', 50015, '', 0, 0),
(37, 15, '2015-12-13', 50015, '', 1, 1),
(38, 15, '2015-12-02', 1000015, '224422655221', 1, 0),
(39, 16, '0000-00-00', 50016, '4444444', 0, 1),
(40, 19, '0000-00-00', 50019, '', 0, 0),
(41, 19, '2016-02-20', 100019, '123123123123', 1, 0),
(42, 19, '2016-02-20', 50019, '12312312', 1, 1),
(43, 22, '2016-02-26', 50022, '123123123123', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `eq_id` int(10) unsigned NOT NULL,
  `tipe` char(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_beli` date NOT NULL,
  `status` set('Baik','Kurang Baik','Under Maintenance') NOT NULL DEFAULT 'Baik',
  PRIMARY KEY (`eq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE IF NOT EXISTS `maintenance` (
  `maint_id` int(10) unsigned NOT NULL,
  `eq_id` int(10) unsigned NOT NULL,
  `tgl_maint` date NOT NULL,
  `biaya_maint` int(11) NOT NULL,
  `konfirm` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`maint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE IF NOT EXISTS `profit` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `p_in` int(11) unsigned NOT NULL,
  `p_out` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profit`
--

INSERT INTO `profit` (`p_id`, `date`, `p_in`, `p_out`, `description`) VALUES
(1, '2015-10-02', 10000, 0, 'nabung'),
(2, '2015-10-02', 0, 2000, 'jajan');

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE IF NOT EXISTS `studios` (
  `studio_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(128) NOT NULL,
  PRIMARY KEY (`studio_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`studio_id`, `name`, `price`, `description`, `img`) VALUES
(36, 'Studio A', 30000, 'Lan\'s Musik Studio adalah rental studio musik latihan band yang dilengkapi dengan equipment terkini dan di support oleh staff yang berpengalaman dan profesional. Studio kami berukuran 6x6 dan ruang operator berukuran 2x5.', 'images/studios/30_10_15-1446218836.jpg'),
(39, 'Studio B', 120000, 'Lan\'s Musik Studio adalah rental studio musik latihan band yang dilengkapi dengan equipment terkini dan di support oleh staff yang berpengalaman dan profesional. Studio kami berukuran 6x6 dan ruang operator berukuran 2x5.', 'images/studios/01_12_15-1448981028.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `user_id`, `book_code`, `book_date`, `studio_name`, `first_name`, `email`, `tlp`, `price`, `q`, `total`) VALUES
(84, 15, '0112150001', '2015-12-01', 'Studio B', 'Riska A', 'riska1@localhost.com', '085722442265', 120000, 3, 360000),
(85, 15, '0112150002', '2015-12-01', 'Studio B', 'Riska A', 'riska1@localhost.com', '085722442265', 120000, 1, 120000),
(86, 15, '0112150003', '2015-12-01', 'Studio A', 'Riska A', 'riska1@localhost.com', '085722442265', 30000, 1, 30000),
(87, 15, '1312150001', '2015-12-13', 'Studio B', 'Riska A', 'riska1@localhost.com', '085722442265', 120000, 1, 120000),
(88, 15, '1902160001', '2016-02-19', 'Studio B', 'Riska A', 'riska1@localhost.com', '085722442265', 120000, 2, 240000),
(89, 15, '2002160001', '2016-02-20', 'Studio A', 'Riska A', 'riska1@localhost.com', '085722442265', 30000, 1, 30000),
(90, 16, '2102160001', '2016-02-21', 'Studio A', 'Muaji', 'riska2@localhost.com', '123123123', 30000, 2, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `saldo`, `email`, `username`, `active`, `join_date`, `first_name`, `last_name`, `tlp`, `address`, `img`, `type`, `email_code`, `password`) VALUES
(1, 0, 'admin@lansmusikstudio.hol.es', 'admin', 1, '2015-10-05 23:00:00', 'Admin', '', '08572242265', 'Jl ke Bulan Indah', '', 1, NULL, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(2, 0, 'owner@lansmusikstudio.hol.es', 'Lan\'s Musik', 1, '2015-10-05 23:00:00', 'Lan\'s Musik', 'studio', NULL, NULL, '', 2, NULL, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(15, 20045, 'riska1@localhost.com', 'riskaam', 1, '2015-11-19 00:00:00', 'Riska A', '', '085722442265', '', 'images/profile/05_12_15-1449287884.jpg', 0, '1562c8a95d135b38c8820339b6def4bfc8ca565a', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(16, 940000, 'riska2@localhost.com', 'riska', 1, '2015-11-26 00:00:00', 'Muaji', '', '08123123123', 'Jl Benteng Kidul', 'images/profile/05_12_15-1449287849.jpg', 0, '92d26c72d3988b31444d91b2c206dd63a82f066d', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(21, 0, 'risky1@localhost.com', 'risky1', 1, '2016-02-20 09:22:30', 'Risky Satu', '', '08572244223', '', NULL, 0, 'e1acffcb307cd7bd210ed04fc2193da394694fe5', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(22, 50022, 'muaji.risky@gmail.com', NULL, 1, '2016-02-26 04:45:42', NULL, NULL, NULL, NULL, NULL, 0, '6ef7cfea1105108b882d98a168242fffe65b25d8', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
