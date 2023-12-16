-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db.cs.dal.ca
-- Generation Time: Nov 28, 2023 at 06:29 PM
-- Server version: 10.3.21-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aniketm`
--

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `ISBN` varchar(13) NOT NULL,
  `CoverImage` varchar(255) DEFAULT NULL,
  `Author` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Genres` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderDetails`
--

CREATE TABLE `OrderDetails` (
  `OrderID` int(11) DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `Login_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`);

--
-- Constraints for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD CONSTRAINT `OrderDetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `Orders` (`OrderID`),
  ADD CONSTRAINT `OrderDetails_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `Books` (`ISBN`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
