-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2012 at 08:45 AM
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
  KEY `AwardTypeID` (`AwardTypeID`),
  KEY `QuestID` (`QuestID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_award`
--
ALTER TABLE `q_award`
  ADD CONSTRAINT `q_award_ibfk_3` FOREIGN KEY (`AwardTypeID`) REFERENCES `c_award_type` (`AwardTypeID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `q_award_ibfk_4` FOREIGN KEY (`QuestID`) REFERENCES `q_quest` (`QuestID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
