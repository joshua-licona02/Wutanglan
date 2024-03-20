-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2024 at 10:25 PM
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
  `status` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `submitted_by` varchar(255) NOT NULL,
  `submitted_by_role` varchar(255) NOT NULL DEFAULT 'Cadet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountability`
--

INSERT INTO `accountability` (`accountability_id`, `date`, `time`, `course_id`, `cadet_id`, `status`, `comments`, `submitted_by`, `submitted_by_role`) VALUES
(1, '02/02/2024', '06:28:23', 4, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(2, '02/02/2024', '06:28:23', 4, '12346782', 'Present', 'N/A', '0609724', 'Cadet'),
(3, '02/02/2024', '09:13:19', 3, '1234543', 'Present', 'N/A', '0609724', 'Cadet'),
(4, '02/02/2024', '09:13:19', 3, '0669027', 'Present', 'N/A', '0609724', 'Cadet'),
(5, '02/02/2024', '09:13:19', 3, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(6, '02/02/2024', '09:13:19', 3, '10675729', 'Present', 'N/A', '0609724', 'Cadet'),
(7, '02/02/2024', '09:13:19', 3, '0619046', 'Present', 'N/A', '0609724', 'Cadet'),
(8, '02/02/2024', '09:13:19', 3, '0655502', 'Present', 'N/A', '0609724', 'Cadet'),
(16, '02/02/2024', '22:44:30', 6, '1', 'Late', 'dumb', '0609724', 'Cadet'),
(17, '02/02/2024', '22:44:30', 6, '0669027', 'Present', 'N/A', '0609724', 'Cadet'),
(18, '02/02/2024', '22:44:30', 6, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(19, '02/02/2024', '22:44:30', 6, '10675729', 'Present', 'N/A', '0609724', 'Cadet'),
(20, '02/02/2024', '22:44:30', 6, '0345632', 'Absent', 'Sick, covid', '0609724', 'Cadet'),
(21, '02/02/2024', '22:44:30', 6, '0619046', 'Present', 'N/A', '0609724', 'Cadet'),
(22, '02/02/2024', '22:44:30', 6, '0655502', 'Late Late', 'with jake.', '0609724', 'Cadet'),
(34, '02/05/2024', '09:01:54', 9, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(35, '02/05/2024', '09:01:54', 9, '5555432', 'Present', 'N/A', '0609724', 'Cadet'),
(36, '02/05/2024', '09:01:54', 9, '8888372', 'Absent', 'N/A', '0609724', 'Cadet'),
(37, '02/05/2024', '09:01:54', 9, '10675728', 'Present', 'N/A', '0609724', 'Cadet'),
(38, '02/05/2024', '09:01:54', 9, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(39, '02/05/2024', '09:01:54', 9, '10675727', 'Present', 'N/A', '0609724', 'Cadet'),
(40, '02/05/2024', '09:01:54', 9, '0655505', 'Absent', 'Capstone', '0609724', 'Cadet'),
(41, '02/05/2024', '09:01:54', 9, '1234547', 'Present', 'N/A', '0609724', 'Cadet'),
(42, '02/05/2024', '09:01:54', 9, '4311234', 'Absent', 'All-Duty: Sick', '0609724', 'Cadet'),
(43, '02/05/2024', '09:01:54', 9, '4321237', 'Present', 'N/A', '0609724', 'Cadet'),
(44, '02/05/2024', '09:01:54', 9, '1234546', 'Absent', 'Capstone', '0609724', 'Cadet'),
(49, '02/06/2024', '10:38:09', 1, '1234543', 'Absent', 'N/A', '0609724', 'Cadet'),
(50, '02/06/2024', '10:38:09', 1, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(51, '02/06/2024', '10:38:09', 1, '10675729', 'Present', 'N/A', '0609724', 'Cadet'),
(52, '02/06/2024', '10:38:09', 1, '24356312', 'Late Late', '7 mins', '0609724', 'Cadet'),
(53, '02/06/2024', '10:38:09', 1, '0619046', 'Present', 'N/A', '0609724', 'Cadet'),
(54, '02/06/2024', '10:38:09', 1, '7635123', 'Present', 'N/A', '0609724', 'Cadet'),
(55, '02/07/2024', '09:02:18', 9, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(56, '02/07/2024', '09:02:18', 9, '5555432', 'Absent', 'All-Duty', '0609724', 'Cadet'),
(57, '02/07/2024', '09:02:18', 9, '8888372', 'Present', 'N/A', '0609724', 'Cadet'),
(58, '02/07/2024', '09:02:18', 9, '10675728', 'Present', 'N/A', '0609724', 'Cadet'),
(59, '02/07/2024', '09:02:18', 9, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(60, '02/07/2024', '09:02:18', 9, '10675727', 'Present', 'N/A', '0609724', 'Cadet'),
(61, '02/07/2024', '09:02:18', 9, '0655505', 'Present', 'N/A', '0609724', 'Cadet'),
(62, '02/07/2024', '09:02:18', 9, '1234547', 'Present', 'N/A', '0609724', 'Cadet'),
(63, '02/07/2024', '09:02:18', 9, '4311234', 'Present', 'N/A', '0609724', 'Cadet'),
(64, '02/07/2024', '09:02:18', 9, '4321237', 'Present', 'N/A', '0609724', 'Cadet'),
(65, '02/07/2024', '09:02:18', 9, '1234546', 'Present', 'N/A', '0609724', 'Cadet'),
(66, '02/09/2024', '09:00:20', 9, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(67, '02/09/2024', '09:00:20', 9, '5555432', 'Present', 'N/A', '0609724', 'Cadet'),
(68, '02/09/2024', '09:00:20', 9, '8888372', 'Present', 'N/A', '0609724', 'Cadet'),
(69, '02/09/2024', '09:00:20', 9, '10675728', 'Present', 'N/A', '0609724', 'Cadet'),
(70, '02/09/2024', '09:00:20', 9, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(71, '02/09/2024', '09:00:20', 9, '10675727', 'Present', 'N/A', '0609724', 'Cadet'),
(72, '02/09/2024', '09:00:20', 9, '0655505', 'Present', 'N/A', '0609724', 'Cadet'),
(73, '02/09/2024', '09:00:20', 9, '1234547', 'Present', 'N/A', '0609724', 'Cadet'),
(74, '02/09/2024', '09:00:20', 9, '4311234', 'Present', 'N/A', '0609724', 'Cadet'),
(75, '02/09/2024', '09:00:20', 9, '4321237', 'Present', 'N/A', '0609724', 'Cadet'),
(76, '02/09/2024', '09:00:20', 9, '1234546', 'Present', 'N/A', '0609724', 'Cadet'),
(77, '02/12/2024', '09:00:49', 9, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(78, '02/12/2024', '09:00:49', 9, '5555432', 'Present', 'N/A', '0609724', 'Cadet'),
(79, '02/12/2024', '09:00:49', 9, '8888372', 'Present', 'N/A', '0609724', 'Cadet'),
(80, '02/12/2024', '09:00:49', 9, '10675728', 'Present', 'N/A', '0609724', 'Cadet'),
(81, '02/12/2024', '09:00:49', 9, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(82, '02/12/2024', '09:00:49', 9, '10675727', 'Present', 'N/A', '0609724', 'Cadet'),
(83, '02/12/2024', '09:00:49', 9, '0655505', 'Present', 'N/A', '0609724', 'Cadet'),
(84, '02/12/2024', '09:00:49', 9, '1234547', 'Present', 'N/A', '0609724', 'Cadet'),
(85, '02/12/2024', '09:00:49', 9, '4311234', 'Present', 'N/A', '0609724', 'Cadet'),
(86, '02/12/2024', '09:00:49', 9, '4321237', 'Present', 'N/A', '0609724', 'Cadet'),
(87, '02/12/2024', '09:00:49', 9, '1234546', 'Present', 'N/A', '0609724', 'Cadet'),
(94, '02/19/2024', '20:35:31', 10, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(95, '02/19/2024', '20:35:31', 10, '10675729', 'Late', 'N/A', '0609724', 'Cadet'),
(96, '02/19/2024', '20:35:31', 10, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(97, '02/19/2024', '20:35:31', 10, '7635123', 'Absent', 'N/A', '0609724', 'Cadet'),
(98, '02/19/2024', '20:35:31', 10, '0655502', 'Present', 'N/A', '0609724', 'Cadet'),
(99, '02/19/2024', '20:35:31', 10, '3437261', 'Present', 'N/A', '0609724', 'Cadet'),
(100, '02/29/2024', '13:56:36', 10, '0609724', 'Absent', 'N/A', '0609724', 'Cadet'),
(101, '02/29/2024', '13:56:36', 10, '10675729', 'Absent', 'N/A', '0609724', 'Cadet'),
(102, '02/29/2024', '13:56:36', 10, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(103, '02/29/2024', '13:56:36', 10, '7635123', 'Present', 'N/A', '0609724', 'Cadet'),
(104, '02/29/2024', '13:56:36', 10, '0655502', 'Present', 'N/A', '0609724', 'Cadet'),
(105, '02/29/2024', '13:56:36', 10, '3437261', 'Present', 'N/A', '0609724', 'Cadet'),
(106, '02/29/2024', '10:01:49', 1, '1234543', 'Absent', '3.2 Cut', '1234543', 'Cadet'),
(107, '02/29/2024', '10:01:49', 1, '0609724', 'Absent', 'N/A', '1234543', 'Cadet'),
(108, '02/29/2024', '10:01:49', 1, '10675729', 'Present', 'N/A', '1234543', 'Cadet'),
(109, '02/29/2024', '10:01:49', 1, '24356312', 'Present', 'N/A', '1234543', 'Cadet'),
(110, '02/29/2024', '10:01:49', 1, '0619046', 'Present', 'N/A', '1234543', 'Cadet'),
(111, '02/29/2024', '10:01:49', 1, '7635123', 'Present', 'N/A', '1234543', 'Cadet'),
(119, '03/01/2024', '11:18:17', 1, '1234543', 'Present', 'N/A', '1', 'Professor'),
(120, '03/01/2024', '11:18:17', 1, '0609724', 'Present', 'N/A', '1', 'Professor'),
(121, '03/01/2024', '11:18:17', 1, '10675729', 'Present', 'N/A', '1', 'Professor'),
(122, '03/01/2024', '11:18:17', 1, '24356312', 'Present', 'N/A', '1', 'Professor'),
(123, '03/01/2024', '11:18:17', 1, '0619046', 'Present', 'N/A', '1', 'Professor'),
(124, '03/01/2024', '11:18:17', 1, '7635123', 'Present', 'N/A', '1', 'Professor'),
(125, '03/04/2024', '13:03:24', 10, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(126, '03/04/2024', '13:03:24', 10, '10675729', 'Absent', '3.2 Cut', '0609724', 'Cadet'),
(127, '03/04/2024', '13:03:24', 10, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(128, '03/04/2024', '13:03:24', 10, '7635123', 'Absent', 'All-Duty', '0609724', 'Cadet'),
(129, '03/04/2024', '13:03:24', 10, '0655502', 'Absent', 'Guard', '0609724', 'Cadet'),
(130, '03/04/2024', '13:03:24', 10, '3437261', 'Present', 'N/A', '0609724', 'Cadet'),
(131, '03/05/2024', '09:47:40', 1, '1234543', 'Absent', '3.2 Cut', '1', 'Professor'),
(132, '03/05/2024', '09:47:40', 1, '0609724', 'Present', 'N/A', '1', 'Professor'),
(133, '03/05/2024', '09:47:40', 1, '10675729', 'Present', 'N/A', '1', 'Professor'),
(134, '03/05/2024', '09:47:40', 1, '24356312', 'Present', 'N/A', '1', 'Professor'),
(135, '03/05/2024', '09:47:40', 1, '0619046', 'Present', 'N/A', '1', 'Professor'),
(136, '03/05/2024', '09:47:40', 1, '7635123', 'Present', 'N/A', '1', 'Professor'),
(137, '03/06/2024', '16:41:29', 1, '1234543', 'Absent', '3.2 Cut', '1', 'Professor'),
(138, '03/06/2024', '16:41:29', 1, '0609724', 'Present', 'N/A', '1', 'Professor'),
(139, '03/06/2024', '16:41:29', 1, '10675729', 'Present', 'N/A', '1', 'Professor'),
(140, '03/06/2024', '16:41:29', 1, '24356312', 'Present', 'N/A', '1', 'Professor'),
(141, '03/06/2024', '16:41:29', 1, '0619046', 'Present', 'N/A', '1', 'Professor'),
(142, '03/06/2024', '16:41:29', 1, '7635123', 'Present', 'N/A', '1', 'Professor'),
(143, '03/07/2024', '10:10:46', 1, '1234543', 'Absent', 'N/A', '1', 'Professor'),
(144, '03/07/2024', '10:10:46', 1, '0609724', 'Present', 'N/A', '1', 'Professor'),
(145, '03/07/2024', '10:10:46', 1, '10675729', 'Present', 'N/A', '1', 'Professor'),
(146, '03/07/2024', '10:10:46', 1, '24356312', 'Present', 'N/A', '1', 'Professor'),
(147, '03/07/2024', '10:10:46', 1, '0619046', 'Present', 'N/A', '1', 'Professor'),
(148, '03/07/2024', '10:10:46', 1, '7635123', 'Present', 'N/A', '1', 'Professor'),
(149, '03/12/2024', '10:27:23', 1, '1234543', 'Absent', 'N/A', '1', 'Professor'),
(150, '03/12/2024', '10:27:23', 1, '0609724', 'Present', 'N/A', '1', 'Professor'),
(151, '03/12/2024', '10:27:23', 1, '10675729', 'Present', 'N/A', '1', 'Professor'),
(152, '03/12/2024', '10:27:23', 1, '24356312', 'Present', 'N/A', '1', 'Professor'),
(153, '03/12/2024', '10:27:23', 1, '0619046', 'Present', 'N/A', '1', 'Professor'),
(154, '03/12/2024', '10:27:23', 1, '7635123', 'Present', 'N/A', '1', 'Professor'),
(155, '03/12/2024', '21:30:14', 10, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(156, '03/12/2024', '21:30:14', 10, '10675729', 'Absent', '3.2 Cut', '0609724', 'Cadet'),
(157, '03/12/2024', '21:30:14', 10, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(158, '03/12/2024', '21:30:14', 10, '0655502', 'Present', 'N/A', '0609724', 'Cadet'),
(164, '03/20/2024', '12:33:29', 12, '1234543', 'Absent', '3.2 Cut', '9', 'Professor'),
(165, '03/20/2024', '12:33:29', 12, '0609724', 'Absent', '3.2 Cut', '9', 'Professor'),
(166, '03/20/2024', '12:33:29', 12, '10675729', 'Absent', '3.2 Cut', '9', 'Professor'),
(167, '03/20/2024', '12:33:29', 12, '0619046', 'Present', 'N/A', '9', 'Professor'),
(168, '03/20/2024', '12:33:29', 12, '7635123', 'Present', 'N/A', '9', 'Professor'),
(169, '03/20/2024', '12:33:29', 12, '4311234', 'Present', 'N/A', '9', 'Professor'),
(170, '03/20/2024', '12:24:07', 10, '1234543', 'Present', 'N/A', '0609724', 'Cadet'),
(171, '03/20/2024', '12:24:07', 10, '0609724', 'Present', 'N/A', '0609724', 'Cadet'),
(172, '03/20/2024', '12:24:07', 10, '10675729', 'Present', 'N/A', '0609724', 'Cadet'),
(173, '03/20/2024', '12:24:07', 10, '0345632', 'Present', 'N/A', '0609724', 'Cadet'),
(174, '03/20/2024', '12:24:07', 10, '0655502', 'Present', 'N/A', '0609724', 'Cadet');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin-password');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`) VALUES
(1, 'Mallory Hall'),
(2, 'Scott Ship Hall'),
(3, 'Kilbourne Hall'),
(4, 'Nichols Engineering Building'),
(5, 'Maury Brooke Hall'),
(6, 'Cormack Field House'),
(7, 'Cocke Hall');

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
('0627956', 'Ian', 'Struzzeri', 'struzzeriic24@vmi.edu', 2024, '2LT', 'HI', 'password', 'Company'),
('0655502', 'Rachel', 'Greathouse', 'greathousere25@vmi.edu', 2025, 'PVT', 'EC', 'password', 'Company'),
('0655505', 'Malcolm', 'McIntosh', 'mcintoshmx24@vmi.edu', 2024, 'PVT', 'AM', 'password', 'Company'),
('0669027', 'Ella', 'Flickinger', 'flickingerem24@vmi.edu', 2024, 'CPT', 'ME', 'password', 'Staff'),
('1', 'Cadet', 'Cadet', 'cadet@vmi.edu', 2024, 'CPT', 'ERH', 'password', 'Staff'),
('10675727', 'Jacob', 'Leonard', 'leonardja24@vmi.edu', 2024, 'PVT', 'CE', 'password', 'Company'),
('10675728', 'Caleb', 'Dufrene', 'dufrenecs24@vmi.edu', 2024, 'PVT', 'IS', 'password', 'Company'),
('10675729', 'Jacob', 'Hill', 'hillja24@vmi.edu', 2024, '1LT', 'CIS', 'password', 'Staff'),
('123432432', 'Test', 'Cadet', 'test@vmi.edu', 2024, 'PVT', 'CIS', '$2y$10$Ys/S93NgEB63/cl0.hMoguCWMh8S6TA6rYWcGd7cYezyE4V3ZxBBa', 'Company'),
('1234543', 'Mark', 'Shelton', 'sheltonml24@vmi.edu', 2024, '1CPT', 'CIS', 'password', 'Staff'),
('1234546', 'Matthew', 'Zieg', 'ziegmj24@vmi.edu', 2024, 'PVT', 'HI', 'password', 'Company'),
('1234547', 'Sudarshana', 'Rajagopal', 'rajagopalsk24@vmi.edu', 2024, 'PVT', 'EE', 'password', 'Company'),
('12346782', 'Sam', 'Patterson', 'pattersonsb24@vmi.edu', 2024, '2LT', 'CE', 'password', 'Company'),
('24356312', 'Joseph', 'Hipp', 'hippjt24@vmi.edu', 2024, 'PVT', 'CIS', 'password', 'Company'),
('3437261', 'Brennan', 'Watkins', 'watkinsbr25@vmi.edu', 2025, 'PVT', 'EC', 'password', 'Company'),
('4311234', 'Braedyn', 'Rose', 'roseba24@vmi.edu', 2024, 'PVT', 'CIS', 'password', 'Company'),
('4321234', 'Jerrel', 'Andrews', 'andrewsjw27@vmi.edu', 2027, 'PVT', 'EC', 'password', 'Company'),
('4321237', 'Abigail', 'Soyars', 'soyarsag24@vmi.edu', 2024, 'PVT', 'PY', 'password', 'Company'),
('5555432', 'Josh', 'Kent', 'kentje24@vmi.edu', 2024, '1LT', 'CE', 'password', 'Staff'),
('7635123', 'Dylan', 'Palmer', 'palmerde24@vmi.edu', 2024, 'PVT', 'CIS', 'password', 'Company'),
('8888372', 'Julian', 'Major', 'majorja24@vmi.edu', 2024, '2LT', 'HI', 'password', 'Company');

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
('5401234', 'Kelley', 'Bennett', 'bennettkt@vmi.edu', 'password'),
('5409998', 'COMM', 'COMM', 'commstaff@vmi.edu', 'password');

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
(1, 'Capstone', '490', 2, 'TR', '09:25:00', '10:40:00', '2024-01-17', '2024-05-03', 1, 'Mallory Hall', 318, 'CIS'),
(2, 'Capstone', '490', 1, 'TR', '08:00:00', '09:15:00', '2024-01-17', '2024-05-03', 1, 'Mallory Hall', 318, 'CIS'),
(3, 'Information Organization/Management', '431', 1, 'MWF', '13:00:00', '13:50:00', '2024-01-17', '2024-05-03', 2, 'Mallory Hall', 211, 'CIS'),
(4, 'Introduction to Computer Science', '101', 1, 'MWF', '10:00:00', '10:50:00', '2024-01-17', '2024-05-03', 3, 'Mallory Hall', 314, 'CIS'),
(5, 'Introduction to Computer Science', '101', 2, 'MWF', '10:00:00', '10:50:00', '2024-01-17', '2024-05-03', 4, 'Mallory Hall', 314, 'CIS'),
(6, 'Comparative Religion', '211-WX', 3, 'MWF', '11:00:00', '11:50:00', '2024-01-17', '2024-05-03', 6, 'Scott Ship Hall', 406, 'ERH'),
(8, 'Intro to CS', '101', 1, 'MWF', '09:00:00', '09:50:00', '2024-01-17', '2024-05-03', 4, 'Mallory Hall', 316, 'CIS'),
(9, 'National Security Prep II', '404', 1, 'MWF', '09:00:00', '09:50:00', '2024-01-17', '2024-05-03', 7, 'Kilbourne Hall', 4004, 'AS'),
(10, 'Test Course', '679', 1, 'MTWRF', '11:50:00', '12:50:00', '2024-01-16', '2024-05-03', 2, 'Mallory Hall', 310, 'CIS'),
(11, 'Basketball', '414', 1, 'R', '14:15:00', '15:05:00', '2024-01-16', '2024-05-03', 8, 'Cocke Hall', 400, 'HPW'),
(12, 'Linux Fundamentals', '377', 2, 'MWF', '11:00:00', '11:50:00', '2024-01-16', '2024-05-03', 9, 'Mallory Hall', 310, 'CIS');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollment`
--

CREATE TABLE `course_enrollment` (
  `enrollment_id` int(255) NOT NULL,
  `cadet_id` varchar(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `section_marcher` int(255) NOT NULL DEFAULT 0,
  `semester` varchar(255) NOT NULL DEFAULT 'SP24'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_enrollment`
--

INSERT INTO `course_enrollment` (`enrollment_id`, `cadet_id`, `course_id`, `section_marcher`, `semester`) VALUES
(29, '0609724', 9, 1, 'SP24'),
(31, '10675728', 9, 0, 'SP24'),
(32, '5555432', 9, 2, 'SP24'),
(33, '0655505', 9, 0, 'SP24'),
(34, '1234546', 9, 0, 'SP24'),
(35, '4311234', 9, 0, 'SP24'),
(36, '10675727', 9, 0, 'SP24'),
(37, '8888372', 9, 3, 'SP24'),
(38, '1234547', 9, 0, 'SP24'),
(39, '4321237', 9, 0, 'SP24'),
(40, '10675729', 1, 3, 'SP24'),
(41, '0619046', 1, 0, 'SP24'),
(43, '0609724', 1, 2, 'SP24'),
(44, '1234543', 1, 1, 'SP24'),
(46, '24356312', 1, 0, 'SP24'),
(47, '0609724', 10, 2, 'SP24'),
(49, '10675729', 10, 3, 'SP24'),
(59, '0655502', 10, 0, 'SP24'),
(60, '0345632', 10, 0, 'SP24'),
(61, '4321234', 9, 0, 'SP24'),
(63, '1234543', 10, 1, 'SP24'),
(64, '10675729', 12, 3, 'SP24'),
(65, '1234543', 12, 1, 'SP24'),
(66, '0619046', 12, 3, 'SP24'),
(67, '4311234', 12, 0, 'SP24'),
(68, '7635123', 12, 0, 'SP24'),
(69, '0609724', 12, 2, 'SP24');

-- --------------------------------------------------------

--
-- Table structure for table `course_schedule`
--

CREATE TABLE `course_schedule` (
  `id` int(255) NOT NULL,
  `isClassNormal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_schedule`
--

INSERT INTO `course_schedule` (`id`, `isClassNormal`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `full_acct`
-- (See below for the actual view)
--
CREATE TABLE `full_acct` (
`accountability_id` int(11)
,`id_number` varchar(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`course_title` varchar(255)
,`course_code` varchar(255)
,`section` int(11)
,`section_time` time
,`date` varchar(255)
,`time` varchar(255)
,`status` varchar(255)
);

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
(4, 'Ramoni', 'Lasisi', 'lasisiro@vmi.edu', 'CIS', 'password', 'LTC'),
(6, 'George', 'Walter', 'waltergd@vmi.edu', 'ERH', 'password', 'Mr.'),
(7, 'Nichole', 'Scott', 'scottnk@vmi.edu', 'AS', 'password', 'Col'),
(8, 'Jim', 'Whitten', 'whittenjh@vmi.edu', 'HPW', 'password', 'CPT'),
(9, 'Amish', 'Parikh', 'parikhav@vmi.edu', 'CIS', 'password', 'Mr.');

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
('5402222', 'Sandra', 'Williams', 'williamssr@vmi.edu', 'CIS', 'password'),
('5405401', 'Secretary', 'Secretary', 'erhsecretary@vmi.edu', 'ERH', 'password');

-- --------------------------------------------------------

--
-- Structure for view `431_full`
--
DROP TABLE IF EXISTS `431_full`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `431_full`  AS SELECT `cadets`.`id_number` AS `id_number`, `cadets`.`last_name` AS `last_name`, `cadets`.`rank` AS `rank`, `course_enrollment`.`course_id` AS `course_id`, `course_enrollment`.`section_marcher` AS `section_marcher` FROM ((`cadets` join `course_enrollment` on(`cadets`.`id_number` = `course_enrollment`.`cadet_id`)) join `rank` on(`rank`.`rank` = `cadets`.`rank`)) WHERE `course_enrollment`.`course_id` = 3 ORDER BY `rank`.`rank_id` ASC, `cadets`.`class` ASC, `cadets`.`last_name` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `full_acct`
--
DROP TABLE IF EXISTS `full_acct`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `full_acct`  AS SELECT `accountability`.`accountability_id` AS `accountability_id`, `cadets`.`id_number` AS `id_number`, `cadets`.`first_name` AS `first_name`, `cadets`.`last_name` AS `last_name`, `courses`.`course_title` AS `course_title`, `courses`.`course_code` AS `course_code`, `courses`.`section` AS `section`, `courses`.`section_time` AS `section_time`, `accountability`.`date` AS `date`, `accountability`.`time` AS `time`, `accountability`.`status` AS `status` FROM ((`accountability` join `cadets` on(`cadets`.`id_number` = `accountability`.`cadet_id`)) join `courses` on(`courses`.`course_id` = `accountability`.`course_id`)) ;

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

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
-- Indexes for table `course_schedule`
--
ALTER TABLE `course_schedule`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `accountability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  MODIFY `enrollment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `course_schedule`
--
ALTER TABLE `course_schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountability`
--
ALTER TABLE `accountability`
  ADD CONSTRAINT `accountability_ibfk_1` FOREIGN KEY (`cadet_id`) REFERENCES `cadets` (`id_number`),
  ADD CONSTRAINT `accountability_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `accountability_ibfk_3` FOREIGN KEY (`submitted_by`) REFERENCES `cadets` (`id_number`);

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
