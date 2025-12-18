-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2025 at 05:03 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `saw_alternatives`
--

CREATE TABLE `saw_alternatives` (
  `id_alternative` smallint UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_alternatives`
--

INSERT INTO `saw_alternatives` (`id_alternative`, `name`) VALUES
(1, 'Nusantara Stationery'),
(2, 'ATK Mandiri'),
(3, 'Sinar Pustaka'),
(4, 'Pena Cerdas'),
(5, 'Kertas Jaya'),
(6, 'Print & Point'),
(7, 'Total Office'),
(8, 'AlatTulisPro'),
(9, 'OfficeMart'),
(10, 'Prima Pena'),
(11, 'Dunia ATK'),
(12, 'Multi Office'),
(13, 'Metro Stationery'),
(14, 'Jaya Mandiri'),
(15, 'Maju Jaya ATK'),
(16, 'Pena Raya'),
(17, 'OfficeOne'),
(18, 'ATK Nusantara Supply'),
(19, 'Cepat Kirim ATK'),
(20, 'Murah Meriah ATK'),
(21, 'ATK Express'),
(22, 'Pena Indonesia'),
(23, 'Super Office'),
(24, 'Jaya Printer'),
(25, 'Serba Stationery'),
(26, 'OneStop Office'),
(27, 'Pena Best'),
(28, 'Vector Office'),
(29, 'Karya Pustaka'),
(30, 'Citra Pena'),
(31, 'FastOffice'),
(32, 'ATK Solusi'),
(33, 'Pena Murah'),
(34, 'Pusaka Mandiri'),
(35, 'Pelangi Stationery'),
(36, 'Sukses Office'),
(37, 'Pena Mart'),
(38, 'Central ATK'),
(39, 'Nusantara Office Store'),
(40, 'Mitra Pena'),
(41, 'ATK Berkah'),
(42, 'Pena Utama'),
(43, 'Stationery Line'),
(44, 'Master Office'),
(45, 'PenaGold');

-- --------------------------------------------------------

--
-- Table structure for table `saw_criterias`
--

CREATE TABLE `saw_criterias` (
  `id_criteria` tinyint UNSIGNED NOT NULL,
  `criteria` varchar(100) NOT NULL,
  `weight` float NOT NULL,
  `attribute` set('benefit','cost') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_criterias`
--

INSERT INTO `saw_criterias` (`id_criteria`, `criteria`, `weight`, `attribute`) VALUES
(1, 'Harga', 0.5028, 'cost'),
(2, 'Pengalaman', 0.2602, 'benefit'),
(3, 'Keakuratan Produk', 0.1344, 'benefit'),
(4, 'Kualitas Produk', 0.0678, 'benefit'),
(5, 'Pelayanan', 0.0348, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `saw_evaluations`
--

CREATE TABLE `saw_evaluations` (
  `id_alternative` smallint UNSIGNED NOT NULL,
  `id_criteria` tinyint UNSIGNED NOT NULL,
  `value` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_evaluations`
--

INSERT INTO `saw_evaluations` (`id_alternative`, `id_criteria`, `value`) VALUES
(1, 5, 0.55),
(1, 4, 1),
(1, 3, 1),
(1, 2, 1),
(1, 1, 0.55),
(2, 1, 0.25),
(2, 2, 0.25),
(2, 3, 0.55),
(2, 4, 0.55),
(2, 5, 0.55),
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 1),
(3, 5, 1),
(4, 1, 0.55),
(4, 2, 0.55),
(4, 3, 0.55),
(4, 4, 1),
(4, 5, 0.55),
(5, 1, 1),
(5, 2, 0.25),
(5, 3, 0.55),
(5, 4, 0.55),
(5, 5, 1),
(6, 2, 1),
(6, 1, 0.55),
(6, 3, 0.55),
(6, 4, 1),
(6, 5, 1),
(7, 1, 0.25),
(7, 2, 0.55),
(7, 3, 1),
(7, 4, 0.55),
(7, 5, 0.25),
(8, 1, 0.55),
(8, 2, 1),
(8, 3, 1),
(8, 4, 1),
(8, 5, 0.55),
(9, 5, 0.55),
(9, 4, 0.55),
(9, 3, 0.25),
(9, 2, 0.25),
(9, 1, 0.25),
(10, 1, 0.55),
(10, 2, 0.55),
(10, 3, 0.55),
(10, 4, 0.55),
(10, 5, 1),
(11, 1, 1),
(11, 2, 0.55),
(11, 3, 1),
(11, 4, 1),
(11, 5, 1),
(12, 1, 0.25),
(12, 2, 0.55),
(12, 3, 0.55),
(12, 4, 0.25),
(12, 5, 0.25),
(13, 1, 0.55),
(13, 2, 1),
(13, 3, 1),
(13, 4, 1),
(13, 5, 1),
(14, 1, 1),
(14, 2, 1),
(14, 3, 0.55),
(14, 4, 0.55),
(14, 5, 0.55),
(15, 1, 0.25),
(15, 2, 0.25),
(15, 3, 0.55),
(15, 4, 0.25),
(15, 5, 0.55),
(16, 1, 0.55),
(16, 2, 0.55),
(16, 3, 1),
(16, 4, 1),
(16, 5, 0.55),
(17, 1, 1),
(17, 2, 1),
(17, 3, 1),
(17, 4, 0.55),
(17, 5, 1),
(18, 1, 0.55),
(18, 2, 1),
(18, 3, 1),
(18, 4, 1),
(18, 5, 1),
(19, 1, 0.25),
(19, 2, 0.55),
(19, 3, 0.55),
(19, 4, 1),
(19, 5, 1),
(20, 1, 0.25),
(20, 2, 0.25),
(20, 3, 0.25),
(20, 4, 0.55),
(20, 5, 0.25),
(21, 1, 0.55),
(21, 2, 0.55),
(21, 3, 1),
(21, 4, 0.55),
(21, 5, 1),
(22, 1, 1),
(22, 2, 0.55),
(22, 3, 1),
(22, 4, 1),
(22, 5, 1),
(23, 1, 0.55),
(23, 2, 1),
(23, 3, 0.55),
(23, 4, 0.55),
(23, 5, 0.55),
(24, 1, 0.55),
(24, 2, 0.25),
(24, 3, 0.55),
(24, 4, 1),
(24, 5, 0.55),
(25, 1, 0.25),
(25, 2, 0.55),
(25, 3, 1),
(25, 4, 0.55),
(25, 5, 0.55),
(26, 1, 1),
(26, 2, 1),
(26, 3, 0.55),
(26, 4, 1),
(26, 5, 0.55),
(27, 1, 0.55),
(27, 2, 0.55),
(27, 3, 0.55),
(27, 4, 0.55),
(27, 5, 0.55),
(28, 1, 1),
(28, 2, 1),
(28, 3, 1),
(28, 4, 1),
(28, 5, 1),
(29, 1, 0.25),
(29, 2, 0.25),
(29, 3, 0.55),
(29, 4, 0.25),
(29, 5, 1),
(30, 1, 0.55),
(30, 2, 0.55),
(30, 3, 0.55),
(30, 4, 1),
(30, 5, 1),
(31, 1, 1),
(31, 2, 0.55),
(31, 3, 1),
(31, 4, 0.55),
(31, 5, 1),
(32, 1, 0.55),
(32, 2, 1),
(32, 3, 1),
(32, 4, 0.55),
(32, 5, 0.55),
(33, 1, 0.25),
(33, 2, 0.25),
(33, 3, 0.55),
(33, 4, 0.55),
(33, 5, 0.25),
(34, 1, 1),
(34, 2, 1),
(34, 3, 0.55),
(34, 4, 1),
(34, 5, 0.55),
(35, 1, 0.55),
(35, 2, 0.55),
(35, 3, 1),
(35, 4, 1),
(35, 5, 1),
(36, 1, 1),
(36, 2, 0.55),
(36, 3, 0.55),
(36, 4, 0.55),
(36, 5, 0.55),
(37, 1, 0.55),
(37, 2, 0.25),
(37, 3, 0.55),
(37, 4, 0.55),
(37, 5, 1),
(38, 1, 1),
(38, 2, 1),
(38, 3, 1),
(38, 4, 1),
(38, 5, 0.55),
(39, 1, 0.55),
(39, 2, 1),
(39, 3, 0.55),
(39, 4, 1),
(39, 5, 1),
(40, 1, 0.25),
(40, 2, 0.55),
(40, 3, 0.55),
(40, 4, 0.55),
(40, 5, 0.55),
(41, 1, 0.55),
(41, 2, 0.55),
(41, 3, 1),
(41, 4, 0.55),
(41, 5, 1),
(42, 1, 1),
(42, 2, 1),
(42, 3, 1),
(42, 4, 0.55),
(42, 5, 0.55),
(43, 1, 0.25),
(43, 2, 0.25),
(43, 3, 0.55),
(43, 4, 0.55),
(43, 5, 0.55),
(44, 1, 0.55),
(44, 2, 1),
(44, 3, 0.55),
(44, 4, 1),
(44, 5, 0.55),
(45, 1, 1),
(45, 2, 1),
(45, 3, 1),
(45, 4, 1),
(45, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `saw_users`
--

CREATE TABLE `saw_users` (
  `id_user` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_users`
--

INSERT INTO `saw_users` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  ADD PRIMARY KEY (`id_alternative`);

--
-- Indexes for table `saw_criterias`
--
ALTER TABLE `saw_criterias`
  ADD PRIMARY KEY (`id_criteria`);

--
-- Indexes for table `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  ADD PRIMARY KEY (`id_alternative`,`id_criteria`);

--
-- Indexes for table `saw_users`
--
ALTER TABLE `saw_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  MODIFY `id_alternative` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `saw_users`
--
ALTER TABLE `saw_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
