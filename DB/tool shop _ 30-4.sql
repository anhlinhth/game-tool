-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2012 at 06:05 AM
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
-- Table structure for table `s_ibshop`
--

CREATE TABLE IF NOT EXISTS `s_ibshop` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TabIndex` int(11) NOT NULL,
  `Resclass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_ibshop_item`
--

CREATE TABLE IF NOT EXISTS `s_ibshop_item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IbShopID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IbShopID` (`IbShopID`,`ItemID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_items`
--

CREATE TABLE IF NOT EXISTS `s_items` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameSV` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_itemshop`
--

CREATE TABLE IF NOT EXISTS `s_itemshop` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Entity` int(11) DEFAULT NULL,
  `Item` int(11) DEFAULT NULL,
  `Icon` varchar(25) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Kind` int(11) NOT NULL,
  `Level` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Entity` (`Entity`,`Item`,`Kind`),
  KEY `Item` (`Item`),
  KEY `Kind` (`Kind`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `s_itemshop_unblock`
--

CREATE TABLE IF NOT EXISTS `s_itemshop_unblock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemShopID` int(11) NOT NULL,
  `TypeUnblockID` int(11) NOT NULL,
  `Value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ItemShopID` (`ItemShopID`,`TypeUnblockID`),
  KEY `TypeUnblockID` (`TypeUnblockID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_shop`
--

CREATE TABLE IF NOT EXISTS `s_shop` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_shop_item`
--

CREATE TABLE IF NOT EXISTS `s_shop_item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ShopID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ShopID` (`ShopID`,`ItemID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_type_kind`
--

CREATE TABLE IF NOT EXISTS `s_type_kind` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_type_require`
--

CREATE TABLE IF NOT EXISTS `s_type_require` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_type_unblock`
--

CREATE TABLE IF NOT EXISTS `s_type_unblock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_version`
--

CREATE TABLE IF NOT EXISTS `s_version` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Version` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `s_ibshop_item`
--
ALTER TABLE `s_ibshop_item`
  ADD CONSTRAINT `s_ibshop_item_ibfk_1` FOREIGN KEY (`IbShopID`) REFERENCES `s_ibshop` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_ibshop_item_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `s_itemshop` (`ID`) ON DELETE NO ACTION;

--
-- Constraints for table `s_itemshop`
--
ALTER TABLE `s_itemshop`
  ADD CONSTRAINT `s_itemshop_ibfk_1` FOREIGN KEY (`Item`) REFERENCES `s_items` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_itemshop_ibfk_2` FOREIGN KEY (`Entity`) REFERENCES `s_items` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_itemshop_ibfk_3` FOREIGN KEY (`Kind`) REFERENCES `s_type_kind` (`ID`) ON DELETE NO ACTION;

--
-- Constraints for table `s_itemshop_require`
--
ALTER TABLE `s_itemshop_require`
  ADD CONSTRAINT `s_itemshop_require_ibfk_1` FOREIGN KEY (`TypeRequire`) REFERENCES `s_type_require` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_itemshop_require_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `s_itemshop` (`ID`) ON DELETE NO ACTION;

--
-- Constraints for table `s_itemshop_unblock`
--
ALTER TABLE `s_itemshop_unblock`
  ADD CONSTRAINT `s_itemshop_unblock_ibfk_1` FOREIGN KEY (`TypeUnblockID`) REFERENCES `s_type_unblock` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_itemshop_unblock_ibfk_2` FOREIGN KEY (`ItemShopID`) REFERENCES `s_itemshop` (`ID`) ON DELETE NO ACTION;

--
-- Constraints for table `s_shop_item`
--
ALTER TABLE `s_shop_item`
  ADD CONSTRAINT `s_shop_item_ibfk_1` FOREIGN KEY (`ShopID`) REFERENCES `s_shop` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `s_shop_item_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `s_itemshop` (`ID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
