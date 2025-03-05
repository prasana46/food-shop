-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 03:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodd`
--

CREATE TABLE `foodd` (
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `name` varchar(25) NOT NULL,
  `number` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `order_id` int(100) NOT NULL,
  `pizzaQuantity` varchar(20) DEFAULT NULL,
  `burgerQuantity` varchar(20) DEFAULT NULL,
  `saladQuantity` varchar(20) DEFAULT NULL,
  `popcornQuantity` varchar(20) DEFAULT NULL,
  `chocopieQuantity` varchar(20) DEFAULT NULL,
  `wingsQuantity` varchar(20) DEFAULT NULL,
  `pepsiQuantity` varchar(20) DEFAULT NULL,
  `meatballsQuantity` varchar(20) DEFAULT NULL,
  `totalCost` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodd`
--

INSERT INTO `foodd` (`date`, `name`, `number`, `address`, `order_id`, `pizzaQuantity`, `burgerQuantity`, `saladQuantity`, `popcornQuantity`, `chocopieQuantity`, `wingsQuantity`, `pepsiQuantity`, `meatballsQuantity`, `totalCost`) VALUES
('2023-11-23 13:49:54.421464', 'karan', '8883856572', 'tpk,madurai', 25, '2', '0', '1', '0', '0', '1', '0', '0', '880'),
('2023-11-23 13:50:11.050353', 'karan kishore', '8072338201', 'tpk,madurai', 26, '3', '0', '0', '0', '0', '0', '0', '0', '900'),
('2023-11-23 13:50:33.402477', 'karan kishore', '8072338201', 'tpk,madurai', 27, '3', '4', '0', '0', '0', '0', '0', '0', '1540'),
('2023-11-23 14:05:44.227533', 'karan kishore', '8072338201', 'tpk,madurai', 28, '3', '4', '2', '0', '0', '0', '1', '0', '1750'),
('2023-11-23 14:10:46.419497', 'kishore', '9789167937', 'thirunagar', 29, '0', '1', '1', '0', '1', '1', '0', '0', '540'),
('2023-11-23 14:21:56.777271', 'karan', '9789167937', 'thirunagar', 30, '2', '1', '1', '0', '1', '1', '0', '0', '1140'),
('2023-11-23 14:29:04.876499', '', '', '', 31, '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('2023-11-23 14:29:49.323277', '', '', '', 32, '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('2023-11-23 14:30:21.251450', '', '', '', 33, '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phno` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fname`, `lname`, `email`, `phno`, `username`, `password`) VALUES
(25, 'karan', 'kishore', 'karankishore88838@gmail.c', '8883856572', 'karan', 'karan!@#');

-- --------------------------------------------------------

--
-- Table structure for table `registrationadmin`
--

CREATE TABLE `registrationadmin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrationadmin`
--

INSERT INTO `registrationadmin` (`username`, `password`) VALUES
('admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foodd`
--
ALTER TABLE `foodd`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foodd`
--
ALTER TABLE `foodd`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
