-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2012 at 11:44 AM
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
-- Table structure for table `c_award`
--

CREATE TABLE IF NOT EXISTS `c_award` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BattleID` int(11) NOT NULL,
  `AwardTypeID` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `BattleID` (`BattleID`,`AwardTypeID`),
  KEY `AwardType` (`AwardTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_award_type`
--

CREATE TABLE IF NOT EXISTS `c_award_type` (
  `AwardTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`AwardTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `c_award_type`
--

INSERT INTO `c_award_type` (`AwardTypeID`, `Name`) VALUES
(1, 'Gold'),
(2, 'Exp'),
(3, 'Item'),
(4, 'Iron'),
(5, 'Wood');

-- --------------------------------------------------------

--
-- Table structure for table `c_backup`
--

CREATE TABLE IF NOT EXISTS `c_backup` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateTime` datetime NOT NULL,
  `Link` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_battle`
--

CREATE TABLE IF NOT EXISTS `c_battle` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Layout` int(11) NOT NULL,
  `Order` int(11) DEFAULT NULL,
  `Campaign` int(11) NOT NULL,
  `Temp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Layout` (`Layout`,`Order`),
  KEY `Campaign` (`Campaign`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_battle_soldier`
--

CREATE TABLE IF NOT EXISTS `c_battle_soldier` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BattleID` int(11) NOT NULL,
  `Point` int(11) NOT NULL,
  `Soldier` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `Temp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `BattleID` (`BattleID`,`Soldier`),
  KEY `Soldier` (`Soldier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_campaign`
--

CREATE TABLE IF NOT EXISTS `c_campaign` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `WorldMap` int(11) DEFAULT NULL,
  `TypeID` int(11) DEFAULT NULL,
  `NeedCamp` int(11) DEFAULT NULL,
  `Temp` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `WorldMap` (`WorldMap`),
  KEY `TypeID` (`TypeID`),
  KEY `NeedCamp` (`NeedCamp`),
  KEY `TypeID_2` (`TypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_layout`
--

CREATE TABLE IF NOT EXISTS `c_layout` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Point` varchar(20) NOT NULL,
  `Temp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `c_layout`
--

INSERT INTO `c_layout` (`ID`, `Name`, `Point`, `Temp`) VALUES
(1, 'T', '[1,1,1,0,1,0,0,1,0]', NULL),
(2, '+', '[0,1,0,1,1,1,0,1,0]', NULL),
(3, 'X', '[1,0,1,0,1,0,1,0,1]', NULL),
(7, 'V', '[0,1,0,1,0,1,1,0,1]', NULL),
(8, 'Z', '[0,0,1,1,1,1,1,0,0]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `c_nextcamp`
--

CREATE TABLE IF NOT EXISTS `c_nextcamp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CampID` int(11) NOT NULL,
  `NextCamp` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `CampID` (`CampID`,`NextCamp`),
  KEY `NextCamp` (`NextCamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_soldier`
--

CREATE TABLE IF NOT EXISTS `c_soldier` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Temp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameSV` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_soldier`
--

INSERT INTO `c_soldier` (`ID`, `Name`, `Temp`, `NameSV`) VALUES
(15001, 'Công bộ', NULL, 'SOLDIER_ENEMY_NORMAL_1'),
(15002, 'Thiết bộ', NULL, 'SOLDIER_ENEMY_NORMAL_2'),
(15003, 'Thủ bộ', NULL, 'SOLDIER_ENEMY_NORMAL_3'),
(15004, 'Ngưu bộ', NULL, 'SOLDIER_ENEMY_NORMAL_4'),
(15005, 'Thạch bộ', NULL, 'SOLDIER_ENEMY_NORMAL_5'),
(15006, 'Sát bộ', NULL, 'SOLDIER_ENEMY_NORMAL_6'),
(15007, 'Di bộ', NULL, 'SOLDIER_ENEMY_NORMAL_7'),
(15008, 'Tấn bộ', NULL, 'SOLDIER_ENEMY_NORMAL_8'),
(15009, 'Trung bộ', NULL, 'SOLDIER_ENEMY_NORMAL_9'),
(15010, 'Hoành bộ', NULL, 'SOLDIER_ENEMY_ROW_1'),
(15011, 'Tung bộ', NULL, 'SOLDIER_ENEMY_COL_1'),
(15012, 'Toàn bộ', NULL, 'SOLDIER_ENEMY_ALL_1'),
(15013, 'Công kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_10'),
(15014, 'Thiết kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_11'),
(15015, 'Thủ kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_12'),
(15016, 'Ngưu kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_13'),
(15017, 'Thạch kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_14'),
(15018, 'Sát kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_15'),
(15019, 'Di kỵ', '', 'SOLDIER_ENEMY_NORMAL_16'),
(15020, 'Tấn kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_17'),
(15021, 'Trung kỵ', NULL, 'SOLDIER_ENEMY_NORMAL_18'),
(15022, 'Hoành kỵ', NULL, 'SOLDIER_ENEMY_ROW_2'),
(15023, 'Tung kỵ', NULL, 'SOLDIER_ENEMY_COL_2'),
(15024, 'Toàn kỵ', NULL, 'SOLDIER_ENEMY_ALL_2'),
(15025, 'Công pháo', NULL, 'SOLDIER_ENEMY_NORMAL_19'),
(15026, 'Thiết pháo', NULL, 'SOLDIER_ENEMY_NORMAL_20'),
(15027, 'Thủ pháo', NULL, 'SOLDIER_ENEMY_NORMAL_21'),
(15028, 'Ngưu pháo', NULL, 'SOLDIER_ENEMY_NORMAL_22'),
(15029, 'Thạch pháo', NULL, 'SOLDIER_ENEMY_NORMAL_23'),
(15030, 'Sát pháo', NULL, 'SOLDIER_ENEMY_NORMAL_24'),
(15031, 'Di pháo', NULL, 'SOLDIER_ENEMY_NORMAL_25'),
(15032, 'Tấn pháo', NULL, 'SOLDIER_ENEMY_NORMAL_26'),
(15033, 'Trung pháo', NULL, 'SOLDIER_ENEMY_NORMAL_27'),
(15034, 'Hoành pháo', NULL, 'SOLDIER_ENEMY_ROW_3'),
(15035, 'Tung pháo', NULL, 'SOLDIER_ENEMY_COL_3'),
(15036, 'Toàn pháo', NULL, 'SOLDIER_ENEMY_ALL_3');

-- --------------------------------------------------------

--
-- Table structure for table `c_typemap`
--

CREATE TABLE IF NOT EXISTS `c_typemap` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `c_worldmap`
--

CREATE TABLE IF NOT EXISTS `c_worldmap` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `c_award`
--
ALTER TABLE `c_award`
  ADD CONSTRAINT `c_award_ibfk_1` FOREIGN KEY (`BattleID`) REFERENCES `c_battle` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `c_award_ibfk_2` FOREIGN KEY (`AwardTypeID`) REFERENCES `c_award_type` (`AwardTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `c_battle`
--
ALTER TABLE `c_battle`
  ADD CONSTRAINT `c_battle_ibfk_1` FOREIGN KEY (`Layout`) REFERENCES `c_layout` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `c_battle_ibfk_2` FOREIGN KEY (`Campaign`) REFERENCES `c_campaign` (`ID`) ON DELETE NO ACTION;

--
-- Constraints for table `c_battle_soldier`
--
ALTER TABLE `c_battle_soldier`
  ADD CONSTRAINT `c_battle_soldier_ibfk_1` FOREIGN KEY (`BattleID`) REFERENCES `c_battle` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `c_battle_soldier_ibfk_2` FOREIGN KEY (`Soldier`) REFERENCES `c_soldier` (`ID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
