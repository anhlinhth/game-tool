-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2012 at 06:33 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `supportchipzin1`
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
  `AwardGold` int(11) NOT NULL,
  `AwardExp` int(11) NOT NULL,
  `NextQuest` int(11) DEFAULT NULL,
  `QuestLineID` int(11) NOT NULL,
  PRIMARY KEY (`QuestID`),
  KEY `QuestLineID` (`QuestLineID`),
  KEY `NextQuest` (`NextQuest`,`QuestLineID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `q_quest`
--

INSERT INTO `q_quest` (`QuestID`, `QuestName`, `QuestGroupString`, `QuestGroup`, `QuestString`, `QuestDesc`, `QuestDescString`, `AwardGold`, `AwardExp`, `NextQuest`, `QuestLineID`) VALUES
(1, 'Ngôi nhà hoa hồng ', '@quest#1 ', 'Hoà nhập (Nhiệm vụ 1/10) ', '@quest#2 ', NULL, '@quest#500 ', 50, 3, NULL, 2),
(2, 'Vụ mùa đầu tiên ', '@quest#4 ', 'Hoà nhập (Nhiệm vụ 2/10) ', '@quest#5 ', NULL, '@quest#502 ', 50, 3, NULL, 2),
(3, 'Làm mới nông trại ', '@quest#7 ', 'Hoà nhập (Nhiệm vụ 3/10) ', '@quest#8 ', NULL, '@quest#504 ', 50, 3, NULL, 2),
(4, 'Người bạn mới ', '@quest#10 ', 'Hoà nhập (Nhiệm vụ 4/10) ', '@quest#11 ', NULL, '@quest#506 ', 50, 3, NULL, 2),
(5, 'Phát triển sản xuất ', '@quest#13 ', 'Hoà nhập (Nhiệm vụ 5/10) ', '@quest#14 ', NULL, '@quest#508 ', 50, 5, NULL, 2),
(6, 'Xây thêm nhà mới ', '@quest#18 ', 'Hoà nhập (Nhiệm vụ 6/10) ', '@quest#19 ', NULL, '@quest#512 ', 50, 5, NULL, 2),
(7, 'Lót gạch vườn xuân ', '@quest#23 ', 'Hoà nhập (Nhiệm vụ 7/10) ', '@quest#24 ', NULL, '@quest#516 ', 50, 10, NULL, 2),
(8, 'Tăng dân xây trại ', '@quest#28', 'Hoà nhập (Nhiệm vụ 8/10)', '@quest#29 ', NULL, '@quest#520 ', 50, 10, NULL, 2),
(9, 'Đẩy mạnh nhân lực ', '@quest#33 ', 'Hoà nhập (Nhiệm vụ 9/10) ', '@quest#34 ', NULL, '@quest#524 ', 500, 20, NULL, 2),
(10, 'Cà chua chín đỏ ', '@quest#38 ', 'Hoà nhập (Nhiệm vụ 10/10) ', '@quest#39 ', NULL, '@quest#528 ', 70, 15, NULL, 2),
(11, 'Gỗ về làng\n ', '@quest#43\n', 'Miền đất hứa (Nhiệm vụ 1/10)\n ', '@quest#44\n ', NULL, '@quest#532\n ', 70, 15, NULL, 2),
(12, 'Thêm dân làm nông\n', '@quest#47\n ', 'Miền đất hứa (Nhiệm vụ 2/10)\n', '@quest#48\n ', NULL, '@quest#535\n ', 70, 15, NULL, 2),
(13, 'Tăng tốc làm gỗ\n', '@quest#51\n ', 'Miền đất hứa (Nhiệm vụ 3/10)\n', '@quest#52\n ', NULL, '@quest#538\n ', 70, 15, NULL, 2),
(14, 'Phá đá trồng hoa\n\n ', '@quest#56\n\n', 'Miền đất hứa (Nhiệm vụ 4/10)\n\n ', '@quest#57\n\n ', NULL, '@quest#542\n\n ', 70, 15, NULL, 2),
(15, 'Tăng tốc nông trại\n\n', '@quest#61\n\n ', 'Miền đất hứa (Nhiệm vụ 5/10)\n\n', '@quest#62\n\n ', NULL, '@quest#546\n\n ', 70, 15, NULL, 2),
(16, 'Xây cầu vượt sông\n\n', '@quest#66\n\n ', 'Miền đất hứa (Nhiệm vụ 6/10)\n\n', '@quest#67\n\n ', NULL, '@quest#550\n\n ', 500, 25, NULL, 2),
(17, 'Giúp đỡ xóm giềng\n ', '@quest#71\n\n', 'Miền đất hứa (Nhiệm vụ 7/10)\n\n ', '@quest#72\n\n ', NULL, '@quest#554\n\n ', 70, 15, NULL, 2),
(18, 'Trang trại măng non\n\n', '@quest#75\n\n ', 'Miền đất hứa (Nhiệm vụ 8/10)\n\n', '@quest#76\n\n ', NULL, '@quest#557\n\n ', 70, 15, NULL, 2),
(19, 'Trang trí phố phường ', '@quest#80 ', 'Miền đất hứa (Nhiệm vụ 9/10) ', '@quest#81 ', NULL, '@quest#561 ', 70, 15, NULL, 2),
(20, 'Huấn luyện bộ binh\n\n', '@quest#85\n\n ', 'Miền đất hứa (Nhiệm vụ 10/10)\n\n', '@quest#86\n\n ', NULL, '@quest#550\n\n ', 0, 0, NULL, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_quest`
--
ALTER TABLE `q_quest`
  ADD CONSTRAINT `q_quest_ibfk_1` FOREIGN KEY (`QuestLineID`) REFERENCES `q_questline` (`QuestLineID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `q_quest_ibfk_2` FOREIGN KEY (`NextQuest`) REFERENCES `q_quest` (`QuestID`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
