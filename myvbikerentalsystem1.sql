-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 07:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myvbikerentalsystem1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `statusID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `email`, `statusID`) VALUES
(1, 'admin', '12345678925f9e794323b4538', 'admin@gmail.com', 1),
(2, 'admin1', '12345678925f9e794323b4538', 'admin1@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `ID` int(10) NOT NULL,
  `model` int(10) NOT NULL,
  `plate_no` varchar(50) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`ID`, `model`, `plate_no`, `status`) VALUES
(1, 1, 'WAA2458', 2),
(2, 1, 'WBB4632', 2),
(3, 2, 'WA3414F', 3),
(4, 2, 'VA1573', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bikes_status`
--

CREATE TABLE `bikes_status` (
  `ID` int(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bikes_status`
--

INSERT INTO `bikes_status` (`ID`, `status`, `description`) VALUES
(1, 'Available ', 'Available'),
(2, 'Checked Out', 'Already on loan to another patron'),
(3, 'Not Available', 'Not in circulation for some other reason (missing, being repaired, etc.)'),
(4, 'On Hold', 'A requested item is being held for pickup');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `ID` int(10) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`ID`, `brand`) VALUES
(1, 'Kawasaki'),
(2, 'Honda'),
(3, 'Suzuki'),
(4, 'Yamaha');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`ID`, `first_name`, `last_name`, `email`, `phone`, `message`) VALUES
(1, 'mei', 'jing', 'mei@gmail.com', 0, 'nothing');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `ID` int(10) UNSIGNED NOT NULL,
  `model` text NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `type` int(10) NOT NULL,
  `brand` int(10) NOT NULL,
  `year_of_production` int(10) UNSIGNED NOT NULL,
  `engine_volume` decimal(10,2) UNSIGNED NOT NULL,
  `horsepower` decimal(10,2) UNSIGNED NOT NULL,
  `fuel_consumption` decimal(10,2) UNSIGNED NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`ID`, `model`, `product_code`, `type`, `brand`, `year_of_production`, `engine_volume`, `horsepower`, `fuel_consumption`, `price`, `img`) VALUES
(1, 'Z750', 'KWSKZ750', 1, 1, 2010, '748.00', '106.00', '19.00', '20.00', '2010-Kawasaki-Z750-White.jpg'),
(2, 'GSX-S1000', 'SZKGSXS1000', 1, 3, 2015, '999.00', '151.00', '17.00', '25.00', 'Suzuki-GSX-S1000.jpg'),
(3, 'Wave Alpha', 'HDWA2020', 1, 2, 2020, '109.00', '5.00', '4.00', '50.00', 'honda-wave-alpha.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `models_types`
--

CREATE TABLE `models_types` (
  `ID` int(10) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models_types`
--

INSERT INTO `models_types` (`ID`, `type`) VALUES
(1, 'Sport'),
(2, 'Tourist'),
(3, 'Cruiser');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `bikeID` int(10) NOT NULL,
  `startDate` text NOT NULL,
  `endDate` text NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `totalPrice` text NOT NULL,
  `comments` varchar(255) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationID`, `userID`, `bikeID`, `startDate`, `endDate`, `startTime`, `endTime`, `totalPrice`, `comments`, `status`) VALUES
(1, 1, 1, '2021-01-27', '2021-01-30', '10:00:00', '18:00:00', '30', '', 4),
(2, 2, 2, '2021-02-02', '2021-02-04', '10:00:00', '18:00:00', '25', '', 4),
(3, 2, 1, '2021-01-04', '2021-01-06', '09:00:00', '12:00:00', '45.5', 'very good', 3),
(4, 2, 2, '2021-01-11', '2021-01-13', '09:00:00', '12:00:00', '65', '', 3),
(5, 1, 1, '2021-01-20', '2021-01-21', '14:12:00', '13:12:00', '90', '', 3),
(16, 1, 2, '2021-01-27', '2021-01-28', '12:12:00', '15:14:00', '25.00', '', 4),
(17, 1, 2, '2021-01-26', '2021-01-29', '14:15:00', '16:15:00', '71.25', '', 4),
(18, 1, 1, '2021-01-27', '2021-01-28', '10:00:00', '15:30:00', '20.00', '', 4),
(19, 1, 1, '2021-01-27', '2021-01-28', '10:00:00', '15:30:00', '20.00', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusID` int(10) NOT NULL,
  `statusDescription` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `statusDescription`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Done'),
(4, 'Pending'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNo` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `mobileNo`, `address`) VALUES
(1, 'user', '123456789', 'user123@gmail.com', 12355555, '1, Jln Melaka, 66000, Melaka'),
(2, 'user1', '123456789', 'user1@gmail.com', 1234567890, '300, Jln Alor, Bdr Jaya, 26300, Kedah'),
(3, 'user2', '123456789', 'user2@gmail.com', 123456789, '24, Jln Wawasan, Bdr Hijau, 204491, Kuala Lumpur'),
(4, 'user3', '123456789', 'user3@gmail.com', 123456789, '19, Jln Bangau, Bdr Puchong Jaya, 56000, Selangor'),
(5, 'user4', '25f9e794323b453885f5181f1', 'user4@gmail.com', 123483921, '50, Jln Ramah, Bdr Maju, 23090, Kuala Lumpur'),
(8, 'user5', '25f9e794323b453885f5181f1', 'user5@gmail.com', 19397279, '17, Jln Cempaka, Tmn Serdang, 43090, Selangor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bikes_status`
--
ALTER TABLE `bikes_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_models_type` (`type`);

--
-- Indexes for table `models_types`
--
ALTER TABLE `models_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bikeID` (`bikeID`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bikes_status`
--
ALTER TABLE `bikes_status`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `models_types`
--
ALTER TABLE `models_types`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `FK_models_type` FOREIGN KEY (`type`) REFERENCES `models_types` (`ID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
