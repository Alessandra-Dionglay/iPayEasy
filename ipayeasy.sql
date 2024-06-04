-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2024 at 05:56 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipayeasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(300) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `username`, `password`, `address`, `contact`, `email`) VALUES
(5, 'diwata', 'pares', 'diwata', 'paresan', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` mediumtext NOT NULL,
  `address` varchar(300) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `product_orders` longtext NOT NULL,
  `order_date` datetime NOT NULL,
  `total` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `reason` varchar(400) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `customer_name`, `address`, `contact`, `email`, `product_orders`, `order_date`, `total`, `status`, `reason`) VALUES
(40, 'diwata', 'diwata pares', 'dada', 'ds', '', '[{\"product_id\":\"90\",\"product_name\":\"iPhone 13 Pro Max (2nd Hand)\",\"description\":\"yy\",\"color\":\"Space Gray\",\"size\":\"256GB\",\"quantity\":\"1\",\"price\":\"65000\",\"best_seller\":\"1\",\"brand_new\":\"0\",\"new_arrival\":\"1\",\"image\":\"1714119970_iphone.png\",\"cart_item_id\":\"1714660770701\"},{\"product_id\":\"90\",\"product_name\":\"iPhone 13 Pro Max (2nd Hand)\",\"description\":\"yy\",\"color\":\"Space Gray\",\"size\":\"256GB\",\"quantity\":\"1\",\"price\":\"65000\",\"best_seller\":\"1\",\"brand_new\":\"0\",\"new_arrival\":\"1\",\"image\":\"1714119970_iphone.png\",\"cart_item_id\":\"1714660772058\"},{\"product_id\":\"90\",\"product_name\":\"iPhone 13 Pro Max (2nd Hand)\",\"description\":\"yy\",\"color\":\"Space Gray\",\"size\":\"256GB\",\"quantity\":\"1\",\"price\":\"65000\",\"best_seller\":\"1\",\"brand_new\":\"0\",\"new_arrival\":\"1\",\"image\":\"1714119970_iphone.png\",\"cart_item_id\":\"1714660773215\"},{\"product_id\":\"90\",\"product_name\":\"iPhone 13 Pro Max (2nd Hand)\",\"description\":\"yy\",\"color\":\"Space Gray\",\"size\":\"256GB\",\"quantity\":\"1\",\"price\":\"65000\",\"best_seller\":\"1\",\"brand_new\":\"0\",\"new_arrival\":\"1\",\"image\":\"1714119970_iphone.png\",\"cart_item_id\":\"1714660774311\"},{\"product_id\":\"90\",\"product_name\":\"iPhone 13 Pro Max (2nd Hand)\",\"description\":\"yy\",\"color\":\"Space Gray\",\"size\":\"256GB\",\"quantity\":\"1\",\"price\":\"65000\",\"best_seller\":\"1\",\"brand_new\":\"0\",\"new_arrival\":\"1\",\"image\":\"1714119970_iphone.png\",\"cart_item_id\":\"1714660775442\"},{\"product_id\":\"90\",\"product_name\":\"iPhone 13 Pro Max (2nd Hand)\",\"description\":\"yy\",\"color\":\"Space Gray\",\"size\":\"256GB\",\"quantity\":\"1\",\"price\":\"65000\",\"best_seller\":\"1\",\"brand_new\":\"0\",\"new_arrival\":\"1\",\"image\":\"1714119970_iphone.png\",\"cart_item_id\":\"1714660776570\"}]', '2024-05-02 14:39:41', 390000, 'processing', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `best_seller` int NOT NULL,
  `brand_new` int NOT NULL,
  `new_arrival` int NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `color`, `size`, `quantity`, `price`, `best_seller`, `brand_new`, `new_arrival`, `image`) VALUES
(87, 'iPhone 13 Pro Max', 'Iphone', 'Rose Gold', '128GB', 5000, 50000, 0, 0, 0, '1714614349_iphone.png'),
(90, 'iPhone 13 Pro Max (2nd Hand)', 'yy', 'Space Gray', '256GB', 5, 65000, 1, 0, 1, '1714119970_iphone.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
