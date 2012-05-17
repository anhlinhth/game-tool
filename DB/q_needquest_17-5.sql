-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2012 at 06:48 AM
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
-- Table structure for table `q_needquest`
--

CREATE TABLE IF NOT EXISTS `q_needquest` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestID` int(11) NOT NULL,
  `NeedQuest` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `QuestID` (`QuestID`,`NeedQuest`),
  KEY `NeedQuest` (`NeedQuest`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_needquest`
--
ALTER TABLE `q_needquest`
  ADD CONSTRAINT `q_needquest_ibfk_2` FOREIGN KEY (`NeedQuest`) REFERENCES `q_quest` (`QuestID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `q_needquest_ibfk_1` FOREIGN KEY (`QuestID`) REFERENCES `q_quest` (`QuestID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
