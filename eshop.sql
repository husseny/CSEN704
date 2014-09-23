-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2014 at 03:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `completed` tinyint(4) NOT NULL DEFAULT '0',
  `transaction_time` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `carts_products`
--

CREATE TABLE IF NOT EXISTS `carts_products` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL,
  `average_rating` int(11) NOT NULL,
  `image_link` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `discount`, `stock`, `average_rating`, `image_link`, `category`, `added_time`) VALUES
(1, 'shaj', '', 12, 0, 0, 0, '', '', '2014-09-22 14:23:04'),
(2, 'grj', '', 134, 0, 0, 0, '', '', '2014-09-22 14:23:15'),
(3, 'tfr', '', 443, 0, 0, 0, '', '', '2014-09-22 14:23:25'),
(4, 'product A', '', 10, 0, 1, 0, '', 'A', '2014-09-23 12:34:12'),
(5, 'product B', '', 10, 0, 1, 0, '', 'A', '2014-09-23 12:34:18'),
(6, 'product ', '', 10, 0, 1, 0, '', 'A', '2014-09-23 12:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`user_id`,`product_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rate`, `comment`, `time_added`) VALUES
(1, 1, 1, 5, 'Very Good', '2014-09-23 12:35:20'),
(3, 2, 1, 1, 'Bad!', '2014-09-23 12:35:45'),
(7, 19, 1, 0, 'no comment', '2014-09-23 12:39:15'),
(16, 1, 2, 2, 'comment', '2014-09-23 13:03:23'),
(18, 1, 3, 4, 'Lorem ipsum dolor sit amet, coomment', '2014-09-23 13:03:58'),
(19, 1, 4, 5, 'dolor sit amet, coomment', '2014-09-23 13:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `password`, `user_name`, `id`) VALUES
('namoo', 'naamoo', 'qaaaaz', 'naamoo', 1),
('noaa', 'noaaa', '123', 'noaa', 2),
('der', 'teri', '145', 'iserteri', 3),
('gar', 'ghti', '1dd45', 'rin', 4),
('', '', '', '', 5),
('ha', 'ho', '123', 'he', 18),
('nemo', 'keno', '123', 'usershemo', 19),
('newo', 'keeno', '123', 'usereshemo', 21),
('with password', 'keenopassword', '111123', 'usemo', 22),
('with password', 'keenopassword', '111123', 'use2mo', 26),
('withs string', 'string', '111123', 'string passw', 28),
('withs string', 'string', 'aaaa', 'striddng passw', 30),
('', 'string', 'aaaa', 'strpassw', 31);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts_products`
--
ALTER TABLE `carts_products`
  ADD CONSTRAINT `carts_products_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
