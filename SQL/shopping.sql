-- As your REMEMBER this, if your sql looks good, please using: Database name (shopping) in config.php and php server must the same when you create new database name whether here (CREATE DATABASES shopping) or CREATE new databases (shopping) in php server. After you create this sql, please test it by yourself like going to use terminal if this sql looks good. Then import shopping.sql to php server. 

-- CREATE DATABASES shopping
-- CREATE TABLE products
-- INSERT INTO products VALUES();

-- When you create new table name, please below "ALTER TABLE `products`ADD PRIMARY KEY (`id`); and ALTER TABLE `products`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;".

-- For category, it has owned items group. When you see category(attribute) in the table of the product, look at the "3 for Mobile", "4 for Laptop", "5 for Desktop", "6 for Others" numbers are the same in the "VALUE" between product and category, it means those items are belonging to category's group. Then you can build new Table for "category", then make new attributes but look at ("categoryName"'s "VALUE" are Mobile, Laptop, Desktop and Others) that are under the category. Please look at the example of the between product and category below.

-- For sub-category, I explained about category's way is the same with sub-category but look at the same number between id (attribute) in category table when to make “VALUES” and categoryid (attribute) in subcategory table when to make “VALUES” for sub-category’s group.


-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2018 at 03:37 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2019-01-24 16:21:18', '21-06-2020 08:27:55 PM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- DROP TABLE IF EXISTS products;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext,
  `Image1` varchar(255) DEFAULT NULL,
  `Image2` varchar(255) DEFAULT NULL,
  `Image3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Insert for table `products`
--
INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `Image1`, `Image2`, `Image3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`) VALUES(
1, 3, 3, 'Apple iPhone 8 64GB Factory Unlocked Smartphone', 'Apple Inc.', 500.99, 0, 'This Apple iPhone 8 64GB Factory Unlocked Smartphone has been determined fully functional by our industry leading functionality inspection. It will show signs of wear like scratches, scuffs, and minor nicks on the screen or body.', 'iphone1.jpg', 'iphone2.jpg', 'iphone3.jpg', 20, 'In stock', '2020-07-31 2:59:50', ''),

(2, 3, 4, 'Samsung Galaxy S8 - 64GB - Factory Unlocked; Verizon / AT&T / T-Mobile', 'Apple Inc.', 179.99, 0, '“The device will show a Pink/Green SHADE ON THE SCREEN, which will not impact the functionality of the device. The cosmetic condition is overall GOOD, it may show signs of wear and tear from previous usage, such as dings & scratches on the screen & body. | The device has been tested and is FULLY FUNCTIONAL”', 'galaxy1.jpg', 'galaxy2.jpg', 'galaxy3.jpg', 20, 'In stock', '2020-07-31 2:59:50', ''),

(3, 4, 4, 'Apple MacBook Air 13.3" Retina IPS Intel Core i5 8GB RAM, 512GB SSD - Silver', 'Apple Inc.', 999.99, 0, 'A brand-new, unused, unopened, undamaged item in its original packaging (where packaging is applicable). Packaging should be the same as what is found in a retail store, unless the item is handmade or was packaged by the manufacturer in non-retail packaging, such as an unprinted box or plastic bag. See the seller listing for full details.', 'retina1.jpg', 'retina2.jpg', 'retina3.jpg', 20, 'In stock', '2020-07-31 2:59:50', ''),

(4, 5, 4, 'HP Desktop Computer 16GB 2TB 480GB SSD Quad Core i5 Windows 10 Pro PC 22" LCD', 'Apple Inc.', 154.95, 0, '“Our refurbishing is based on the functionality of the computers.There may be signs of normal cosmetic wear and tear, which do not affect the functionality of the computer”.', 'desktop1.jpg', 'desktop2.jpg', 'desktop3.jpg', 20, 'In stock', '2020-07-31 2:59:50', '');

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(3, 'Mobile Phone', 'Test anuj', '2020-01-24 19:17:37', '30-01-2020 12:22:24 AM'),
(4, 'Laptop', 'Electronic Products', '2020-01-24 19:19:32', ''),
(5, 'Desktop', 'Electronic Products', '2020-01-24 19:19:54', ''),
(6, 'Electronics', 'Products', '2020-02-20 19:18:52', '');


-- --------------------------------------------------------


--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(2, 4, 'Surface Pro', '2020-01-26 16:24:52', '26-01-2020 11:03:40 PM'),
(3, 6, 'Television', '2020-01-26 16:29:09', ''),
(4, 3, 'Mobiles', '2020-01-30 16:55:48', ''),
(5, 3, 'Mobile Accessories', '2020-02-04 04:12:40', ''),
(6, 4, 'Dell', '2020-02-04 04:13:00', ''),
(7, 6, 'Computers', '2020-02-04 04:13:27', ''),
(8, 6, 'Fan', '2020-02-04 04:13:54', ''),
(9, 6, 'AC Condition', '2020-02-04 04:36:45', ''),
(10, 4, 'Dell', '2020-02-04 04:37:02', ''),
(11, 4, 'Macbook Retina', '2020-02-04 04:37:51', ''),
(12, 5, 'iMac', '2020-03-10 20:12:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2020-08-04 2:56:50', '', 1),
(2, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2020-08-04 2:57:50', '', 1),
(3, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2020-08-04 2:56:50', '', 1),
(4, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2020-08-04 2:56:50', '26-02-2020 11:12:06 PM', 1);


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(1, 'Anuj Kumar', 'anuj.lpu1@gmail.com', 9009857868, 'f925916e2754e5e03f75dd58a5733251', 'CS New Delhi', 'New Delhi', 'Delhi', 110001, 'New Delhi', 'New Delhi', 'Delhi', 110092, '2017-02-04 19:30:50', ''),
(2, 'Amit ', 'amit@gmail.com', 8285703355, '5c428d8875d2948607f3e3fe134d71b4', '', '', '', 0, '', '', '', 0, '2019-03-15 17:21:22', ''),
(3, 'hg', 'hgfhgf@gmass.com', 1121312312, '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 0, '', '', '', 0, '2020-04-29 09:30:32', '');


--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
  
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
  
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
  
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

