-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2012 at 05:21 AM
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
-- Table structure for table `q_award`
--

CREATE TABLE IF NOT EXISTS `q_award` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestID` int(11) NOT NULL,
  `AwardTypeID` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `QuestID` (`QuestID`),
  KEY `AwardTypeID` (`AwardTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `q_award`
--

INSERT INTO `q_award` (`ID`, `QuestID`, `AwardTypeID`, `Value`) VALUES
(2, 1, 2, 2),
(3, 2, 2, 1),
(4, 3, 2, 1),
(5, 4, 2, 1),
(6, 5, 2, 2),
(7, 6, 2, 2),
(8, 7, 2, 2),
(9, 8, 2, 2),
(10, 10, 2, 2),
(17, 1, 1, 0),
(18, 2, 1, 0),
(19, 3, 1, 0),
(20, 4, 1, 0),
(21, 5, 1, 0),
(22, 6, 1, 0),
(23, 7, 1, 0),
(24, 8, 1, 0),
(25, 10, 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_award`
--
ALTER TABLE `q_award`
  ADD CONSTRAINT `q_award_ibfk_5` FOREIGN KEY (`AwardTypeID`) REFERENCES `q_award_type` (`AwardTypeID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `q_award_ibfk_4` FOREIGN KEY (`QuestID`) REFERENCES `q_quest` (`QuestID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
