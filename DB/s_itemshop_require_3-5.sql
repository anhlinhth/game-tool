-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2012 at 12:01 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testthao`
--

-- --------------------------------------------------------

--
-- Table structure for table `s_itemshop_require`
--

CREATE TABLE IF NOT EXISTS `s_itemshop_require` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemShopID` int(11) NOT NULL,
  `TypeRequire` int(11) NOT NULL,
  `Value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ItemShopID` (`ItemShopID`,`TypeRequire`),
  KEY `TypeRequire` (`TypeRequire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `s_itemshop_require`
--
ALTER TABLE `s_itemshop_require`
  ADD CONSTRAINT `s_itemshop_require_ibfk_2` FOREIGN KEY (`ItemShopID`) REFERENCES `s_itemshop` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_itemshop_require_ibfk_1` FOREIGN KEY (`TypeRequire`) REFERENCES `s_type_require` (`ID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
