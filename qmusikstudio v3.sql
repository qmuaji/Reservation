-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Mar 2016 pada 02.29
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qmusikstudio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` bigint(20) unsigned NOT NULL,
  `studio_id` bigint(20) unsigned NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `i_time` tinyint(4) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bookings`
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
(134, 39, '3003161JYS', '2016-03-30', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `deposit_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `trans_date` date NOT NULL,
  `add_saldo` int(10) unsigned NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `user_confirm` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `admin_confirm` tinyint(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposit`
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
(43, 22, '2016-02-26', 50022, '123123123123', 1, 1),
(44, 16, '2016-02-13', 80016, '123123123', 1, 1),
(45, 21, '2016-03-17', 1000021, '', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `equips`
--

CREATE TABLE IF NOT EXISTS `equips` (
  `eq_id` int(10) unsigned NOT NULL,
  `studio_id` bigint(20) unsigned NOT NULL,
  `name` char(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_beli` date NOT NULL,
  `status` enum('Baik','Kurang Baik','Rusak') NOT NULL DEFAULT 'Baik'
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `equips`
--

INSERT INTO `equips` (`eq_id`, `studio_id`, `name`, `deskripsi`, `tgl_beli`, `status`) VALUES
(16, 36, 'Premier Drum set', 'Drum Kit, Bass Drum 22" x 16", Flour Tom 16" x 16", Tom-Tom 10" x 8" & 12" x 9", Snare Drum 14" x 5.5", 14" Hi-Hat Cymbal, 18" Crash Cymbal, 20" Ride Cymbal, Hardware, Drum Throne', '2016-02-27', 'Baik'),
(4, 36, 'Gitar Stratocaster', 'Fender Strato caster USA', '0000-00-00', 'Baik'),
(6, 39, 'Drum Tama', 'Tama Star Classic', '2016-02-26', 'Rusak'),
(11, 39, 'FENDER Stratocast', '6 String, Alder Body, Neck Maple, Fingerboard Rosewood, 21 Fret, 3 x Pick Up Single Coil, 6-Saddle Vintage-Style Synchronized Tremolo, 3 Knob Control', '2016-02-27', 'Kurang Baik'),
(8, 39, 'Guitar Amplifier Marshall JCM900+Cab', 'Guitar Amplifier, Output Power 100W, 4 Channel, 12&quot; Speaker, 1/4&quot; Guitar Jack Input, 1/4&quot; Footswitch Jack Input, 3.5mm Headphone Output, 9 Control Knob', '2012-02-02', 'Baik'),
(9, 36, 'LINE 6 Bass Guitar Amplifier', 'Bass Guitar Amplifier, Output Power 75 Watt, 10-inch Speaker, 4 Incredible Bass Amp Models', '2012-03-09', 'Baik'),
(10, 36, 'SQUIER Bass Elektrik', '4 String, Body Basswood, Neck Maple, Fingerboard Rosewood, 20 Fret, 2 Pick Up Duncan Designed JB101 Single-Coil Jazz Bass, Bridge Standadr 4-Saddle, 1 Bridge Volume, 1 Neck Volume, 1 Master Tone', '2016-02-27', 'Baik'),
(12, 36, 'Gitar Elektrik Les Paul Custom', '6 String, Body Mahogany, Neck Mahogany, Fingerboard Rosewood with Pearloid Block Inlays, Fret 22, Pick Up 2 ProBucker Humbucker, LockTone', '2016-02-27', 'Kurang Baik'),
(13, 39, 'MIC SHURE SM58', 'Dynamic Microphone', '2016-02-27', 'Rusak'),
(14, 36, 'SHURE SM57', 'Dynamic Microphone', '2016-02-27', 'Baik'),
(15, 36, 'SHURE SM57 2', 'Dynamic Microphone', '2016-02-27', 'Baik'),
(17, 0, 'Rolland RD300NX', 'Keyboard Rolland RD300NX', '2016-02-27', 'Baik'),
(18, 0, 'Drum Pearl', 'Pearl Vision Drumset', '2016-02-27', 'Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenances`
--

CREATE TABLE IF NOT EXISTS `maintenances` (
  `maint_id` int(10) unsigned NOT NULL,
  `eq_id` int(10) unsigned NOT NULL,
  `tgl_maint` date NOT NULL,
  `biaya_maint` int(11) NOT NULL,
  `konfirm` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `keterangan` text
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `maintenances`
--

INSERT INTO `maintenances` (`maint_id`, `eq_id`, `tgl_maint`, `biaya_maint`, `konfirm`, `status`, `keterangan`) VALUES
(12, 6, '0000-00-00', 80000, 0, 0, ''),
(2, 13, '2016-02-26', 200000, 1, 1, NULL),
(3, 12, '2016-02-26', 250000, 1, 2, NULL),
(11, 11, '0000-00-00', 400000, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profit`
--

CREATE TABLE IF NOT EXISTS `profit` (
  `p_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `p_in` int(11) unsigned NOT NULL,
  `p_out` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profit`
--

INSERT INTO `profit` (`p_id`, `date`, `p_in`, `p_out`, `description`) VALUES
(1, '2015-10-02', 10000, 0, 'nabung'),
(2, '2015-10-02', 0, 2000, 'jajan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `studios`
--

CREATE TABLE IF NOT EXISTS `studios` (
  `studio_id` bigint(20) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `studios`
--

INSERT INTO `studios` (`studio_id`, `name`, `price`, `description`, `img`) VALUES
(36, 'Studio A', 30000, 'Ukuran studio 4 x 3 Meter', 'images/studios/26_02_16-1456469267.jpg'),
(39, 'Studio B', 120000, 'Studio kami berukuran 6x6 dan ruang operator berukuran 2x5.', 'images/studios/01_12_15-1448981028.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `book_code` varchar(50) NOT NULL,
  `book_date` date NOT NULL,
  `studio_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `q` tinyint(3) unsigned NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transactions`
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
(100, 21, '3003161JYS', '2016-03-30', 'Studio B', 'Risky Satu', 'risky1@localhost.com', '08572244223', 120000, 2, 240000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `saldo` int(11) unsigned DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `saldo`, `email`, `username`, `active`, `join_date`, `first_name`, `last_name`, `tlp`, `address`, `img`, `type`, `email_code`, `password`) VALUES
(2, 0, 'owner@lansmusikstudio.hol.es', 'qmusik', 1, '2015-10-05 23:00:00', 'qmusik', 'studio', NULL, NULL, '', 2, NULL, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(15, 20045, 'riska1@localhost.com', 'riskaam', 1, '2015-11-19 00:00:00', 'Riska A', '', '085722442265', '', 'images/profile/05_12_15-1449287884.jpg', 0, '1562c8a95d135b38c8820339b6def4bfc8ca565a', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(16, 840016, 'riska2@localhost.com', 'riska', 1, '2015-11-26 00:00:00', 'Muaji', '', '08123123123', 'Jl Benteng Kidul', 'images/profile/05_12_15-1449287849.jpg', 0, '92d26c72d3988b31444d91b2c206dd63a82f066d', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(21, 760021, 'risky1@localhost.com', 'risky1', 1, '2016-02-20 09:22:30', 'Risky Satu', '', '08572244223', '', NULL, 0, 'e1acffcb307cd7bd210ed04fc2193da394694fe5', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(22, 1942200, 'muaji.risky@gmail.com', 'risky3', 1, '2016-02-26 04:45:42', 'Risky Muaji', '', '085722442265', '', 'images/profile/26_02_16-1456469826.jpg', 0, '6ef7cfea1105108b882d98a168242fffe65b25d8', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(25, 0, 'admin@lansmusikstudio.hol.es', 'admin', 1, '2016-03-25 04:57:56', NULL, NULL, NULL, NULL, NULL, 1, NULL, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

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
  MODIFY `booking_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `equips`
--
ALTER TABLE `equips`
  MODIFY `eq_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `maint_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
  MODIFY `studio_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
