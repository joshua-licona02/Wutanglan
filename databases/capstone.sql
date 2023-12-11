-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2023 at 05:16 PM
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
-- Stand-in structure for view `431_full`
-- (See below for the actual view)
--
CREATE TABLE `431_full` (
`id_number` varchar(11)
,`last_name` varchar(255)
,`rank` varchar(255)
,`course_id` int(255)
,`section_marcher` int(255)
);

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

--
-- Dumping data for table `accountability`
--

INSERT INTO `accountability` (`accountability_id`, `date`, `time`, `course_id`, `cadet_id`, `status`) VALUES
(24, '12/11/2023', '11:04:17', 4, '0609724', 'Present'),
(25, '12/11/2023', '11:04:43', 4, '0609724', 'Present');

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
('0669027', 'Ella', 'Flickinger', 'flickingerem24@vmi.edu', 2024, 'CPT', 'ME', 'password', 'Staff'),
('10675729', 'Jacob', 'Hill', 'hillja24@vmi.edu', 2024, '1LT', 'CIS', 'password', 'Staff'),
('1234543', 'Mark', 'Shelton', 'sheltonml24@vmi.edu', 2024, '1CPT', 'CIS', 'password', 'Staff'),
('12346782', 'Sam', 'Patterson', 'pattersonsb24@vmi.edu', 2024, '2LT', 'CE', 'password', 'Company');

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
  `section_day` varchar(255) NOT NULL,
  `section_time` time NOT NULL,
  `section_end` time NOT NULL,
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

INSERT INTO `courses` (`course_id`, `course_title`, `course_code`, `section`, `section_day`, `section_time`, `section_end`, `date_start`, `date_end`, `professor_id`, `building`, `classroom`, `department`) VALUES
(1, 'Pre-Capstone', '480', 2, 'TR', '09:25:00', '10:40:00', '2023-08-29', '2023-12-14', 1, 'Mallory Hall', 318, 'CIS'),
(2, 'Pre-Capstone', '480', 1, 'TR', '08:00:00', '09:15:00', '2023-08-29', '2023-12-14', 1, 'Mallory Hall', 318, 'CIS'),
(3, 'Information Organization/Management', '431', 1, 'MWF', '13:00:00', '13:50:00', '2023-08-29', '2023-12-14', 2, 'Mallory Hall', 211, 'CIS'),
(4, 'Introduction to Computer Science', '101', 1, 'MWF', '10:00:00', '10:50:00', '2023-08-29', '2023-12-14', 3, 'Mallory Hall', 314, 'CIS'),
(5, 'Introduction to Computer Science', '101', 2, 'MWF', '10:00:00', '10:50:00', '2023-08-29', '2023-12-14', 4, 'Mallory Hall', 314, 'CIS');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollment`
--

CREATE TABLE `course_enrollment` (
  `enrollment_id` int(255) NOT NULL,
  `cadet_id` varchar(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `section_marcher` int(255) NOT NULL DEFAULT 0,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_enrollment`
--

INSERT INTO `course_enrollment` (`enrollment_id`, `cadet_id`, `course_id`, `section_marcher`, `semester`) VALUES
(1, '0609724', 1, 1, 'FL23'),
(2, '0609724', 3, 3, 'FL23'),
(3, '1234543', 3, 1, 'FL23'),
(4, '0655502', 3, 0, 'FL23'),
(5, '12346782', 4, 2, 'FL23'),
(6, '0609724', 4, 1, 'FL23'),
(7, '10675729', 3, 3, 'FL23'),
(8, '0619046', 3, 0, 'FL23'),
(9, '0669027', 3, 2, 'FL23');

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
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor_id`, `first_name`, `last_name`, `email`, `department`, `password`, `title`) VALUES
(1, 'Denis', 'Gracanin', 'gracanind@vmi.edu', 'CIS', 'password', 'Dr.'),
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

-- --------------------------------------------------------

--
-- Structure for view `431_full`
--
DROP TABLE IF EXISTS `431_full`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `431_full`  AS SELECT `cadets`.`id_number` AS `id_number`, `cadets`.`last_name` AS `last_name`, `cadets`.`rank` AS `rank`, `course_enrollment`.`course_id` AS `course_id`, `course_enrollment`.`section_marcher` AS `section_marcher` FROM ((`cadets` join `course_enrollment` on(`cadets`.`id_number` = `course_enrollment`.`cadet_id`)) join `rank` on(`rank`.`rank` = `cadets`.`rank`)) WHERE `course_enrollment`.`course_id` = 3 ORDER BY `rank`.`rank_id` ASC, `cadets`.`class` ASC, `cadets`.`last_name` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountability`
--
ALTER TABLE `accountability`
  ADD PRIMARY KEY (`accountability_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `cadet_id` (`cadet_id`) USING BTREE;

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
  ADD UNIQUE KEY `cadet_id` (`cadet_id`,`course_id`);

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
  MODIFY `accountability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  MODIFY `enrollment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
