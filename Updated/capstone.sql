-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2023 at 02:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadets`
--

CREATE TABLE `cadets` (
  `id_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL DEFAULT 'Company'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cadets`
--

INSERT INTO `cadets` (`id_number`, `first_name`, `last_name`, `email`, `class`, `rank`, `major`, `password`, `company`) VALUES
('0609724', 'Jacob', 'Johnston', 'johnstonjr24@vmi.edu', 2024, 'CPT', 'CIS', 'password', 'Staff'),
('0619046', 'Josh', 'Licona', 'liconajr24@vmi.edu', 2024, 'PVT', 'CIS', 'password', 'Company'),
('0655502', 'Rachel', 'Greathouse', 'greathousere25@vmi.edu', 2025, 'PVT', 'EC', 'password', 'Company'),
('10675729', 'Jacob', 'Hill', 'hillja24@vmi.edu', 2024, '1LT', 'CIS', 'password', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `commstaff`
--

CREATE TABLE `commstaff` (
  `id_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secretary`
--

CREATE TABLE `secretary` (
  `id_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadets`
--
ALTER TABLE `cadets`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `commstaff`
--
ALTER TABLE `commstaff`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
  ADD PRIMARY KEY (`id_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
