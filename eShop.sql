-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2014 at 05:38 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `total_price`, `completed`, `transaction_time`) VALUES
(4, 1, 160, 1, NULL),
(5, 1, 670, 0, NULL),
(6, 2, 96, 1, '2014-09-26 12:41:25'),
(7, 2, 8, 1, '2014-09-26 14:28:29'),
(8, 2, 8, 1, '2014-09-26 14:29:02'),
(9, 2, 8, 1, '2014-09-26 14:36:32'),
(10, 2, 8, 1, '2014-09-26 15:52:53'),
(11, 2, 8, 1, '2014-09-26 15:55:20'),
(12, 2, 32, 1, '2014-09-26 15:57:06'),
(13, 2, 8, 1, '2014-09-26 15:57:38'),
(14, 2, 16, 1, '2014-09-26 15:58:08'),
(15, 2, 8, 1, '2014-09-26 16:13:58'),
(16, 2, 8, 1, '2014-09-26 19:00:25');

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

--
-- Dumping data for table `carts_products`
--

INSERT INTO `carts_products` (`cart_id`, `product_id`, `quantity`, `item_price`) VALUES
(4, 6, 10, 10),
(4, 1, 5, 12),
(5, 2, 5, 134),
(6, 1, 10, 10),
(7, 4, 1, 8),
(8, 5, 1, 8),
(9, 4, 1, 8),
(10, 4, 1, 8),
(11, 4, 1, 8),
(12, 4, 4, 8),
(13, 5, 1, 8),
(14, 5, 2, 8),
(15, 6, 1, 8),
(16, 6, 1, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `discount`, `stock`, `average_rating`, `image_link`, `category`, `added_time`) VALUES
(1, 'Zombie Fluxx', '', 12, 20, 0, 3, 'product1', 'Electronics', '2014-09-22 14:23:04'),
(2, 'Monty Python Fluxx', '', 134, 20, 0, 1, 'product2', 'Electronics', '2014-09-22 14:23:15'),
(3, 'Pirate Fluxx - The Ever Changing Pirate Card Game.', '', 443, 20, 0, 2, 'product3', 'Electronics', '2014-09-22 14:23:25'),
(4, 'Cthulhu Fluxx', '', 10, 20, 0, 5, 'product4', 'Electronics', '2014-09-23 12:34:12'),
(5, 'Star Fluxx Robo-Doc / Android Doctor Promo Game Ca', '', 10, 20, 0, 2, 'product5', 'Electronics', '2014-09-23 12:34:18'),
(6, 'Star Fluxx The Ever Changing Card Game... In Space', '', 10, 20, 2, 6, 'product6', 'Electronics', '2014-09-23 12:34:21'),
(7, 'Trofeo Monza Men''s Road/Racing', 'Fuji collapsible/folding bike. It is a special edition MARLBORO bike given out during a promotion in the 80''s I believe. Has a few scratches and scuffs and definitely shows wear from age and use. There is some surface rust in areas, especially on the seat post. The bike collapses with ease. It basically folds in half', 169, 10, 5, 3, 'product7', 'Electronics', '2014-09-26 17:44:35'),
(8, 'fitbit zip Activity Tracker', 'This is a factory sealed unopened fitbit zip.\r\n\r\nWhat''s included: Tracker, Clip, Battery, Wireless USB dongle, Battery tool, Free Fitbit Account. \r\n\r\n It is also compatible with Windows XP, and Mac OS 10.5.\r\n\r\n It Syncs with iPhone 4S, and Bluetooth 4.0 or Bluetooth Smart Ready devices.', 120, 0, 12, 3, 'fitbit', 'Electronics', '2014-09-26 17:44:35'),
(9, 'HTC-One-X-16GB-', 'Bedienung über Touchscreen, Digitaler Pegelmesser, AF-Sperre, GPS-fähig, USB 2.0-Kompatibilität, Auto Lighting Optimiser, Chromatic Aberration Compensation (CAC), Gesichtserkennung, digitale Bildrotation, RGB-Primärfarbfilter, Eye-Fi-Karte möglich, RAW-Bearbeitung in Kamera, Multiframe-Rauschreduzierung, Exif Print-Unterstützung, LCD-M', 124, 12, 12, 4, 'htc', 'Electronics', '2014-09-26 17:51:40'),
(10, 'Canon EOS 70D 20,0 MP Digitalkamera', 'LCD-Monitor mit Live-Bild-Modus, 1080p Full HD-Filmaufnahme, Helligkeitsregelung der Anzeige, Highlight Point Display, Scene Intelligent Auto-Technologie, direkt Druck, Erkennung der Kameraausrichtung, AE-Schloss, DPOF Support, Schärfentiefekontrolle,', 949, 40, 15, 3, 'canon', 'Electronics', '2014-09-26 17:51:40'),
(11, 'Apple iPhone 5S', '', 5499, 10, 10, 0, 'iphone', 'electronics', '2014-09-27 02:36:17'),
(12, 'Apple iPad Air', '', 5151, 10, 7, 0, 'ipad', 'electronics', '2014-09-27 02:36:17'),
(13, 'Apple Macbook Air', '', 10000, 10, 12, 0, 'macbookair', 'electronics', '2014-09-27 02:36:17'),
(14, 'Apple MacBook Pro With Retina Display', '', 23899, 10, 3, 0, 'macbookpro', 'electronics', '2014-09-27 02:36:17'),
(15, 'Apple iPhone Bluetooth', '', 138, 10, 25, 0, 'iphonebluetooth', 'electronics', '2014-09-27 02:36:17'),
(16, '85W Adapter Power Charger for Apple MacBook Pro', '', 450, 10, 9, 0, 'charger', 'electronics', '2014-09-27 02:36:17'),
(17, 'Apple Magic Mouse', '', 699, 10, 1, 0, 'mouse', 'electronics', '2014-09-27 02:36:17'),
(18, 'Apple Earpods With Remote And Mic', '', 45, 10, 0, 0, 'earpods', 'electronics', '2014-09-27 02:36:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `password`, `user_name`, `id`, `avatar_id`) VALUES
('namoo', 'naamoo', 'qaaaaz', 'naamoo', 1, 1),
('noaa', 'noaaa', '123', 'noaa', 2, 1),
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
('userb', 'userb', '123', 'userb', 34, 0),
('', '', '', 'noaad', 35, 0),
('', '', '', 'noaazzzz', 36, 0);

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
