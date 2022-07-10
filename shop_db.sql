-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2021 at 02:51 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pro_code` int(10) NOT NULL,
  `pro_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `pro_qty` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `pro_price` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `pro_image` varchar(80) COLLATE utf8_persian_ci DEFAULT NULL,
  `pro_detail` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`pro_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_code`, `pro_name`, `pro_qty`, `pro_price`, `pro_image`, `pro_detail`) VALUES
(1, 'شیرنی وانیلی خوشمزه', '10', '50000', 'gallery-img-2.jpeg', 'شیرینی خیلی خوشمزه وانیلی این شیرینی بسیار خوش مزه و خوش طعم را با تخفیف نوش جان کنید'),
(2, 'پیتزا ', '40', '50000', 'img14.jpeg', 'پیتزا خونگی '),
(3, 'گوشت', '50', '80000', 'gallery-img-4.jpeg', 'گوشت خوشمزه ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(1) NOT NULL AUTO_INCREMENT,
  `realName` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `userName` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `realName`, `userName`, `password`, `email`, `type`) VALUES
(1, 'ehsan', 'ehs.tb', '123', 'ehsanlevelmax@gmail.com', 0),
(2, 'ehsan', 'program', '5288', 'ehsanlevelmax@gmail.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
