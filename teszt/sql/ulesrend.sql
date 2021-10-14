-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2021 at 01:11 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ulesrend`
--

-- --------------------------------------------------------

--
-- Table structure for table `5/13ice`
--

CREATE TABLE `5/13ice` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sor` int(11) NOT NULL,
  `oszlop` int(11) NOT NULL,
  `jelszo` varchar(32) CHARACTER SET latin1 NOT NULL,
  `felhasznalonev` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `5/13ice`
--

INSERT INTO `5/13ice` (`id`, `nev`, `sor`, `oszlop`, `jelszo`, `felhasznalonev`) VALUES
(1, ' Kulhanek László', 1, 1, 'bbbd219ae25760543411f99a1235b66d', 'csiga'),
(2, ' Bakcsányi Dominik ', 1, 2, '7815696ecbf1c96e6894b779456d330e', 'bd'),
(3, ' Füstös Lóránt ', 1, 3, '', ''),
(4, ' Orosz Zsolt ', 1, 4, '', ''),
(5, ' Harsányi László ', 1, 5, '', ''),
(6, '', 1, 6, '', ''),
(7, ' Molnár Gergő ', 2, 1, '', ''),
(8, ' Juhász Levente ', 2, 2, '', ''),
(9, ' Szabó László ', 2, 3, '', ''),
(10, ' Sütő Dániel ', 2, 4, '', ''),
(11, ' Détári Klaudia ', 2, 5, '', ''),
(12, '', 2, 6, '', ''),
(13, ' Keresztúri Kevin ', 3, 1, '', ''),
(14, '', 3, 2, '', ''),
(15, '', 3, 3, '', ''),
(16, '', 3, 4, '', ''),
(17, '', 3, 5, '', ''),
(18, '', 3, 6, '', ''),
(19, ' Fazekas Miklós ', 4, 1, '', ''),
(20, '', 4, 2, '', ''),
(21, ' Gombos János ', 4, 3, '', ''),
(22, ' Bicsák József ', 4, 4, 'e10adc3949ba59abbe56e057f20f883e', 'bicsi'),
(23, '', 4, 5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `5/13ice_hianyzok`
--

CREATE TABLE `5/13ice_hianyzok` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`) VALUES
(1),
(22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `5/13ice`
--
ALTER TABLE `5/13ice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `5/13ice_hianyzok`
--
ALTER TABLE `5/13ice_hianyzok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD KEY `ibfk_admin_id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `5/13ice_hianyzok`
--
ALTER TABLE `5/13ice_hianyzok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `5/13ice_hianyzok`
--
ALTER TABLE `5/13ice_hianyzok`
  ADD CONSTRAINT `ibfk_tanulo_id` FOREIGN KEY (`id`) REFERENCES `5/13ice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `ibfk_admin_id` FOREIGN KEY (`id`) REFERENCES `5/13ice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
