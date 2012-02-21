-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2012 at 04:40 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `utit`
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
  `QTC_ID` int(11) DEFAULT NULL,
  `UnlockCoin` int(11) DEFAULT NULL,
  `IconClassName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `ActionID` int(11) DEFAULT NULL,
  `QuestID` int(11) DEFAULT NULL,
  `TargetID` int(11) DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  KEY `QuestID` (`QuestID`),
  KEY `QTC_ID` (`QTC_ID`,`ActionID`,`QuestID`),
  KEY `ActionID` (`ActionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `q_task`
--

INSERT INTO `q_task` (`TaskID`, `TaskName`, `TaskString`, `DescID`, `QTC_ID`, `UnlockCoin`, `IconClassName`, `Quantity`, `ActionID`, `QuestID`, `TargetID`) VALUES
(2, 'Xây thêm 1 Nhà Cỏ tranh ', '@quest#3 ', '@quest#3 ', 1, 3, 'sample', 1, 1, 2, 2004);

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
