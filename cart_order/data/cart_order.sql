-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 09:14 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_name` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_name`, `order_email`) VALUES
(2, '2019-03-18 08:10:11', 'vova2', 'vova2@gmail.com'),
(3, '2019-03-18 08:10:29', 'sss', 'dasfa@fa.com'),
(4, '2019-03-18 08:10:46', 'vova', 'vova@gmail.com'),
(5, '2019-03-18 08:55:29', 'fredrik', 'fred@g.com'),
(6, '2019-03-18 08:56:08', 'Rich Man', 'money@man.se'),
(7, '2019-03-18 09:00:37', 'Eugenia', 'eugenia@gmail.com'),
(8, '2019-03-18 09:01:41', 'vova', 'dasfa@fa.com'),
(9, '2019-03-18 09:03:24', 'vova', 'vova2@gmail.com'),
(10, '2019-03-18 09:07:37', 'vova', 'vova2@gmail.com'),
(11, '2019-03-18 09:09:04', 'Eugenia', 'eugenia@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(3, 2, 1, 1),
(8, 4, 2, 1),
(9, 5, 6, 2),
(10, 5, 2, 2),
(11, 6, 3, 3),
(15, 10, 3, 1),
(16, 11, 1, 3),
(18, 11, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_description` text,
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_description`, `product_price`) VALUES
(1, 'iPhone X', 'images/iphone.jpg', 'iPhone X 256GB is a smartphone desined, developed, and marketed by Apple Inc', '12000.00'),
(2, 'Google Glass', 'images/glasses.jpg', 'Google Glass is a brand of smart glasses - an optical head-mounted display', '1800.00'),
(3, 'Laptop Asus', 'images/laptop.jpg', 'Desined for daily productivity and entertainment', '14000.00'),
(4, 'Watch', 'images/watch.jpg', 'This watch is something personal for people with good taste ', '5000.00'),
(5, 'Camera Canon', 'images/camera.jpg', 'One of the best Canon camera for profesionals', '4500.00'),
(6, 'External hard drive', 'images/external-hard-drive.jpg', 'Seagate Expansion 8TB External Hard Drive', '2000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id_idx` (`order_id`),
  ADD KEY `product_id_idx` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `name` (`product_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
