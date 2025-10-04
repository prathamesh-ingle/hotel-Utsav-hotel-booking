-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2025 at 03:04 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '0e7517141fb53f21ee439b355b5a1d0a', '2024-03-10 10:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('P','L','A','H') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_date` date NOT NULL,
  `status` varchar(10) NOT NULL COMMENT '1 = Present, 2 = Late, 3 = Absent, 4 = Holiday',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`id`, `name`, `created_at`, `updated_at`) VALUES
(15, 'CO-TY-5K', '2025-07-09 20:30:54', '2025-07-09 20:31:58'),
(16, 'CO-SY-3K', '2025-07-09 20:31:31', '2025-07-09 20:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `students_tbl`
--

CREATE TABLE `students_tbl` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `Section` varchar(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(20, 'Third Year', 6, 'CO', '2025-03-16 00:33:49', NULL),
(21, 'second year', 4, 'CO', '2025-03-16 00:34:11', NULL),
(22, 'TY', 6, 'CE', '2025-03-18 06:25:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `id` int(11) NOT NULL,
  `noticeTitle` varchar(255) DEFAULT NULL,
  `noticeDetails` mediumtext,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`id`, `noticeTitle`, `noticeDetails`, `postingDate`) VALUES
(6, 'Admission Open', 'admission open ', '2025-01-26 07:35:49'),
(8, 'Admission Closed', 'Dear student due to seat unavailability admission is closed please co oprate.', '2025-02-08 16:57:27'),
(16, 'session notice', 'all student informs that tomarrow is holiday, but we attend small program/session so attend that session', '2025-03-16 01:13:09'),
(20, 'holiday', 'today is holiday', '2025-03-21 06:57:41'),
(21, 'comp', 'today is competation', '2025-03-21 07:49:02'),
(22, 'hii', 'this is test message', '2025-04-05 05:18:13'),
(23, 'holiday ', 'today is holiday!!!!', '2025-04-27 09:22:19'),
(24, 'welcome to jspm', 'welcome !!!', '2025-06-28 13:12:40'),
(25, 'xxx', 'hello welcome to jspm', '2025-06-28 13:19:28'),
(26, 'lmn', 'hello everyone', '2025-06-28 13:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(27, 12, 10, 9, 98, '2025-02-08 16:56:10', NULL),
(28, 12, 10, 7, 77, '2025-02-08 16:56:10', NULL),
(29, 13, 12, 10, 90, '2025-02-10 17:00:05', NULL),
(30, 7, 13, 11, 90, '2025-02-14 07:29:15', NULL),
(31, 8, 14, 12, 100, '2025-02-14 07:38:11', NULL),
(32, 8, 14, 13, 100, '2025-02-14 07:38:11', NULL),
(33, 10, 14, 12, 67, '2025-02-24 10:58:46', NULL),
(34, 10, 14, 12, 90, '2025-02-24 10:58:46', NULL),
(35, 10, 14, 13, 78, '2025-02-24 10:58:46', NULL),
(36, 11, 15, 12, 98, '2025-03-10 15:35:04', NULL),
(37, 11, 15, 13, 95, '2025-03-10 15:35:04', NULL),
(38, 12, 16, 14, 98, '2025-03-10 15:42:17', NULL),
(39, 12, 16, 14, 98, '2025-03-10 15:42:17', NULL),
(40, 13, 17, 15, 99, '2025-03-10 15:49:01', NULL),
(41, 14, 18, 16, 96, '2025-03-10 16:41:29', NULL),
(42, 15, 19, 17, 98, '2025-03-10 16:49:51', NULL),
(43, 31, 20, 20, 98, '2025-03-16 01:05:26', NULL),
(44, 31, 20, 19, 98, '2025-03-16 01:05:26', NULL),
(45, 31, 20, 18, 99, '2025-03-16 01:05:26', NULL),
(46, 45, 20, 20, 98, '2025-03-16 01:05:53', NULL),
(47, 45, 20, 19, 98, '2025-03-16 01:05:53', NULL),
(48, 45, 20, 18, 98, '2025-03-16 01:05:53', NULL),
(49, 44, 20, 20, 98, '2025-03-16 01:06:20', NULL),
(50, 44, 20, 19, 98, '2025-03-16 01:06:20', NULL),
(51, 44, 20, 18, 99, '2025-03-16 01:06:20', NULL),
(52, 43, 20, 20, 98, '2025-03-16 01:06:46', NULL),
(53, 43, 20, 19, 98, '2025-03-16 01:06:46', NULL),
(54, 43, 20, 18, 99, '2025-03-16 01:06:46', NULL),
(55, 37, 20, 20, 98, '2025-03-16 01:07:04', NULL),
(56, 37, 20, 19, 98, '2025-03-16 01:07:04', NULL),
(57, 37, 20, 18, 99, '2025-03-16 01:07:04', NULL),
(58, 42, 20, 20, 88, '2025-03-16 01:07:32', NULL),
(59, 42, 20, 19, 75, '2025-03-16 01:07:32', NULL),
(60, 42, 20, 18, 85, '2025-03-16 01:07:32', NULL),
(61, 28, 20, 20, 80, '2025-03-16 01:08:36', NULL),
(62, 28, 20, 19, 75, '2025-03-16 01:08:36', NULL),
(63, 28, 20, 18, 82, '2025-03-16 01:08:36', NULL),
(64, 38, 20, 20, 75, '2025-03-16 01:08:55', NULL),
(65, 38, 20, 19, 68, '2025-03-16 01:08:55', NULL),
(66, 38, 20, 18, 80, '2025-03-16 01:08:55', NULL),
(67, 22, 20, 20, 98, '2025-03-16 01:09:30', NULL),
(68, 22, 20, 19, 98, '2025-03-16 01:09:30', NULL),
(69, 22, 20, 18, 98, '2025-03-16 01:09:30', NULL),
(70, 24, 20, 20, 89, '2025-03-16 01:09:57', NULL),
(71, 24, 20, 19, 78, '2025-03-16 01:09:57', NULL),
(72, 24, 20, 18, 68, '2025-03-16 01:09:57', NULL),
(73, 54, 20, 20, 98, '2025-04-05 05:19:19', NULL),
(74, 54, 20, 19, 98, '2025-04-05 05:19:19', NULL),
(75, 54, 20, 18, 95, '2025-04-05 05:19:19', NULL),
(76, 54, 20, 18, 80, '2025-04-05 05:19:19', NULL),
(77, 55, 20, 20, 99, '2025-06-28 13:12:08', NULL),
(78, 55, 20, 19, 99, '2025-06-28 13:12:08', NULL),
(79, 55, 20, 19, 88, '2025-06-28 13:12:08', NULL),
(80, 55, 20, 18, 98, '2025-06-28 13:12:08', NULL),
(81, 55, 20, 18, 87, '2025-06-28 13:12:08', NULL),
(82, 56, 20, 20, 99, '2025-06-28 13:18:56', NULL),
(83, 56, 20, 19, 98, '2025-06-28 13:18:56', NULL),
(84, 56, 20, 19, 88, '2025-06-28 13:18:56', NULL),
(85, 56, 20, 18, 98, '2025-06-28 13:18:56', NULL),
(86, 56, 20, 18, 87, '2025-06-28 13:18:56', NULL),
(87, 56, 20, 18, 85, '2025-06-28 13:18:56', NULL),
(88, 16, 20, 20, 38, '2025-06-28 13:40:22', NULL),
(89, 16, 20, 19, 98, '2025-06-28 13:40:22', NULL),
(90, 16, 20, 19, 89, '2025-06-28 13:40:22', NULL),
(91, 16, 20, 18, 98, '2025-06-28 13:40:22', NULL),
(92, 16, 20, 18, 98, '2025-06-28 13:40:22', NULL),
(93, 16, 20, 18, 98, '2025-06-28 13:40:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `fees_status` enum('Paid','Unpaid') DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`, `fees_status`) VALUES
(1, 'ram', '2016060105', 'ram@gmail.com', 'Male', '2025-02-13', 12, '2025-02-13 11:37:29', NULL, 1, 'Unpaid'),
(2, 'ram', '2016060105', 'ram@gmail.com', 'Male', '2025-02-13', 12, '2025-02-13 11:40:10', NULL, 1, 'Unpaid'),
(5, 'ram', '2016060105', 'ram@gmail.com', 'Male', '2025-02-13', 12, '2025-02-13 11:50:18', NULL, 1, 'Unpaid'),
(6, 'rajesh', '2016060456', 'aditya@gmail.com', 'Male', '2025-02-13', 12, '2025-02-13 12:03:27', NULL, 1, 'Paid'),
(7, 'Abdul ', '2217030165', 'aslkdnasdlc@snds.ocmd', 'Male', '2025-02-11', 13, '2025-02-14 07:28:33', NULL, 1, 'Unpaid'),
(8, 'aditya kamble', '2217030205', 'kambe.123@gmail.com', 'Male', '2006-10-05', 14, '2025-02-14 07:37:16', NULL, 1, 'Unpaid'),
(9, 'shivkumar', '2217030134', 'shiv@gmail.com', 'Male', '2006-02-02', 14, '2025-02-14 07:39:39', NULL, 1, 'Unpaid'),
(10, 'sujwal', '2217030129', 'suzzz@gmail.com', 'Male', '2005-01-24', 14, '2025-02-14 07:40:32', NULL, 1, 'Unpaid'),
(11, 'prathamesh', '2217030055', 'prathameshingle72@gmail.com', 'Male', '2006-03-28', 15, '2025-03-10 15:34:40', NULL, 1, 'Unpaid'),
(12, 'samarth', '2217030055', 'john@example.com', 'Male', '72007-02-22', 16, '2025-03-10 15:41:49', NULL, 1, 'Unpaid'),
(13, 'john', '2217030066', 'john@example.com', 'Male', '2005-03-28', 17, '2025-03-10 15:48:41', NULL, 1, 'Unpaid'),
(14, 'john', '2217030066', 'john@example.com', 'Male', '2006-03-28', 18, '2025-03-10 16:41:08', NULL, 1, 'Unpaid'),
(15, 'ram', '2217030066', 'john@example.com', 'Male', '2006-03-28', 19, '2025-03-10 16:49:16', NULL, 1, 'Unpaid'),
(16, 'ARYA TITIKSHA SATYAWAN', '2117030049', 'arya123@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:41:33', NULL, 1, 'Unpaid'),
(17, 'SHAIKH FIRDOUS FAJAL', '2117030053', 'firdous@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:42:28', NULL, 1, 'Unpaid'),
(18, 'GARAD VAIBHAVI SAHEBRAO', '2117030085', 'vaibhavi@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:43:31', NULL, 1, 'Unpaid'),
(19, 'IRALE HANMANT ASHRAT', '2117030097', 'ashrat@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:44:40', NULL, 1, 'Unpaid'),
(20, 'PURI RADHA VISHNU', '2117030103', 'radha@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:45:16', NULL, 1, 'Unpaid'),
(21, 'KOKATE ANJALI BALASAHEB', '2217030075', 'anjali@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:45:54', NULL, 1, 'Unpaid'),
(22, 'MALI VEDANT RAGHUNATH', '2217030076', 'vedu@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 00:46:37', NULL, 1, 'Unpaid'),
(23, 'SHAIKH HUMA ABDUL RAHEMAN', '2217030077', 'huma@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:47:17', NULL, 1, 'Unpaid'),
(24, 'UNTWALE SHAKIB SALIM', '2217030078', 'shakib@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 00:47:57', NULL, 1, 'Unpaid'),
(25, 'KULKARNI SWARANGEE NACHIKET', '2217030080', 'swara@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:48:32', NULL, 1, 'Unpaid'),
(26, 'RAGHU SRUSHTI HANMANT', '2217030082', 'srushti@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:49:13', NULL, 1, 'Unpaid'),
(27, 'CHOPADE RUTUJA RAJENDRA', '2217030083', 'rutuja@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:50:01', NULL, 1, 'Unpaid'),
(28, 'UNTWALE KAIF IKRAM', '2217030084', 'kaif@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 00:50:38', NULL, 1, 'Unpaid'),
(29, 'SALUNKE RISHA SARJERAO', '2217030085', 'risha@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:51:18', NULL, 1, 'Unpaid'),
(30, 'DAWALE SHRUTI RAJESH', '2217030086', 'shruti@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:51:59', NULL, 1, 'Unpaid'),
(31, 'INGLE PRATHAMESH OM', '2217030087', 'prathameshingle72@gmail.com', 'Male', '2006-03-28', 20, '2025-03-16 00:52:45', NULL, 1, 'Unpaid'),
(32, 'WADIKAR ASHWINI BALU', '2217030088', 'wadikar@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:53:28', NULL, 1, 'Unpaid'),
(33, 'MOHITE SANIKA DIGAMBAR', '2217030089', 'sanika@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:54:08', NULL, 1, 'Unpaid'),
(34, 'PIMPARWAR RAJNANDINI RAJU', '2217030090', 'rajnandini@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:54:53', NULL, 1, 'Unpaid'),
(35, 'AKUCH VEDIKA VYANKAT', '2217030091', 'vedika@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:55:31', NULL, 1, 'Unpaid'),
(36, 'MALGE PRANJALI SHANKAR', '2217030092', 'pranjali@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:56:12', NULL, 1, 'Unpaid'),
(37, 'POTDAR SUJWAL SANTOSH', '2217030093', 'sujwal@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 00:56:55', NULL, 1, 'Unpaid'),
(38, 'KAZI WASE NASEERUDDIN', '2217030094', 'wase@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 00:57:28', NULL, 1, 'Unpaid'),
(39, 'SARWADE NIKITA VIKAS', '2217030095', 'nikita@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:58:53', NULL, 1, 'Unpaid'),
(40, 'SAGAVE PRIYA KISAN', '2217030096', 'priya@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 00:59:26', NULL, 1, 'Unpaid'),
(41, 'HOLKAR PANKAJA KULDEEP', '2217030097', 'pankaja@gmail.com', 'Female', '2006-11-11', 20, '2025-03-16 01:00:05', NULL, 1, 'Unpaid'),
(42, 'SURYAWANSHI GANESH SHANKAR', '2217030104', 'ganesh@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 01:00:48', NULL, 1, 'Unpaid'),
(43, 'SWAMI SHIVKUMAR MALLINATH', '2217030118', 'swami@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 01:01:48', NULL, 1, 'Unpaid'),
(44, 'KAMBLE ADITYA SUBHASH', '2217030103', 'adi@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 01:02:38', NULL, 1, 'Unpaid'),
(45, 'AJAY RAM SURYAWANSHI', '23512230202', 'ajay@gmail.com', 'Male', '2006-11-11', 20, '2025-03-16 01:04:38', NULL, 1, 'Unpaid'),
(46, 'abc', '12', '', 'Male', '2005-01-01', 22, '2025-03-18 06:27:12', NULL, 1, 'Unpaid'),
(47, 'xyz', '13', '', 'Male', '0006-01-01', 22, '2025-03-18 06:27:30', NULL, 1, 'Unpaid'),
(48, 'pqr', '22', '', 'Male', '2007-01-01', 22, '2025-03-18 06:29:50', NULL, 0, 'Paid'),
(49, 'ssp', '15', '', 'Male', '2025-03-20', 20, '2025-03-20 06:10:02', NULL, 1, 'Unpaid'),
(50, 'qwerty', '20', '', 'Male', '2007-03-03', 22, '2025-03-20 06:24:55', NULL, 1, 'Paid'),
(51, 'qwe', '56', '', 'Male', '2009-09-09', 22, '2025-03-20 06:25:41', NULL, 1, 'Paid'),
(52, 'aaa', '57', '', 'Male', '2006-09-09', 22, '2025-03-20 06:26:05', NULL, 1, 'Unpaid'),
(53, 'fff', '1411', '', 'Male', '2004-02-22', 22, '2025-03-20 06:28:18', NULL, 1, 'Paid'),
(54, 'ABc', '11', '', 'Male', '2025-04-17', 20, '2025-04-05 05:16:56', NULL, 1, 'Paid'),
(55, 'xxx', '2217030000', 'abc@gmail.com', 'Male', '2005-02-22', 20, '2025-06-28 13:11:27', NULL, 1, 'Paid'),
(56, 'aaa', '2217030001', 'aa@123', 'Male', '2005-02-22', 20, '2025-06-28 13:18:18', NULL, 1, 'Paid'),
(57, 'lmn', '2217030002', 'lmn@gmail.com', 'Male', '2005-02-02', 20, '2025-06-28 13:38:58', NULL, 1, 'Paid'),
(58, 'abc', '22000000', 'kambleadi@gmail.com', 'Male', '', 20, '2025-07-05 08:27:56', NULL, 1, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(3, 2, 5, 0, '2024-05-01 10:30:57', '2024-06-07 05:25:49'),
(4, 1, 2, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(5, 1, 4, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(6, 1, 5, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(8, 4, 4, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(10, 4, 1, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(12, 4, 2, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(13, 4, 5, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(14, 6, 1, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(15, 6, 2, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(16, 6, 4, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(17, 6, 6, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(18, 7, 1, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(19, 7, 7, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(20, 7, 2, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(21, 7, 6, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(22, 7, 5, 0, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(23, 8, 1, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(24, 8, 2, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(25, 8, 4, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(26, 8, 6, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(27, 8, 5, 0, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(28, 9, 1, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(29, 9, 2, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(30, 9, 8, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(31, 9, 8, 1, '2024-05-01 10:30:57', '2024-06-07 04:28:00'),
(32, 10, 9, 1, '2025-02-08 16:53:53', NULL),
(33, 10, 8, 1, '2025-02-08 16:53:59', NULL),
(34, 10, 7, 1, '2025-02-08 16:54:06', NULL),
(35, 12, 10, 0, '2025-02-10 16:54:37', '2025-02-11 18:20:18'),
(36, 10, 9, 1, '2025-02-13 18:08:55', NULL),
(37, 13, 11, 1, '2025-02-14 07:27:14', NULL),
(38, 14, 12, 1, '2025-02-14 07:37:47', NULL),
(39, 14, 13, 1, '2025-02-14 07:37:53', NULL),
(40, 14, 12, 1, '2025-02-24 10:56:46', NULL),
(41, 15, 12, 1, '2025-03-10 15:33:27', NULL),
(42, 15, 13, 1, '2025-03-10 15:33:34', NULL),
(43, 16, 14, 1, '2025-03-10 15:40:42', NULL),
(44, 16, 14, 1, '2025-03-10 15:40:58', NULL),
(45, 17, 15, 1, '2025-03-10 15:48:05', NULL),
(46, 18, 16, 1, '2025-03-10 16:40:36', NULL),
(47, 19, 17, 1, '2025-03-10 16:48:41', NULL),
(48, 20, 18, 1, '2025-03-16 00:37:52', NULL),
(49, 20, 19, 1, '2025-03-16 00:37:58', NULL),
(50, 20, 20, 1, '2025-03-16 00:38:04', NULL),
(51, 20, 18, 1, '2025-03-18 10:33:05', NULL),
(52, 22, 19, 1, '2025-04-05 05:17:42', NULL),
(53, 20, 19, 1, '2025-06-28 13:10:45', NULL),
(54, 20, 18, 1, '2025-06-28 13:17:34', NULL),
(55, 21, 18, 1, '2025-06-28 13:38:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(18, 'WBP', '22619', '2025-03-16 00:36:40', NULL),
(19, 'PWP', '22616', '2025-03-16 00:37:11', NULL),
(20, 'MAD', '22617', '2025-03-16 00:37:40', NULL),
(21, 'PWP', '22616', '2025-06-28 13:10:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `user_id` int(12) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `Password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`user_id`, `fname`, `lname`, `UserName`, `email`, `Password`) VALUES
(6, 'Sujwal ', 'ingle', 'ABC', 'saylih777@gmail.com', 'AAAA'),
(7, 'prathamesh', 'ingle', 'AAA', 'prathameshingle72@gmail.com', '1703'),
(9, 'abc', 'Potdar', 'ksb', 'pro@gmail.com', '2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`attendance_date`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_fk` (`student_id`);

--
-- Indexes for table `class_tbl`
--
ALTER TABLE `class_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id_fk` (`class_id`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students_tbl`
--
ALTER TABLE `students_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD CONSTRAINT `student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `students_tbl` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD CONSTRAINT `class_id_fk` FOREIGN KEY (`class_id`) REFERENCES `class_tbl` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
