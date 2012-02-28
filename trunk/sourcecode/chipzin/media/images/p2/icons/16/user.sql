-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2012 at 11:03 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `supportchipzin`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `active`, `created_date`, `group_id`) VALUES
(1, 'admin', 'admin', '61bd60c60d9fb60cc8fc7767669d40a1', 1, '0000-00-00 00:00:00', 1),
(13, 'kietma', 'Mai Anh Kiệt', 'e10adc3949ba59abbe56e057f20f883e', 1, '0000-00-00 00:00:00', 4),
(14, 'chilh', 'La Hồng Chi', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', 2),
(15, 'tutn', 'Trần Ngọc Tú', 'ac3ee64b7a3f3e1a740cb04ce72fe3df', 0, '0000-00-00 00:00:00', 2),
(18, 'vinhmq', 'Vinh, Mai Quang', '202cb962ac59075b964b07152d234b70', 0, '0000-00-00 00:00:00', 2),
(19, 'chaulth', 'Lê Thái Hoàng Châu', '202cb962ac59075b964b07152d234b70', 0, '0000-00-00 00:00:00', 2),
(20, 'dinhlhn', 'Lâm Hữu Nguyễn Đỉnh', 'e10adc3949ba59abbe56e057f20f883e', 1, '2011-08-31 10:28:19', 4),
(21, 'minhvh', 'Võ Hồng Minh', '6b78394d85a4ba80118ca2e6a7a75b53', 1, '2011-10-03 16:22:02', 4),
(22, 'vantvt', 'Trương Vũ Trường Văn', 'af129c42c468b65e5bc80818c0d0c726', 0, '0000-00-00 00:00:00', 2),
(23, 'trucntt', 'Nguyễn Thị Thanh Trúc', '6aa6bd3ad42c8b4f317ceac8b9421386', 1, '2011-11-17 11:09:38', 2),
(24, 'quyenlb', 'Liên Bích Quyên', '76419c58730d9f35de7ac538c2fd6737', 1, '0000-00-00 00:00:00', 4),
(26, 'uyenlnk', 'Lưu Ngọc Kim Uyên', 'ae2152dcbb7a029f118b20b3806c3643', 0, '0000-00-00 00:00:00', 4),
(28, 'truongnt', 'Nguyễn Thanh Trường', 'f48cbd6ce3a8dba5f7fd59e90e0c187e', 1, '2012-02-14 10:31:03', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
