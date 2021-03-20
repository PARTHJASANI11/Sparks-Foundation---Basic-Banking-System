-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 01:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sparks_task_1_banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `customer_id` varchar(5) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_mobile` bigint(10) NOT NULL,
  `current_balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`customer_id`, `customer_name`, `customer_email`, `customer_mobile`, `current_balance`) VALUES
('CS001', 'Joan Martine', 'joanmartine@gmail.com', 9987654321, 101001),
('CS002', 'Patty I', 'pattyi@gmail.com', 9978654321, 50070),
('CS003', 'Joseph J', 'josephj@yahoo.com', 9898756410, 1999000),
('CS004', 'Peter Martine', 'petermartine@hotmail.com', 7896541230, 10040),
('CS005', 'Paul Parker', 'paulparker@gmail.com', 9645782310, 4890.78),
('CS006', 'Susan P', 'susanp@gmail.com', 9087459632, 5000000),
('CS007', 'S Linda', 'slinda@yahoo.com', 9076543210, 10000),
('CS008', 'Barbara Martine', 'barbaramartine@hotmail.com', 9612345789, 1000000),
('CS009', 'Helen Fernandez ', 'helenfernandez@gmail.com', 9924415231, 5000.5),
('CS010', 'Dora Dsouza ', 'doradsouza@yahoo.com', 9445612378, 10000.9);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_info`
--

CREATE TABLE `transfer_info` (
  `transfer_id` int(11) NOT NULL,
  `transfer_from_id` varchar(5) NOT NULL,
  `transfer_to_id` varchar(5) NOT NULL,
  `transfer_amount` float NOT NULL,
  `transfer_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_info`
--

INSERT INTO `transfer_info` (`transfer_id`, `transfer_from_id`, `transfer_to_id`, `transfer_amount`, `transfer_time`) VALUES
(1, 'CS005', 'CS004', 20, '2021-03-16 08:59:43'),
(2, 'CS005', 'CS004', 20, '2021-03-16 09:01:58'),
(3, 'CS005', 'CS004', 20, '2021-03-16 09:08:01'),
(4, 'CS003', 'CS001', 1000, '2021-03-16 09:08:40'),
(5, 'CS004', 'CS002', 20, '2021-03-17 18:30:17'),
(6, 'CS005', 'CS002', 50, '2021-03-17 18:32:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `transfer_info`
--
ALTER TABLE `transfer_info`
  ADD PRIMARY KEY (`transfer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfer_info`
--
ALTER TABLE `transfer_info`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
