-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2012 at 04:53 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `p2`
--

-- --------------------------------------------------------

--
-- Table structure for table `q_questline`
--

CREATE TABLE IF NOT EXISTS `q_questline` (
  `QuestLineID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestLineName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `QuestLineIcon` int(11) NOT NULL,
  PRIMARY KEY (`QuestLineID`),
  UNIQUE KEY `QuestLineName` (`QuestLineName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `q_questline`
--

INSERT INTO `q_questline` (`QuestLineID`, `QuestLineName`, `QuestLineIcon`) VALUES
(7, 'Quest Tân thủ2', 53),
(9, '23', 23);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
