-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 09:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complain`
--

CREATE TABLE `tbl_complain` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mob` int(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Complaint` varchar(255) DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  `CreatedBy` int(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(255) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complain`
--

INSERT INTO `tbl_complain` (`id`, `name`, `email`, `mob`, `address`, `Complaint`, `Status`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(14, 'Prachin', 'Prachin@gmail.com', 2147483647, 'Address', 'Addresss', 'Approved', 3, '2021-04-04 00:00:00', 3, '2021-04-07 00:00:00'),
(15, 'sneha mishranew', 'tejas@gmail.com', 2147483647, 'adres', 'nsns', 'Open', 3, '2021-04-04 00:00:00', 3, '2021-04-06 00:00:00'),
(16, 'sneha mishra', 'Prachin@gmail.com', 2147483647, 'Trst', 'mnnssd', 'Approved', 23, '2021-04-04 00:00:00', NULL, NULL),
(18, 'Tejas', 'manetejas00@gmail.com', 2147483647, 'Address', 'Test', 'Approved', 41, '2021-04-06 00:00:00', NULL, NULL),
(19, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'aa', 'tejas', 'Open', 41, '2021-04-07 00:00:00', NULL, NULL),
(20, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'aa', 'sdddaf', 'Open', 3, '2021-04-07 00:00:00', NULL, NULL),
(21, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'tet', 'etete', 'Open', 3, '2021-04-07 00:00:00', NULL, NULL),
(22, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'aa', 'fhfgh', 'Open', 3, '2021-04-07 00:00:00', NULL, NULL),
(23, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'cfh', 'hgfh', 'Open', 3, '2021-04-07 00:00:00', NULL, NULL),
(24, 'Jobs', 'Jobs@gmail.com', 2147483647, 'test', 'test', 'Open', 3, '2021-04-07 00:00:00', NULL, NULL),
(25, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'aa', 'Test', 'Open', 41, '2021-04-07 00:00:00', NULL, NULL),
(26, 'sneha mishra', 'tejas@gmail.com', 2147483647, 'aa', 'Test', 'Open', 41, '2021-04-07 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `calendar_end` date DEFAULT NULL,
  `CreatedBy` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `title`, `start`, `end`, `calendar_end`, `CreatedBy`) VALUES
(16, 'To do tejas', '2021-04-05', '2021-04-05', '2021-04-05', NULL),
(17, 'daily list Tejas', '2021-04-05', '2021-04-05', '2021-04-05', NULL),
(18, 'Tejas', '2021-04-05', '2021-04-06', '2021-04-06', NULL),
(19, 'fghfgh', '2021-04-05', '2021-04-06', '2021-04-06', 72),
(20, 'chch', '2021-04-06', '2021-04-07', '2021-04-07', 72),
(21, 'asas', '2021-04-19', '2021-04-21', '2021-04-21', 72),
(22, 'asd', '2021-04-02', '2021-04-02', '2021-04-02', 72),
(23, 'gjgh', '2021-04-09', '2021-04-11', '2021-04-11', 72),
(24, 'tejas', '2021-04-08', '2021-04-09', '2021-04-09', 72),
(25, 'nikhil', '2021-04-05', '2021-04-06', '2021-04-06', 27),
(26, 'tejas', '2021-04-06', '2021-04-07', '2021-04-07', 42),
(27, 'Tejas', '2021-04-06', '2021-04-06', '2021-04-06', 42),
(28, 'tEJAS', '2021-04-06', '2021-04-07', '2021-04-07', 42),
(29, 'Tejas', '2021-04-06', '2021-04-07', '2021-04-07', 3),
(34, 'Tejas', '2021-04-07', '2021-04-08', '2021-04-08', 41),
(35, 'to is to update electricity', '2021-04-07', '2021-04-07', '2021-04-07', 41),
(36, 'kmdrx2hmjncxzbfm rfbhbhr\nirfixnn,xjnjefnx,kzec nrnj snnda,jnj', '2021-04-10', '2021-04-10', '2021-04-10', 41);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` int(2) NOT NULL,
  `dob` date DEFAULT current_timestamp(),
  `IsAdmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `username`, `password`, `email`, `mob`, `address`, `gender`, `dob`, `IsAdmin`) VALUES
(3, 'Admin', '123', 'tejas@gmail.com', '99', 'kjnj', 1, NULL, 'Admin'),
(23, 'Prachin', '123', 'Prachin@gmail.com', '9975535595', 'Manoe', 1, '0000-00-00', 'User'),
(41, 'tejas', '123', 'tejas1@gmail.com', '999', 'aa', 1, '2021-04-06', 'User'),
(42, 'tejas1', '123', 'smishra1704@gmail.com', '7894561230', 'aa', 1, '1997-04-14', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_complain`
--
ALTER TABLE `tbl_complain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_complain`
--
ALTER TABLE `tbl_complain`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
