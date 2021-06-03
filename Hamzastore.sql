--
-- Database: `U4`
--

-- Create database
CREATE DATABASE if not exists `U4`;

use `U4`;

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendorID` int(11) NOT NULL AUTO_INCREMENT,
  `vendorname` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(30) NOT NULL,
  PRIMARY KEY (`vendorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `customerUsername` varchar(200) NOT NULL,
  `customerAddress` varchar(200) NOT NULL,
  `customerEmail` varchar(200) NOT NULL,
  `customerPassword` varchar(500) NOT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `facemaskID` int(4) NOT NULL AUTO_INCREMENT,
  `facemaskName` varchar(30) NOT NULL,
  `facemaskDescription` varchar(100) NOT NULL,
  `facemaskPrice` float NOT NULL,
  `facemaskQuantity` int(4) NOT NULL,
  `facemaskImg` varchar(300) NOT NULL DEFAULT 'http://placehold.it/700x400',
  `vendorID` int(5) NOT NULL,
  PRIMARY KEY (`facemaskID`),
  FOREIGN KEY (`vendorID`) REFERENCES vendors(`vendorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(5) NOT NULL AUTO_INCREMENT,
  `facemaskID` int(5) NOT NULL,
  `customerID` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `orderTotal` float NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `orderStatus` varchar(6) NOT NULL DEFAULT 'Unpaid',
  `discount` varchar(6) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`orderID`),
  FOREIGN KEY (`facemaskID`) REFERENCES products(`facemaskID`),
  FOREIGN KEY (`customerID`) REFERENCES customers(`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
