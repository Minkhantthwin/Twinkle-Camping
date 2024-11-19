-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 07:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twinkle`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(255) DEFAULT NULL,
  `NRC` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `NRC`, `Phone`, `Address`, `Email`, `Password`) VALUES
(1, 'Pyae Pyae Thet Khaing', '12/testing', '097999', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'pyaepyaethetkhaing12@gmail.com', 'pptk123');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`) VALUES
(1, 'Zpacks'),
(2, 'Osprey'),
(3, 'Outdoor');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Backpacks'),
(2, 'Sleeping Beds');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `NRC` varchar(50) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `NRC`, `Address`, `Phone`, `Email`, `Password`, `username`) VALUES
(2, 'Minkhantthwin', '12/testing', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 97999, 'minkhantthwin19@gmail.com', 'minkhant123', 'Faintz'),
(3, 'Kay Thi Aung', '12/testing', 'test', 97333, 'kaythiaung2341@gmail.com', '12345', 'KayThi');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` varchar(15) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Price` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `ProductName` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderID`, `ProductID`, `Price`, `Quantity`, `ProductName`) VALUES
('ORD-000001', 2, 399, 1, 'Arc Blast 55L'),
('ORD-000001', 3, 300, 2, 'OutSunny'),
('ORD-000002', 3, 300, 1, 'OutSunny'),
('ORD-000003', 3, 300, 1, 'OutSunny');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(15) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalAmount` float DEFAULT NULL,
  `TotalQuantity` int(11) DEFAULT NULL,
  `GrandTotal` float DEFAULT NULL,
  `VAT` float DEFAULT NULL,
  `PaymentType` varchar(50) DEFAULT NULL,
  `Direction` varchar(255) DEFAULT NULL,
  `DeliveryStatus` varchar(50) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `TownshipID` int(11) DEFAULT NULL,
  `OptionalDirection` varchar(255) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `Evidence` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `TotalAmount`, `TotalQuantity`, `GrandTotal`, `VAT`, `PaymentType`, `Direction`, `DeliveryStatus`, `CustomerID`, `TownshipID`, `OptionalDirection`, `Comments`, `Evidence`) VALUES
('ORD-000001', '2024-09-21', 999, 3, 1008.99, 0, 'on', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Array', NULL),
('ORD-000002', '2024-09-21', 300, 1, 303, 3, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Array', NULL),
('ORD-000003', '2024-10-04', 300, 1, 303, 3, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', ''),
('ORD-000004', '2024-10-04', 300, 1, 303, 3, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', ''),
('ORD-000005', '2024-10-04', 300, 1, 303, 3, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', ''),
('ORD-000006', '2024-10-04', 300, 1, 303, 3, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', ''),
('ORD-000007', '2024-10-04', 399, 1, 402.99, 3.99, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', ''),
('ORD-000008', '2024-10-04', 399, 1, 402.99, 3.99, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', 'img/clients/67000d7d6491c_'),
('ORD-000009', '2024-10-04', 399, 1, 402.99, 3.99, 'kpay', 'No.51(B) Inya Myaing Street, Golden Valley (1), Bahan, Yangon', 'Pending', 2, 1, 'Testing', 'Testing', 'img/clients/67000da6869d8_KMD.png');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `PackageID` int(11) NOT NULL,
  `PackageName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `PackagePhoto1` text DEFAULT NULL,
  `CarName` varchar(255) DEFAULT NULL,
  `CarNumber` varchar(30) NOT NULL,
  `CarPhoto` text DEFAULT NULL,
  `Duration` varchar(20) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`PackageID`, `PackageName`, `Description`, `PackagePhoto1`, `CarName`, `CarNumber`, `CarPhoto`, `Duration`, `Price`, `Quantity`, `AdminID`) VALUES
(1, 'Platinum', 'All camping necessities included. ', 'package1.jpg', 'Mark II', '4D/4052', 'car1.jpg', '5 days', 20000, 5, 1),
(2, 'Gold', ' A full range of camping supplies & Necessities.', 'about2.jpg', 'Toyota Alphard', '5H/5061', 'Alphard.jpg', '5 days', 15000, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `ProductPhoto1` text DEFAULT NULL,
  `ProductPhoto2` text DEFAULT NULL,
  `Size` varchar(50) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `BrandID` int(11) DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Description`, `ProductPhoto1`, `ProductPhoto2`, `Size`, `Price`, `Quantity`, `CategoryID`, `BrandID`, `AdminID`) VALUES
(2, 'Arc Blast 55L', 'Curved Carbon Fiber Air Stays | Adjustable Torso', 'backpack2.jpg', 'backpack1.jpg', 'Large', '399', 20, 1, 1, 1),
(3, 'OutSunny', 'Outsunny 2-Person Folding Camping Cot Portable Outdoor Bed Set with Sleeping Bag, Inflatable Air Mattress, Comfort Pillows and Carry Bag, Soft and Comfortable for Outdoor Travel Camp Beach Vacation.', 'sleepingbed.png', 'sleepingbed.png', 'Large', '300', 10, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `Review` varchar(255) DEFAULT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `TownshipID` int(11) NOT NULL,
  `TownshipName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`TownshipID`, `TownshipName`) VALUES
(1, 'Bahan'),
(2, 'Thingangyun'),
(3, 'North Dagon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderID`,`ProductID`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`PackageID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `BrandID` (`BrandID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `fk_Customer_ID` (`CustomerID`);

--
-- Indexes for table `township`
--
ALTER TABLE `township`
  ADD PRIMARY KEY (`TownshipID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `PackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
  MODIFY `TownshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `AdminID` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `BrandID` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`),
  ADD CONSTRAINT `CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_Customer_ID` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
