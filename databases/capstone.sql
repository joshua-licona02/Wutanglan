-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2023 at 02:33 AM
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
-- Table structure for table `accountability`
--

CREATE TABLE `accountability` (
  `accountability_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `cadet_id` varchar(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cadets`
--

CREATE TABLE `cadets` (
  `id_number` varchar(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `rank` varchar(255) NOT NULL DEFAULT '',
  `major` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL DEFAULT 'Company'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cadets`
--

INSERT INTO `cadets` (`id_number`, `first_name`, `last_name`, `email`, `class`, `rank`, `major`, `password`, `company`) VALUES
('0345632', 'Dan', 'Lee', 'leedk24@vmi.edu', 2024, 'PVT', 'CE', 'password', 'Company'),
('0609724', 'Jacob', 'Johnston', 'johnstonjr24@vmi.edu', 2024, 'CPT', 'CIS', 'password', 'Staff'),
('0619046', 'Josh', 'Licona', 'liconajr24@vmi.edu', 2024, 'PVT', 'CIS', 'password', 'Company'),
('0655502', 'Rachel', 'Greathouse', 'greathousere25@vmi.edu', 2025, 'PVT', 'EC', 'password', 'Company'),
('10675729', 'Jacob', 'Hill', 'hillja24@vmi.edu', 2024, '1LT', 'CIS', 'password', 'Staff'),
('1234543', 'Mark', 'Shelton', 'sheltonml24@vmi.edu', 2024, '1CPT', 'CIS', 'password', 'Staff');

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

--
-- Dumping data for table `commstaff`
--

INSERT INTO `commstaff` (`id_number`, `first_name`, `last_name`, `email`, `password`) VALUES
('5401234', 'Kelley', 'Bennett', 'bennettkt@vmi.edu', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `section_time` time NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `professor_id` int(11) NOT NULL,
  `building` varchar(255) NOT NULL,
  `classroom` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `course_code`, `section`, `section_time`, `date_start`, `date_end`, `professor_id`, `building`, `classroom`, `department`) VALUES
(1, 'Pre-Capstone', '480', 2, '09:25:00', '2023-08-29', '2023-12-14', 1, 'Mallory Hall', 318, 'CIS'),
(2, 'Pre-Capstone', '480', 1, '08:00:00', '2023-08-29', '2023-12-14', 1, 'Mallory Hall', 318, 'CIS');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollment`
--

CREATE TABLE `course_enrollment` (
  `enrollment_id` int(255) NOT NULL,
  `cadet_id` varchar(255) NOT NULL,
  `cadet_lastname` varchar(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `section_marcher` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_enrollment`
--

INSERT INTO `course_enrollment` (`enrollment_id`, `cadet_id`, `cadet_lastname`, `course_id`, `section_marcher`) VALUES
(1, '0609724', '', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `professor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title/rank` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor_id`, `first_name`, `last_name`, `email`, `department`, `password`, `title/rank`) VALUES
(1, 'Dennis', 'Gracanin', 'gracanind@vmi.edu', 'CIS', 'password', 'Dr.'),
(2, 'Imran', 'Ghani', 'ghanii@vmi.edu', 'CIS', 'password', 'LTC'),
(3, 'Doug', 'Wainwright', 'wainwrightdb@vmi.edu', 'CIS', 'password', 'MAJ'),
(4, 'Ramoni', 'Lasisi', 'lasisiro@vmi.edu', 'CIS', 'password', 'LTC');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rank` varchar(255) NOT NULL,
  `rank_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank`, `rank_id`) VALUES
('1CPT', 1),
('1LT', 3),
('1SGT', 8),
('2LT', 4),
('BSM', 6),
('CCPL', 12),
('CPL', 13),
('CPT', 2),
('CSGT', 7),
('MSG', 10),
('OPS', 9),
('PVT', 14),
('RSM', 5),
('SGT', 11);

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
-- Dumping data for table `secretary`
--

INSERT INTO `secretary` (`id_number`, `first_name`, `last_name`, `email`, `dept`, `password`) VALUES
('5402222', 'Sandra', 'Williams', 'williamssr@vmi.edu', 'CIS', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountability`
--
ALTER TABLE `accountability`
  ADD PRIMARY KEY (`accountability_id`),
  ADD UNIQUE KEY `cadet_id` (`cadet_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `cadets`
--
ALTER TABLE `cadets`
  ADD PRIMARY KEY (`id_number`),
  ADD KEY `rank` (`rank`);

--
-- Indexes for table `commstaff`
--
ALTER TABLE `commstaff`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD UNIQUE KEY `cadet_id` (`cadet_id`,`course_id`),
  ADD KEY `cadet_lastname` (`cadet_lastname`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
  ADD PRIMARY KEY (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountability`
--
ALTER TABLE `accountability`
  MODIFY `accountability_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  MODIFY `enrollment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountability`
--
ALTER TABLE `accountability`
  ADD CONSTRAINT `accountability_ibfk_1` FOREIGN KEY (`cadet_id`) REFERENCES `cadets` (`id_number`),
  ADD CONSTRAINT `accountability_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `cadets`
--
ALTER TABLE `cadets`
  ADD CONSTRAINT `cadets_ibfk_1` FOREIGN KEY (`rank`) REFERENCES `rank` (`rank`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`professor_id`);

--
-- Constraints for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  ADD CONSTRAINT `course_enrollment_ibfk_1` FOREIGN KEY (`cadet_id`) REFERENCES `cadets` (`id_number`),
  ADD CONSTRAINT `course_enrollment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
