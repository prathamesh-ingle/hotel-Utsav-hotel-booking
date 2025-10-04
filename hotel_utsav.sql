-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2025 at 03:02 PM
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
-- Database: `hotel_utsav`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'prathamesh om ingle', 'admin', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `booking_type` enum('room','party','function') NOT NULL,
  `booking_date` date NOT NULL,
  `message` text,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `assigned_number` varchar(50) DEFAULT NULL,
  `contact_required` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkout_status` enum('not_checked_out','checked_out') DEFAULT 'not_checked_out',
  `checkout_date` date DEFAULT NULL,
  `is_seen` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `booking_type`, `booking_date`, `message`, `status`, `assigned_number`, `contact_required`, `created_at`, `checkout_status`, `checkout_date`, `is_seen`) VALUES
(5, 1, 'room', '2025-07-03', 'Booking Type: Executive King Bed Room\nName: prathamesh om ingle\nPhone: 09146005002\nAlt Phone: \nEmail: \nGender: Male\nAddress: savidhan chauk,latur\nGuests: 2\nTime: 6\nPayment: GPay\n\nMessage: ', 'rejected', NULL, 1, '2025-07-03 18:34:41', 'not_checked_out', NULL, 1),
(6, 1, 'room', '2025-07-03', 'Booking Type: Executive King Bed Room\nName: sai\nPhone: 09146005002\nAlt Phone: \nEmail: \nGender: Male\nAddress: savidhan chauk,latur\nGuests: 1\nTime: 6\nPayment: GPay\n\nMessage: ', 'approved', '1', 1, '2025-07-03 18:37:34', 'checked_out', NULL, 1),
(7, 1, 'room', '2025-07-03', 'Booking Type: Executive King Bed Room\nName: ganesh\nPhone: 09146005002\nAlt Phone: \nEmail: \nGender: Male\nAddress: savidhan chauk,latur\nGuests: 1\nTime: 11 to 12\nPayment: GPay\n\nMessage: ', '', '2', 1, '2025-07-03 20:10:11', 'not_checked_out', NULL, 0),
(8, 1, 'room', '2025-07-08', 'Booking Type: Executive King Bed Room\nName: prathamesh om ingle\nPhone: 09146005002\nAlt Phone: \nEmail: \nGender: Male\nAddress: savidhan chauk,latur\nGuests: 8\nTime: 11 to 12\nPayment: GPay\n\nMessage: xyz', 'approved', '2', 1, '2025-07-04 08:06:38', 'not_checked_out', NULL, 1),
(9, 1, 'room', '2025-07-06', 'Booking Type: Executive Twin Bed Room\r\nName: abc\r\nPhone: 9999999999\r\nAlt Phone: 9999999999\r\nEmail: abc@gmail.com\r\nGender: Male\r\nAddress: xyz\r\nGuests: 2\r\nTime: 11am-7pm\r\nPayment: GPay\r\n\r\nMessage: lmn', '', '3', 1, '2025-07-05 14:04:20', 'not_checked_out', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'prathamesh', 'prathameshingle72@gmail.com', 'abc*123#', '2025-07-02 17:49:09'),
(2, 'sai om ingle', 'saiprasadingle72@gmail.com', 'abc', '2025-07-02 18:08:34'),
(9, 'ajay', 'abc@gmail.com', 'Admin@123', '2025-07-04 10:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `customer_dismissed_notifications`
--

CREATE TABLE `customer_dismissed_notifications` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `dismissed_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `image`, `created_at`) VALUES
(1, 'festival', 'divali bumper offer', '', '2025-07-04 14:03:46'),
(2, 'offer', 'offer', '', '2025-07-04 14:04:06'),
(3, 'welcome', 'hello', '', '2025-07-04 14:06:22'),
(4, 'holi offer', 'offer offer offer!!!', '', '2025-07-05 19:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `type` enum('room','party','function') NOT NULL,
  `status` enum('available','occupied','maintenance') DEFAULT 'available',
  `price` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(100) DEFAULT 'Standard'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `type`, `status`, `price`, `created_at`, `category`) VALUES
(14, '1', 'room', 'available', '1200.00', '2025-07-03 19:44:55', 'Executive King Bed Room'),
(15, '2', 'room', 'occupied', '1200.00', '2025-07-04 07:40:01', 'Executive Twin Bed Room'),
(16, '3', 'room', 'available', '3500.00', '2025-07-05 14:05:45', 'Executive Twin Bed Room');

-- --------------------------------------------------------

--
-- Table structure for table `support_queries`
--

CREATE TABLE `support_queries` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_dismissed_notifications`
--
ALTER TABLE `customer_dismissed_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `support_queries`
--
ALTER TABLE `support_queries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_dismissed_notifications`
--
ALTER TABLE `customer_dismissed_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `support_queries`
--
ALTER TABLE `support_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
