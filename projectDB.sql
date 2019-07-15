-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 10:22 PM
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
CREATE DATABASE IF NOT EXISTS `projectDB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projectDB`;

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
('ASDASD', 'ASDAqweq', 'qdASDA', '12312312', 'eqweqweqwe'),
('d01', '123456', 'Who am I', '34234134', 'Where am I'),
('d02', '123456', 'test', '53214561', 'Secret B'),
('d03', '123456', 'test', '53214561', 'Secret C'),
('d04', '123456', 'test', '53214561', 'Secret d'),
('d05', '123456', 'test', '53214561', 'Secret E'),
('eqweqwe', 'qweqweqwe', 'qweqweqwe', '12345678', 'asdasd'),
('john', '123456', 'test', '53214561', 'Secret F'),
('John1', '123456', 'John Chan.', '24333333', 'IVE TY.'),
('John2', '123456', 'Peter', '22222222', 'IVE TY'),
('ling', '123456', 'Guess who am I', '53214561', 'Secret G'),
('qweqwe', 'qweqwe', '\'\'', '12345678', 'qweqwe'),
('qweqwe3', 'qweqweqwe', '\'\'', '12345678', 'qweqwe');

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
(11, 1, 19, '500.00'),
(12, 1, 100, '500.00'),
(12, 2, 10, '200.00'),
(12, 3, 5, '399.00'),
(13, 1, 100, '500.00'),
(13, 4, 10, '250.00'),
(14, 1, 100, '500.00'),
(14, 4, 10, '250.00'),
(14, 8, 98, '1500.00'),
(15, 1, 1, '500.00'),
(15, 2, 100, '200.00'),
(15, 3, 1, '399.00'),
(15, 6, 1, '1000.00'),
(15, 7, 1, '1200.00'),
(16, 1, 1, '500.00'),
(16, 3, 1, '399.00'),
(16, 6, 1, '1000.00'),
(16, 7, 1, '1200.00'),
(17, 1, 1, '500.00'),
(17, 3, 1, '399.00'),
(17, 6, 1, '1000.00'),
(18, 1, 1, '500.00'),
(18, 3, 1, '399.00'),
(18, 6, 1, '1000.00'),
(18, 7, 1, '1200.00'),
(18, 8, 1, '1500.00'),
(19, 9, 1, '2500.00'),
(19, 10, 1, '1000.00'),
(19, 11, 1, '500.00'),
(19, 12, 1, '555.00'),
(20, 1, 1, '500.00'),
(20, 3, 1, '399.00'),
(20, 6, 1, '1000.00'),
(20, 7, 1, '1200.00'),
(20, 8, 1, '1500.00'),
(21, 1, 995, '500.00'),
(21, 6, 493, '1000.00'),
(21, 8, 1, '1500.00'),
(22, 3, 1, '399.00'),
(23, 3, 1, '399.00'),
(23, 7, 1, '1200.00'),
(23, 8, 1, '1500.00'),
(24, 1, 4, '500.00'),
(24, 3, 4, '399.00'),
(24, 6, 4, '1000.00'),
(24, 7, 2, '1200.00'),
(24, 8, 4, '1500.00'),
(25, 14, 500, '1000.00'),
(25, 13, 300, '1000.00');

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
(11, 'ling', '2019-07-14', 'Secret G', 1),
(12, 'John2', '2019-07-15', 'IVE TY', 4),
(13, 'John2', '2019-07-15', 'IVE TY', 4),
(14, 'John2', '2019-07-15', 'IVE TY', 1),
(15, 'John2', '2019-07-15', 'IVE TY', 1),
(16, 'd01', '2019-07-15', 'Where am I', 4),
(17, 'John2', '2019-07-15', 'IVE TY IS GOOD.', 1),
(18, 'John2', '2019-07-15', 'IVE TY IS GOOD', 1),
(19, 'John2', '2019-07-15', 'IVE TY is very good', 1),
(20, 'John2', '2019-07-15', 'IVE TY is the best', 4),
(21, 'John2', '2019-07-15', 'IVE TY', 4),
(22, 'John2', '2019-07-15', 'IVE TY', 4),
(23, 'd01', '2019-07-15', 'Where am I', 3),
(24, 'd01', '2019-07-15', 'Where am I I am IVE student', 2),
(25, 'John2', '2019-07-15', 'IVE TY', 1);

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
(1, 'admin01@gmail.com', 'Headlight_good2', 992, '500.00', 1),
(2, 'admin02@gmail.com', 'Wheel', 0, '200.00', 1),
(3, 'admin01@gmail.com', 'Bonnet/hood', 9797, '399.00', 1),
(4, 'admin02@gmail.com', 'Unexposed bumper', 0, '250.00', 1),
(5, 'admin01@gmail.com', 'Exposed Bumper', 4817, '400.00', 2),
(6, 'admin01@gmail.com', 'Cowl screen', 490, '1000.00', 1),
(7, 'admin01@gmail.com', 'Decklid', 5292, '1200.00', 1),
(8, 'admin01@gmail.com', 'Fascia rear and support', 7593, '1500.00', 1),
(9, 'admin01@gmail.com', 'Fender (wing or mudguard)', 9897, '2500.00', 1),
(10, 'admin01@gmail.com', 'Front clip', 49354, '1000.00', 1),
(11, 'admin01@gmail.com', 'Front fascia and header panel', 894, '500.00', 1),
(12, 'admin01@gmail.com', 'Grille', 5000, '200.00', 1),
(13, 'admin01@gmail.com', 'Test', 1700, '1000.00', 1),
(14, 'admin01@gmail.com', 'Test1', 1500, '1000.00', 1);

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
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `partNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
