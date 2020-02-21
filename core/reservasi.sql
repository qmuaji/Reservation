-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2020 at 09:00 AM
-- Server version: 5.7.26-log
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qmuajico_reservasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `studio_id` bigint(20) UNSIGNED NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `i_time` tinyint(4) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(123, 36, '2102160001', '2016-02-21', 11),
(124, 36, '2602160001', '2016-02-26', 10),
(125, 36, '2602160002', '2016-02-26', 11),
(126, 36, '2602160003', '2016-02-26', 14),
(127, 36, '2602160004', '2016-02-26', 21),
(128, 36, '2602160005', '2016-02-26', 20),
(129, 36, '2602160006', '2016-02-26', 17),
(130, 36, '2602160P3I', '2016-02-26', 13),
(131, 36, '260216S11N', '2016-02-26', 15),
(132, 36, '2602161RIY', '2016-02-26', 12),
(133, 39, '3003161JYS', '2016-03-30', 13),
(134, 39, '3003161JYS', '2016-03-30', 14),
(135, 36, '180220RIKA', '2020-02-18', 10),
(136, 36, '1802201E1U', '2020-02-18', 11),
(137, 36, '180220ITE9', '2020-02-21', 16),
(138, 36, '200220A8RJ', '2020-02-20', 13),
(139, 36, '200220A8RJ', '2020-02-20', 14),
(140, 36, '200220J0SS', '2020-02-20', 17),
(141, 39, '200220E1AI', '2020-02-20', 12);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trans_date` date NOT NULL,
  `add_saldo` int(10) UNSIGNED NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `user_confirm` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `admin_confirm` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `trans_date`, `add_saldo`, `no_rek`, `user_confirm`, `admin_confirm`) VALUES
(0, 15, '2015-12-01', 300015, '321123321', 1, 1),
(34, 15, '2015-12-04', 50015, '', 1, 1),
(35, 15, '0000-00-00', 50015, '', 0, 0),
(36, 15, '0000-00-00', 50015, '', 0, 0),
(37, 15, '2015-12-13', 50015, '', 1, 1),
(38, 15, '2015-12-02', 1000015, '224422655221', 1, 1),
(39, 16, '0000-00-00', 50016, '4444444', 0, 1),
(40, 19, '0000-00-00', 50019, '', 0, 0),
(41, 19, '2016-02-20', 100019, '123123123123', 1, 0),
(42, 19, '2016-02-20', 50019, '12312312', 1, 1),
(43, 22, '2016-02-26', 50022, '123123123123', 1, 1),
(44, 16, '2016-02-13', 80016, '123123123', 1, 1),
(45, 21, '2016-03-17', 1000021, '', 1, 1),
(46, 27, '2020-02-18', 50027, '123 123 123123', 1, 1),
(47, 27, '2020-02-18', 50027, '55113323123', 1, 1),
(48, 27, '2020-02-19', 50027, '3322134442244', 1, 0),
(49, 27, '0000-00-00', 50027, '', 0, 0),
(50, 27, '2020-02-19', 100027, '2291010000001', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equips`
--

CREATE TABLE `equips` (
  `eq_id` int(10) UNSIGNED NOT NULL,
  `studio_id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_beli` date NOT NULL,
  `status` enum('Baik','Kurang Baik','Rusak') NOT NULL DEFAULT 'Baik'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equips`
--

INSERT INTO `equips` (`eq_id`, `studio_id`, `name`, `deskripsi`, `tgl_beli`, `status`) VALUES
(16, 36, 'Free Wifi', 'Drum Kit, Bass Drum 22&quot; x 16&quot;, Flour Tom 16&quot; x 16&quot;, Tom-Tom 10&quot; x 8&quot; &amp; 12&quot; x 9&quot;, Snare Drum 14&quot; x 5.5&quot;, 14&quot; Hi-Hat Cymbal, 18&quot; Crash Cymbal, 20&quot; Ride Cymbal, Hardware, Drum Throne', '2016-02-27', 'Baik'),
(4, 36, 'TV LCD', 'Fender Strato caster USA', '0000-00-00', 'Baik'),
(6, 39, 'Cafetaria', 'Tama Star Classic', '2016-02-26', 'Kurang Baik'),
(11, 39, 'Whiteboard &amp; Spidol', '6 String, Alder Body, Neck Maple, Fingerboard Rosewood, 21 Fret, 3 x Pick Up Single Coil, 6-Saddle Vintage-Style Synchronized Tremolo, 3 Knob Control', '2016-02-27', 'Kurang Baik'),
(9, 36, 'Projector', 'Bass Guitar Amplifier, Output Power 75 Watt, 10-inch Speaker, 4 Incredible Bass Amp Models', '2012-03-09', 'Baik'),
(13, 39, 'Projector HD', 'Dynamic Microphone', '2016-02-27', 'Rusak'),
(17, 0, 'Rolland RD300NX', 'Keyboard Rolland RD300NX', '2016-02-27', 'Baik'),
(18, 0, 'Drum Pearl', 'Pearl Vision Drumset', '2016-02-27', 'Baik');

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `maint_id` int(10) UNSIGNED NOT NULL,
  `eq_id` int(10) UNSIGNED NOT NULL,
  `tgl_maint` date NOT NULL,
  `biaya_maint` int(11) NOT NULL,
  `konfirm` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `keterangan` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`maint_id`, `eq_id`, `tgl_maint`, `biaya_maint`, `konfirm`, `status`, `keterangan`) VALUES
(12, 6, '0000-00-00', 80000, 0, 0, ''),
(2, 13, '2016-02-26', 200000, 1, 1, NULL),
(3, 12, '2016-02-26', 250000, 1, 2, NULL),
(11, 11, '0000-00-00', 400000, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `p_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `p_in` int(11) UNSIGNED NOT NULL,
  `p_out` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `studios` (
  `studio_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`studio_id`, `name`, `price`, `description`, `img`) VALUES
(36, 'VIP Room iala', 30000, 'Ruang meeting  VIP ini memiliki kapasitas maksimum 8 orang. Ruang meeting yang terletak di Han Gang Restaurant Senayan City  ini memiliki desain yang pas untuk anda mengadangkan meeting. Harga sewa ruang meeting VIP Room iala', 'images/studios/19_02_20-1582048014.jpeg'),
(39, 'Mawar Beauty', 120000, 'Ruang Mawar merupakan ruang meeting yang berlokasi di daerah Slipi, Jakarta Barat. Ruang meeting ini memiliki kapasitas hingga 4 orang dengan susunan board. Ruangan ini merupakan ruang meeting dengan design yang menarik', 'images/studios/19_02_20-1582048460.jpg'),
(40, 'Blue Sky', 400000, 'Ruang meeting Orion cocok untuk keperluan meeting anda dengan kapasitas hingga 12 orang, ruangan seluas 6x6 meter ini memiliki desain yang artsy, modern dan menarik dengan atapnya yang terbuka', 'images/studios/19_02_20-1582048589.jpeg'),
(41, 'Wisma 99', 100000, 'Ruang meeting Apex 2, Wisma 76 ini di desain dengan sangat nyaman dan unik karena tidak seperti ruang meeting pada umumnya, anda akan merasa seperti sedang berada di rumah', 'images/studios/19_02_20-1582048714.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `studio_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `q` tinyint(3) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(90, 16, '2102160001', '2016-02-21', 'Studio A', 'Muaji', 'riska2@localhost.com', '123123123', 30000, 2, 60000),
(91, 22, '2602160001', '2016-02-26', 'Studio A', 'Risky Muaji', 'muaji.risky@gmail.com', '085722442265', 30000, 1, 30000),
(92, 22, '2602160002', '2016-02-26', 'Studio A', 'Risky Muaji', 'muaji.risky@gmail.com', '085722442265', 30000, 1, 30000),
(93, 22, '2602160003', '2016-02-26', 'Studio A', 'Risky Muaji', 'muaji.risky@gmail.com', '085722442265', 30000, 1, 30000),
(94, 16, '2602160004', '2016-02-26', 'Studio A', 'Muaji', 'riska2@localhost.com', '08123123123', 30000, 1, 30000),
(95, 16, '2602160005', '2016-02-26', 'Studio A', 'Muaji', 'riska2@localhost.com', '08123123123', 30000, 1, 30000),
(96, 16, '2602160006', '2016-02-26', 'Studio A', 'Muaji', 'riska2@localhost.com', '08123123123', 30000, 1, 30000),
(97, 16, '2602160P3I', '2016-02-26', 'Studio A', 'Muaji', 'riska2@localhost.com', '08123123123', 30000, 1, 30000),
(98, 16, '260216S11N', '2016-02-26', 'Studio A', 'Muaji', 'riska2@localhost.com', '08123123123', 30000, 1, 30000),
(99, 16, '2602161RIY', '2016-02-26', 'Studio A', 'Muaji', 'riska2@localhost.com', '08123123123', 30000, 1, 30000),
(100, 21, '3003161JYS', '2016-03-30', 'Studio B', 'Risky Satu', 'risky1@localhost.com', '08572244223', 120000, 2, 240000),
(101, 27, '180220RIKA', '2020-02-18', 'Studio A', 'Ali', 'muaji.risky@qmuaji.com', '0813223414414', 30000, 1, 30000),
(102, 27, '1802201E1U', '2020-02-18', 'Studio A', 'Ali', 'muaji.risky@qmuaji.com', '0813223414414', 30000, 1, 30000),
(103, 27, '180220ITE9', '2020-02-21', 'Studio A', 'Ali', 'muaji.risky@qmuaji.com', '0813223414414', 30000, 1, 30000),
(104, 27, '200220A8RJ', '2020-02-20', 'VIP Room iala', 'Alinda', 'muaji.risky@qmuaji.com', '0813223414414', 30000, 2, 60000),
(105, 27, '200220J0SS', '2020-02-20', 'VIP Room iala', 'Egi suherman', 'muaji.risky@qmuaji.com', '0813223414414', 30000, 1, 30000),
(106, 22, '200220E1AI', '2020-02-20', 'Mawar Beauty', 'Joe Satriani', 'muaji.risky@gmail.com', '085722442265', 120000, 1, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `saldo` int(11) UNSIGNED DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `tlp` varchar(16) DEFAULT NULL,
  `address` text,
  `img` tinytext,
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `email_code` varchar(64) DEFAULT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `saldo`, `email`, `username`, `active`, `join_date`, `first_name`, `last_name`, `tlp`, `address`, `img`, `type`, `email_code`, `password`) VALUES
(2, 0, 'muaji@qmuaji.com', 'owner', 1, '2015-10-05 23:00:00', 'Owner', '', NULL, NULL, '', 2, NULL, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(15, 1020060, 'riska1@localhost.com', 'rushaugust', 1, '2015-11-19 00:00:00', 'Rush', 'August', '085722442265', '', 'images/profile/20_02_20-1582163891.jpg', 0, '1562c8a95d135b38c8820339b6def4bfc8ca565a', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(16, 840016, 'riska2@localhost.com', 'rudolf', 1, '2015-11-26 00:00:00', 'Steve', '', '08123123123', 'Jl Benteng Kidul', 'images/profile/20_02_20-1582163967.jpg', 0, '92d26c72d3988b31444d91b2c206dd63a82f066d', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(27, 20081, 'muaji.risky@qmuaji.com', 'alib', 1, '2020-02-18 03:05:03', 'Alinda', 'Bageur', '0813223414414', 'Jl indah dengan instri tersayang', 'images/profile/19_02_20-1582098908.jpeg', 0, '7b5a234222e5fd53ede02052814c869795a71099', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(22, 1822200, 'muaji.risky@gmail.com', 'ramlinganjoe', 1, '2016-02-26 04:45:42', 'Joe', 'Rmalingan', '085722442265', '', 'images/profile/20_02_20-1582163189.jpg', 0, '6ef7cfea1105108b882d98a168242fffe65b25d8', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(32, 0, 'muaji.risky@outlook.com', 'admin', 1, '2020-02-20 01:30:26', NULL, 'Admin', NULL, NULL, 'images/profile/20_02_20-1582162295.png', 1, '67ed78aefc922224807037b5fc9ccd5675d80966', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `equips`
--
ALTER TABLE `equips`
  ADD PRIMARY KEY (`eq_id`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`maint_id`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`studio_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD UNIQUE KEY `book_code` (`book_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `equips`
--
ALTER TABLE `equips`
  MODIFY `eq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `maint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
  MODIFY `studio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
