-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2019 at 04:41 PM
-- Server version: 5.7.24
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_manufacturer_models` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id_color` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `price` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkk_manufacturer_models_id_idx` (`id_manufacturer_models`),
  KEY `fkk_id_color_idx` (`id_color`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `id_manufacturer_models`, `year`, `date`, `id_color`, `km`, `state`, `price`) VALUES
(32, 20, 2007, '2019-07-15 02:53:45', 2, 130, 1, 20000),
(33, 25, 2005, '2019-07-15 02:55:31', 4, 190, 1, 15000),
(34, 25, 2005, '2019-07-15 02:58:19', 3, 190, 1, 15000),
(35, 16, 2006, '2019-07-15 02:58:54', 1, 40, 1, 15000),
(36, 19, 2005, '2019-07-15 02:59:31', 2, 10, 1, 20000),
(37, 15, 2007, '2019-07-15 03:00:11', 2, 10, 1, 10000),
(38, 13, 2005, '2019-07-16 14:54:34', 1, 10, 0, 5000),
(39, 15, 2005, '2019-07-16 14:56:08', 1, 10, 0, 5000),
(40, 25, 2007, '2019-07-16 14:57:10', 4, 10, 0, 4000),
(41, 25, 2007, '2019-07-16 15:00:51', 4, 10, 0, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`) VALUES
(1, 'red'),
(2, 'blue'),
(3, 'green'),
(4, 'white'),
(5, 'black'),
(6, 'silver');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `manufacturer`) VALUES
(2, 'BMW'),
(10, 'Audi'),
(11, 'Mercedes-Benz');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_models`
--

DROP TABLE IF EXISTS `manufacturer_models`;
CREATE TABLE IF NOT EXISTS `manufacturer_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) NOT NULL,
  `id_manufacturer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkk_id_manufacturer_idx` (`id_manufacturer`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturer_models`
--

INSERT INTO `manufacturer_models` (`id`, `model`, `id_manufacturer`) VALUES
(13, 'X4', 2),
(14, 'X5', 2),
(15, 'X6', 2),
(16, 'Q5', 2),
(18, 'A3', 10),
(19, 'A4', 10),
(20, 'A5', 10),
(21, 'A6', 10),
(22, 'A8', 10),
(23, 'A-Class', 11),
(24, 'B-Class', 11),
(25, 'C-Class', 11),
(26, 'D-Class', 11);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pictures` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `id_cars` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkk_id_cars_idx` (`id_cars`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `pictures`, `status`, `id_cars`) VALUES
(23, '2.jpg', 0, 32),
(24, '4.jpg', 0, 33),
(25, '1563152299_4.jpg', 0, 34),
(26, '1563152334_3.jpg', 0, 35),
(27, '1563152371_1.jpg', 0, 36),
(28, '1563152411_6.jpg', 0, 37),
(29, '1563281674_6.jpg', 0, 38),
(30, '1563281768_6.jpg', 0, 39),
(31, '1563281830_1.jpg', 0, 40),
(32, '1563282051_1.jpg', 0, 41);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `id_role` int(11) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkk_id_role_idx` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `id_role`, `password`) VALUES
(1, 'Tamara', 'Vasic', 'taki@gmail.com', 'tamara', 2, '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Ivana', 'Petrovic', 'ivana@gmail.com', 'admin', 1, '21232f297a57a5a743894a0e4a801fc3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fkk_id_color` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkk_manufacturer_models_id` FOREIGN KEY (`id_manufacturer_models`) REFERENCES `manufacturer_models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `manufacturer_models`
--
ALTER TABLE `manufacturer_models`
  ADD CONSTRAINT `fkk_id_manufacturer` FOREIGN KEY (`id_manufacturer`) REFERENCES `manufacturers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fkk_id_cars` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fkk_id_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
