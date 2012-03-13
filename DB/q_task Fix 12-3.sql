-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2012 at 08:03 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `q_task`
--

CREATE TABLE IF NOT EXISTS `q_task` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TaskString` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DescID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DescString` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QTC_ID` int(11) DEFAULT NULL,
  `UnlockCoin` int(11) NOT NULL,
  `IconClassName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IconPackageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `ActionID` int(11) NOT NULL,
  `QuestID` int(11) NOT NULL,
  `TargetType` int(11) DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  KEY `QuestID` (`QuestID`),
  KEY `QTC_ID` (`QTC_ID`,`ActionID`,`QuestID`),
  KEY `ActionID` (`ActionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_task`
--
ALTER TABLE `q_task`
  ADD CONSTRAINT `q_task_ibfk_1` FOREIGN KEY (`QuestID`) REFERENCES `q_quest` (`QuestID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `q_task_ibfk_2` FOREIGN KEY (`QTC_ID`) REFERENCES `q_questtaskclient` (`QTC_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `q_task_ibfk_3` FOREIGN KEY (`ActionID`) REFERENCES `q_action` (`ActionID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;