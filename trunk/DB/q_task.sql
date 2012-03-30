-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2012 at 05:09 AM
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
  `Counter` int(1) NOT NULL,
  PRIMARY KEY (`TaskID`),
  KEY `QuestID` (`QuestID`),
  KEY `QTC_ID` (`QTC_ID`,`ActionID`,`QuestID`),
  KEY `ActionID` (`ActionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `q_task`
--

INSERT INTO `q_task` (`TaskID`, `TaskName`, `TaskString`, `DescID`, `DescString`, `QTC_ID`, `UnlockCoin`, `IconClassName`, `IconPackageName`, `Quantity`, `ActionID`, `QuestID`, `TargetType`, `Counter`) VALUES
(7, 'Xây thêm 1 Ô đất', '@quest#49', '@quest#51', 'ưeqweqw', 4, 1, 'sample', 'sample', 1, 1, 1, NULL, 0),
(9, 'Gieo trồng 1 vụ Lúa', '@quest#50', '@quest#52', '', 13, 1, 'sample', 'sample', 1, 1001, 1, NULL, 0),
(10, 'Thu hoạch 1 Lúa ', '@quest#56 ', '@quest#57', '', 7, 1, NULL, NULL, 1, 1002, 2, NULL, 0),
(11, 'Thu thuế 1 nhà Dân', '@quest#61', '@quest#62', '', 8, 1, NULL, NULL, 1, 3, 3, NULL, 0),
(12, 'Xây 1 nhà Cỏ tranh', '@quest#66', '@quest#67', '', 4, 1, NULL, NULL, 1, 1, 4, NULL, 0),
(13, 'Xây 1 nhà đào tạo dân công ', '@quest#71', '@quest#72', '', 4, 1, NULL, NULL, 1, 1, 5, NULL, 0),
(14, 'Đào tạo 1 Dân công ', '@quest#76 ', '@quest#77', '', 5, 1, NULL, NULL, 1, 4003, 6, 0, 0),
(15, 'Xây 1 Trại gỗ ', '@quest#81 ', '@quest#82', '', 4, 1, NULL, NULL, 1, 1, 7, NULL, 0),
(16, 'Thu hoạch 1 gỗ Mít', '@quest#87', '@quest#89', '', 11, 1, NULL, NULL, 1, 1002, 8, NULL, 0),
(18, 'Sản xuất 1 gỗ Mít', '@quest#86', '@quest#87', '', 14, 1, NULL, NULL, 1, 1001, 7, NULL, 0),
(20, 'Di chuyển 1 ô đất', '@quest#98', '@quest#100', '', 12, 1, NULL, NULL, 1, 2, 10, NULL, 0),
(21, 'Bán 1 ô đất', '@quest#99', '@quest#101', '', 16, 1, NULL, NULL, 1, 8, 10, NULL, 0);

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
