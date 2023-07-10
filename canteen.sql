-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 11:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `AdminId` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `verify_token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`AdminId`, `Email`, `password`, `verify_token`) VALUES
(1, 'admin@gmail.com', 'Admin@123', '434f695ffce0fbc40fe770d2fd76a241');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacktb`
--

CREATE TABLE `feedbacktb` (
  `FeedbackId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Review` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacktb`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  `image` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`CategoryId`, `CategoryName`, `image`) VALUES
(4, 'Chiness', 'image/chiness.jpg'),
(5, 'Gujrati', 'image/gujrati.jpg'),
(6, 'Punjabi', 'image/punjabi.jpg'),
(7, 'South-Indian', 'image/southindian.jpg'),
(8, 'Chaat', 'image/chaat.jpg'),
(9, 'FastFood', 'image/fastfood.jpg'),
(10, 'Snacks', 'image/snacks.jpg'),
(11, 'Desserts', 'image/Desserts.jpg'),
(12, 'Chocolate', 'image/chocolate.jpg'),
(13, 'Drinks', 'image/drink.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `historyiteam`
--

CREATE TABLE `historyiteam` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `iteamquentity` int(11) NOT NULL,
  `Food_Type` varchar(20) NOT NULL,
  `CustomerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historyiteam`
--


-- --------------------------------------------------------

--
-- Table structure for table `historyorder`
--

CREATE TABLE `historyorder` (
  `id` int(11) NOT NULL,
  `Orderid` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `OrderType` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `addedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historyorder`
--



-- --------------------------------------------------------

--
-- Table structure for table `menutb`
--

CREATE TABLE `menutb` (
  `MenuId` int(11) NOT NULL,
  `FoodName` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Discription` varchar(40) NOT NULL,
  `Image` varchar(40) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menutb`
--

INSERT INTO `menutb` (`MenuId`, `FoodName`, `Price`, `Discription`, `Image`, `CategoryId`, `type`) VALUES
(8, 'manchurian', 60, 'hot and spicy', 'upload/Dry-Manchurian-2.jpg', 4, 'Lunch'),
(10, 'jalebi', 40, 'sweet', 'upload/jalebi.jpg', 5, 'breakfast'),
(11, 'sandwich', 70, 'grill and cheesy', 'upload/sandwich.jpg', 9, 'snacks'),
(12, 'dosa', 100, 'simple', 'upload/dosa.jpg', 7, 'Lunch'),
(13, 'rajma-chawal', 150, 'spicy', 'upload/rajma.jpg', 6, 'Lunch'),
(14, 'waffel', 150, 'sweet', 'upload/waffel.jpg', 11, 'snacks'),
(15, 'Dahi-papdi', 40, 'sweet and spicy', 'upload/dahipapdi.jpg', 8, 'snacks'),
(16, 'Coco-Cola', 20, 'Cold Drink', 'upload/cococola.jpg', 13, 'snacks'),
(17, 'simply salted', 10, 'salted weffer', 'upload/balaji.jpeg', 10, 'snacks'),
(18, 'Kit-Kat', 20, 'sweet and cruncy', 'upload/kitkat.jpg', 12, 'snacks'),
(19, 'Noodles', 60, 'hot and spicy', 'upload/hakka-noodles.jpg', 4, 'Lunch'),
(20, 'Chiness-Bhel', 80, 'hot and spicy', 'upload/chinessbhel.jpg', 4, 'Lunch'),
(21, 'Khaman', 50, 'spicy', 'upload/khaman.jpg', 5, 'snacks'),
(22, 'Fafda', 40, 'cruncy', 'upload/fafda.jpg', 5, 'snacks'),
(23, 'Chole-Bhature', 80, 'spicy', 'upload/chole-bhature.jpg', 6, 'Lunch'),
(24, 'Naan', 30, '....', 'upload/nan.jpg', 6, 'Lunch'),
(25, 'Idli-Sambhar', 40, 'spicy', 'upload/idli-shambhar.jpg', 7, 'Lunch'),
(26, 'Mendu-Vada', 50, 'spicy', 'upload/mendu-vada.jpg', 7, 'Lunch'),
(27, 'Panipuri', 30, 'spicy and crunchy', 'upload/panipuri.jpeg', 8, 'snacks'),
(28, 'Bhel', 20, 'spicy and crunchy', 'upload/bhel.jpg', 8, 'snacks'),
(29, 'Burger', 50, 'spicy ', 'upload/burger.jpg', 9, 'snacks'),
(30, 'French-Fries', 40, 'crunchy', 'upload/french-fries.jpg', 9, 'snacks'),
(31, 'Kurkure', 20, 'spicy and crunchy', 'upload/Kurkure.jpg', 10, 'snacks'),
(32, 'Banana-Weffer', 10, 'spicy and crunchy', 'upload/banana.jpg', 10, 'snacks'),
(33, 'Ice-cream', 50, 'sweet', 'upload/ice-cream.jpg', 11, 'snacks'),
(34, 'Pan-Cake', 50, 'sweet', 'upload/pan-cake.jpg', 11, 'snacks'),
(35, 'Silk', 40, 'sweet', 'upload/silk.jpg', 12, 'snacks'),
(36, 'Bounty', 60, 'sweet', 'upload/bounty.jpg', 12, 'snacks'),
(37, 'Maza', 30, 'sweet', 'upload/maza.jpg', 13, 'snacks'),
(38, 'sprite', 20, 'sweet', 'upload/sprite.jpg', 13, 'snacks'),
(40, 'abc', 40, 'sweet', 'upload/bhel.jpg', 8, 'snacks');

-- --------------------------------------------------------

--
-- Table structure for table `orderiteam`
--

CREATE TABLE `orderiteam` (
  `id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `itemquentity` int(11) NOT NULL,
  `Food_Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordertb`
--

CREATE TABLE `ordertb` (
  `OrderId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `OrderType` varchar(20) NOT NULL,
  `total_amount` varchar(20) NOT NULL,
  `addedate` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_date` varchar(50) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `mobile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `registation`
--

CREATE TABLE `registation` (
  `id` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `verify_token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registation`
--

-- --------------------------------------------------------

--
-- Table structure for table `stafftb`
--

CREATE TABLE `stafftb` (
  `StaffId` int(11) NOT NULL,
  `StaffName` varchar(20) NOT NULL,
  `StaffAddress` varchar(40) NOT NULL,
  `StaffEmail` varchar(40) NOT NULL,
  `StaffSalary` int(11) NOT NULL,
  `Image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stafftb`
--

INSERT INTO `stafftb` (`StaffId`, `StaffName`, `StaffAddress`, `StaffEmail`, `StaffSalary`, `Image`) VALUES
(1, 'abcd', 'abc complex,surat', 'abcd@gmail.com', 10000, 'upload/abc.png');

-- --------------------------------------------------------

--
-- Table structure for table `viewcart`
--

CREATE TABLE `viewcart` (
  `cartid` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `addedate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Food_Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `likeid` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `feedbacktb`
--
ALTER TABLE `feedbacktb`
  ADD PRIMARY KEY (`FeedbackId`),
  ADD KEY `f2` (`CustomerId`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `historyiteam`
--
ALTER TABLE `historyiteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historyorder`
--
ALTER TABLE `historyorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menutb`
--
ALTER TABLE `menutb`
  ADD PRIMARY KEY (`MenuId`),
  ADD KEY `f1` (`CategoryId`);

--
-- Indexes for table `orderiteam`
--
ALTER TABLE `orderiteam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`OrderId`),
  ADD KEY `menuid` (`MenuId`);

--
-- Indexes for table `ordertb`
--
ALTER TABLE `ordertb`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `customerid` (`CustomerId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`OrderId`);

--
-- Indexes for table `registation`
--
ALTER TABLE `registation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stafftb`
--
ALTER TABLE `stafftb`
  ADD PRIMARY KEY (`StaffId`);

--
-- Indexes for table `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `menuindex` (`MenuId`),
  ADD KEY `userid` (`CustomerId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `menuid` (`MenuId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `AdminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedbacktb`
--
ALTER TABLE `feedbacktb`
  MODIFY `FeedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `historyiteam`
--
ALTER TABLE `historyiteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `historyorder`
--
ALTER TABLE `historyorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `menutb`
--
ALTER TABLE `menutb`
  MODIFY `MenuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orderiteam`
--
ALTER TABLE `orderiteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ordertb`
--
ALTER TABLE `ordertb`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registation`
--
ALTER TABLE `registation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stafftb`
--
ALTER TABLE `stafftb`
  MODIFY `StaffId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacktb`
--
ALTER TABLE `feedbacktb`
  ADD CONSTRAINT `f2` FOREIGN KEY (`CustomerId`) REFERENCES `registation` (`id`);

--
-- Constraints for table `menutb`
--
ALTER TABLE `menutb`
  ADD CONSTRAINT `f1` FOREIGN KEY (`CategoryId`) REFERENCES `food_category` (`CategoryId`);

--
-- Constraints for table `orderiteam`
--
ALTER TABLE `orderiteam`
  ADD CONSTRAINT `orderiteam_ibfk_1` FOREIGN KEY (`MenuId`) REFERENCES `menutb` (`MenuId`),
  ADD CONSTRAINT `orderiteam_ibfk_2` FOREIGN KEY (`OrderId`) REFERENCES `ordertb` (`OrderId`);

--
-- Constraints for table `viewcart`
--
ALTER TABLE `viewcart`
  ADD CONSTRAINT `viewcart_ibfk_1` FOREIGN KEY (`MenuId`) REFERENCES `menutb` (`MenuId`),
  ADD CONSTRAINT `viewcart_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `registation` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`MenuId`) REFERENCES `menutb` (`MenuId`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `registation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
