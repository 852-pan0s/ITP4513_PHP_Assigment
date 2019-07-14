-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 02:27 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `email` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`email`, `firstName`, `lastName`, `password`) VALUES
('admin01@gmail.com', 'Pan', 'Poon', '123456'),
('admin02@gmail.com', 'Eric', 'Wong', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `dealerID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`dealerID`, `password`, `name`, `phoneNumber`, `address`) VALUES
('d01', '123456', 'Who am I', '34234134', 'Where am I'),
('d02', '123456', 'test', '53214561', 'Secret B'),
('d03', '123456', 'test', '53214561', 'Secret C'),
('d04', '123456', 'test', '53214561', 'Secret d'),
('d05', '123456', 'test', '53214561', 'Secret E'),
('john', '123456', 'test', '53214561', 'Secret F'),
('ling', '123456', 'Guess who am I', '53214561', 'Secret G');

-- --------------------------------------------------------

--
-- Table structure for table `orderpart`
--

CREATE TABLE `orderpart` (
  `orderID` int(11) NOT NULL,
  `partNumber` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderpart`
--

INSERT INTO `orderpart` (`orderID`, `partNumber`, `quantity`, `price`) VALUES
(1, 1, 600, '500.00'),
(1, 3, 44, '399.00'),
(1, 4, 45, '250.00'),
(1, 5, 12, '400.00'),
(2, 2, 74, '200.00'),
(2, 6, 98, '1000.00'),
(2, 7, 98, '1200.00'),
(2, 8, 98, '1500.00'),
(2, 9, 15, '2500.00'),
(2, 10, 56, '1000.00'),
(3, 6, 1, '1000.00'),
(3, 7, 1, '1200.00'),
(3, 8, 1, '1500.00'),
(3, 9, 1, '2500.00'),
(3, 10, 1, '1000.00'),
(4, 2, 1, '200.00'),
(4, 3, 1, '399.00'),
(5, 1, 1, '500.00'),
(5, 2, 1, '200.00'),
(5, 3, 1, '399.00'),
(5, 4, 1, '250.00'),
(5, 5, 1, '400.00'),
(6, 11, 1, '500.00'),
(6, 12, 1, '555.00'),
(7, 1, 20, '500.00'),
(7, 2, 33, '200.00'),
(7, 3, 12, '399.00'),
(7, 4, 52, '250.00'),
(7, 5, 11, '400.00'),
(8, 10, 444, '1000.00'),
(9, 6, 1, '1000.00'),
(9, 7, 1, '1200.00'),
(9, 8, 1, '1500.00'),
(9, 9, 1, '2500.00'),
(10, 2, 1, '200.00'),
(11, 1, 19, '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `dealerID` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `dealerID`, `orderDate`, `deliveryAddress`, `status`) VALUES
(1, 'd01', '2019-07-14', 'Where am I', 4),
(2, 'd01', '2019-07-14', 'new address ABC, 14F', 2),
(3, 'd01', '2019-07-14', 'Where am I', 2),
(4, 'ling', '2019-07-14', 'New Address', 2),
(5, 'ling', '2019-07-14', 'Secret G', 2),
(6, 'ling', '2019-07-14', 'Secret G', 2),
(7, 'ling', '2019-07-14', 'Secret G', 1),
(8, 'ling', '2019-07-14', 'Secret G', 1),
(9, 'ling', '2019-07-14', 'Secret G a_a', 1),
(10, 'ling', '2019-07-14', 'Secret G A_A', 1),
(11, 'ling', '2019-07-14', 'Secret G', 1);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `partNumber` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `partName` varchar(100) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `stockPrice` decimal(10,2) NOT NULL,
  `stockStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`partNumber`, `email`, `partName`, `stockQuantity`, `stockPrice`, `stockStatus`) VALUES
(1, 'admin01@gmail.com', 'Headlight_good2', 1100, '500.00', 1),
(2, 'admin02@gmail.com', 'Wheel', 5164, '200.00', 1),
(3, 'admin01@gmail.com', 'Bonnet/hood', 9805, '399.00', 1),
(4, 'admin02@gmail.com', 'Unexposed bumper', 4840, '250.00', 2),
(5, 'admin01@gmail.com', 'Exposed Bumper', 4817, '400.00', 1),
(6, 'admin01@gmail.com', 'Cowl screen', 498, '1000.00', 2),
(7, 'admin01@gmail.com', 'Decklid', 5298, '1200.00', 1),
(8, 'admin01@gmail.com', 'Fascia rear and support', 7698, '1500.00', 1),
(9, 'admin01@gmail.com', 'Fender (wing or mudguard)', 9898, '2500.00', 1),
(10, 'admin01@gmail.com', 'Front clip', 49355, '1000.00', 1),
(11, 'admin01@gmail.com', 'Front fascia and header panel', 895, '500.00', 1),
(12, 'admin01@gmail.com', 'Grille (also called grill)', 5793, '555.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`dealerID`);

--
-- Indexes for table `orderpart`
--
ALTER TABLE `orderpart`
  ADD KEY `FKOrderPart106296` (`orderID`),
  ADD KEY `FKOrderPart737123` (`partNumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FKOrders795865` (`dealerID`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`partNumber`),
  ADD UNIQUE KEY `partName` (`partName`),
  ADD KEY `FKPart451022` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `partNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderpart`
--
ALTER TABLE `orderpart`
  ADD CONSTRAINT `FKOrderPart106296` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `FKOrderPart737123` FOREIGN KEY (`partNumber`) REFERENCES `part` (`partNumber`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKOrders795865` FOREIGN KEY (`dealerID`) REFERENCES `dealer` (`dealerID`);

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `FKPart451022` FOREIGN KEY (`email`) REFERENCES `administrator` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
