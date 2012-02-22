-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2012 at 02:25 AM
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
-- Table structure for table `q_quest`
--

CREATE TABLE IF NOT EXISTS `q_quest` (
  `QuestID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QuestGroupString` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QuestGroup` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QuestString` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QuestDesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `QuestDescString` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AwardGold` int(11) DEFAULT NULL,
  `AwardExp` int(11) DEFAULT NULL,
  `NextQuest` int(11) DEFAULT NULL,
  `QuestLineID` int(11) DEFAULT NULL,
  PRIMARY KEY (`QuestID`),
  KEY `QuestLineID` (`QuestLineID`),
  KEY `NextQuest` (`NextQuest`,`QuestLineID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `q_quest`
--

INSERT INTO `q_quest` (`QuestID`, `QuestName`, `QuestGroupString`, `QuestGroup`, `QuestString`, `QuestDesc`, `QuestDescString`, `AwardGold`, `AwardExp`, `NextQuest`, `QuestLineID`) VALUES
(2, 'Ngôi nhà hoa hồng ', '@quest#1 ', 'Hoà nhập (Nhiệm vụ 1/10) ', '@quest#2 ', 'Không biết phải làm gì trong đây', '@quest#500 ', 1, 2, 2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_quest`
--
ALTER TABLE `q_quest`
  ADD CONSTRAINT `q_quest_ibfk_2` FOREIGN KEY (`NextQuest`) REFERENCES `q_quest` (`QuestID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `q_quest_ibfk_1` FOREIGN KEY (`QuestLineID`) REFERENCES `q_questline` (`QuestLineID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
