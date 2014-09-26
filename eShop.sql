-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2014 at 12:16 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL DEFAULT '0',
  `completed` tinyint(4) NOT NULL DEFAULT '0',
  `transaction_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `total_price`, `completed`, `transaction_time`) VALUES
(2, 1, 0, 1, '2014-09-25 21:36:39'),
(3, 1, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts_products`
--

CREATE TABLE IF NOT EXISTS `carts_products` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rate`, `comment`, `time_added`) VALUES
(1, 1, 1, 5, 'I was squirming in my seat with this crazy cliff hanger ending and I am going to go crazy waiting for the next one.\nArmentrout has even furthered her hold on my attention with the 3rd Lux novel.\nHow can I resist the fire between Kat and Daemon? It makes my heart speed.\nI have recommended this series to all my book loving friends and family.\nREAD IT!!!', '2014-09-23 12:35:20'),
(3, 2, 1, 1, 'Bad!', '2014-09-23 12:35:45'),
(7, 19, 1, 0, 'no comment', '2014-09-23 12:39:15'),
(16, 1, 2, 2, 'This is probably my favorite season (and my favorite Doctor)\nThe pairing of David Tennant and Catherine Tate is a non-stop laugh. The chemistry is brilliant between them.', '2014-09-23 13:03:23'),
(18, 1, 3, 4, ' picked up this book because a friend suggested it to me. I tried very hard to like it because she seemed so happy with it and I thought I just needed to keep pushing on until a good rhythm formed, but, with every new chapter my eyes rolled more and more. The writing is horribly choppy, dialog is childish and rushed, and the use of the same words and phrases over and over again just annoyed me into never wanting to pick it up again.\nIn one chapter the female lead ', '2014-09-23 13:03:58'),
(19, 1, 4, 5, 'These are some of my son''s favorite tools in the kitchen. He loves to ask me for star eggs or heart eggs for his lunches, and sometimes just for a snack. They are easy to use, fast, and super easy to clean.\nA great addition to Bentos, parties (star shaped deviled eggs!!!) or just something fun to eat on your own.', '2014-09-23 13:04:26'),
(20, 1, 5, 2, 'I love cutting up veggies or cheese (and sometimes pieces of sandwich or deli meats) with these.\nAnd though I am lucky enough to have a child that loves to eat his vegetables, having them in fun shapes make it all the more fun.\nThese are great for parties, too. Both children and adults will smile at a tray of carrots shaped like stars or a cheese and cracker tray covered with cheddar flowers.', '2014-09-24 10:32:44');

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
  `avatar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `password`, `user_name`, `id`, `avatar_id`) VALUES
('namoo', 'naamoo', 'qaaaaz', 'naamoo', 1, 0),
('noaa', 'noaaa', '123', 'noaa', 2, 0),
('der', 'teri', '145', 'iserteri', 3, 0),
('gar', 'ghti', '1dd45', 'rin', 4, 0),
('', '', '', '', 5, 0),
('ha', 'ho', '123', 'he', 18, 0),
('nemo', 'keno', '123', 'usershemo', 19, 0),
('newo', 'keeno', '123', 'usereshemo', 21, 0),
('with password', 'keenopassword', '111123', 'usemo', 22, 0),
('with password', 'keenopassword', '111123', 'use2mo', 26, 0),
('withs string', 'string', '111123', 'string passw', 28, 0),
('withs string', 'string', 'aaaa', 'striddng passw', 30, 0),
('', 'string', 'aaaa', 'strpassw', 31, 0),
('userone', 'userone', '123', 'userone', 32, 0),
('userA', 'userA', '123', 'userA', 33, 0),
('userb', 'userb', '123', 'userb', 34, 0);

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
