-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2022 at 01:02 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `morocco_travel_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_info`
--

DROP TABLE IF EXISTS `additional_info`;
CREATE TABLE IF NOT EXISTS `additional_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address1` text,
  `address2` text,
  `phoneNbr` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `codePostal` int NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dd` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `additional_info`
--

INSERT INTO `additional_info` (`id`, `user_id`, `first_name`, `last_name`, `address1`, `address2`, `phoneNbr`, `city`, `codePostal`, `country`) VALUES
(4, 7, 'ff', 'd', 'omuzhfosih', '', ' 212/34566121', 'tanger', 900000, 'tanger'),
(5, 1, 'mohammed', 'Chbani', 'qdqsd', '', ' 212/34566121', 'ssslll', 90000, 'morocco');

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

DROP TABLE IF EXISTS `booked`;
CREATE TABLE IF NOT EXISTS `booked` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_trip` int NOT NULL,
  `id_user` int NOT NULL,
  `qte` int NOT NULL,
  `prixForOne` float NOT NULL,
  `tatalPaid` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_trip` (`id_trip`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `id_trip`, `id_user`, `qte`, `prixForOne`, `tatalPaid`, `date`) VALUES
(51, 6, 18, 1, 90.25, 100.25, '2022-03-04 00:59:52'),
(50, 1, 18, 7, 90.25, 641.75, '2022-03-04 00:46:01'),
(49, 4, 7, 133, 90.25, 12013.2, '2022-03-03 17:03:36'),
(48, 1, 7, 1, 90.25, 100.25, '2022-03-03 16:08:31'),
(47, 1, 7, 3, 90.25, 280.75, '2022-03-03 15:47:38'),
(46, 5, 7, 5, 90.25, 461.25, '2022-03-03 15:47:38'),
(45, 6, 7, 2, 90.25, 190.5, '2022-03-03 15:30:23'),
(44, 2, 2, 4, 90.25, 371, '2022-02-27 15:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `holder_name` varchar(50) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiration_date` varchar(11) NOT NULL,
  `cvv` int NOT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `holder_name`, `card_number`, `expiration_date`, `cvv`, `id_user`) VALUES
(1, 'mohammed achbani', '1111222233334444', '12/34', 123, 1),
(2, 'L%KJN', '1231231231234412', '02/33', 123, 1),
(3, 'OUHUKLJDF', '1231321231231231', '12/31', 123, 1),
(4, 'oiqdjfoizqdsj', '1231231232123123', '12/32', 123, 1),
(5, '123123123', '1231231231231231', '12/31', 123, 1),
(6, 'mohamedachbai', '6253142422134891', '06/32', 123, 1),
(7, 'sjkjefdn', '3987259782879349', '02/34', 423, 1),
(8, 'IJFSDIOQSM', '1231231223311231', '12/32', 123, 1),
(9, 'SDLFKJ', '1231212312312312', '12/32', 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trip_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `trip_id` (`trip_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `type` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `type`, `subject`, `message`, `date`) VALUES
(3, 'mohammed chbani ', 'moha@gmail.com', 'problem', 'i want go sleep', 'im tired', '2022-03-03 22:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `img_trips`
--

DROP TABLE IF EXISTS `img_trips`;
CREATE TABLE IF NOT EXISTS `img_trips` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_trip` int NOT NULL,
  `img` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_trip` (`id_trip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `trip_id` int NOT NULL AUTO_INCREMENT,
  `destination` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `max_persone` int NOT NULL,
  `img` text NOT NULL,
  `time_depart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trip_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `destination`, `description`, `price`, `max_persone`, `img`, `time_depart`) VALUES
(1, 'marakech', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, nam!', 90.25, 200, 'IMG/marakech.jpg', '2022-02-18 09:52:40'),
(2, 'fes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, nam!', 90.25, 200, 'IMG/fes.jpg', '2022-02-18 09:53:43'),
(3, 'Rabat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, nam!', 90.25, 200, 'IMG/rabat.jpg', '2022-02-18 09:54:23'),
(4, 'Chefchoun', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, nam!', 90.25, 200, 'IMG/chefchoun.jpg', '2022-02-18 09:55:09'),
(5, 'Dakhla', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, nam!', 90.25, 200, 'IMG/dakhla.jpg', '2022-02-18 09:55:48'),
(6, 'Merzouja', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, nam!', 90.25, 200, 'IMG/merzouja.jpg', '2022-02-18 09:56:30'),
(11, 'lkjkhjkl', 'sùldkfjl', 57, 200, 'IMG/8ed0b2916f104733ea9e3eeeb410ba08.png', '2022-02-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '1',
  `sign_up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pwd`, `admin`, `sign_up_date`, `img`) VALUES
(1, 'AAA', 'moaha@gmail.com', '$2y$10$0.879qyEizb4ZzWeagpH2OIPbUGn/w4q5MRTjVv8E9sBsbXKlp1yW', 1, '2022-02-11 20:12:16', 'uplaodedImg/pexels-valdemaras-d-1647962.jpg'),
(7, 'AAAA', 'chbani@gmail.com', '$2y$10$wMjwFF7ByobosHruEVfZfOLPlHXa8pBOU7i.LeTifR0cmdU20/Dta', 0, '2022-03-03 13:26:59', 'uplaodedImg/Screen Shot 2022-01-11 at 9.18.17 PM.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
