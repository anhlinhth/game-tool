-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2012 at 09:49 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chipzin2`
--

-- --------------------------------------------------------

--
-- Table structure for table `q_quest`
--

CREATE TABLE IF NOT EXISTS `q_quest` (
  `QuestID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QuestGroupString` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `QuestGroup` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `QuestString` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `QuestDesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `QuestDescString` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AwardGold` int(11) NOT NULL,
  `AwardExp` int(11) NOT NULL,
  `NextQuest` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `NeedQuest` int(11) DEFAULT NULL,
  `QuestLineID` int(11) NOT NULL,
  PRIMARY KEY (`QuestID`),
  KEY `QuestLineID` (`QuestLineID`),
  KEY `NextQuest` (`NextQuest`,`QuestLineID`),
  KEY `NextQuest_2` (`NextQuest`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `q_quest`
--

INSERT INTO `q_quest` (`QuestID`, `QuestName`, `QuestGroupString`, `QuestGroup`, `QuestString`, `QuestDesc`, `QuestDescString`, `AwardGold`, `AwardExp`, `NextQuest`, `NeedQuest`, `QuestLineID`) VALUES
(1, 'Mùa lúa về', '@quest#46', 'Ấm no (Nhiệm vụ 1/2)', '@quest#47', 'Mùa lúa tới rồi, hãy trồng trọt thật nhiều để tích trữ lương thực', '@quest#48', 0, 2, '2', 2, 7),
(2, 'Lúa chín đầy bồ', '@quest#53', 'Ấm no (Nhiệm vụ 2/2)', '@quest#54', 'Lúa chín rồi. Nhanh nhanh gặt nào', '@quest#55', 0, 1, '3', 1, 7),
(3, 'Thu thuế', '@quest#58', 'Thu thuế (Nhiệm vụ 1/1)', '@quest#59', 'Nhân tuần lễ Vàng, hãy đến nhà dân để quyên góp xây dựng làng', '@quest#60', 0, 1, '4', 2, 7),
(4, 'Nhà Cỏ tranh', '@quest#63', 'Tăng dân số (Nhiệm vụ 1/1)', '@quest#64', 'Dân làng mỗi lúc một đông, xây thêm nhà cho mọi người vui vẻ nào', '@quest#65', 0, 1, '5', 3, 7),
(5, 'Nhà đào tạo dân công', '@quest#68', 'Nhân lực dồi dào (Nhiệm vụ 1/2)', '@quest#69', 'Zin táy máy đã nghiên cứu thành công máy tự động đào tạo dân công. Vào đó nạp đủ dinh dưỡng siêu bổ, dân làng sẽ trở thành dân công năng suất lao động cực cao', '@quest#70', 0, 2, '6', 4, 7),
(6, 'Đào tạo dân công', '@quest#73', 'Nhân lực dồi dào (Nhiệm vụ 2/2)', '@quest#74', 'Tăng cường lực lượng cho làng để tăng năng suất lao động', '@quest#75', 0, 2, '7', 5, 7),
(7, 'Trại Gỗ', '@quest#78', 'Gỗ Mít (Nhiệm vụ 1/2)', '@quest#79', 'Trong rừng hiện có rất nhiều cây khô, lập trại gỗ để khai thác và tích trữ lượng gỗ cho kế hoạch dựng nhà trú đông', '@quest#80', 0, 2, NULL, 6, 7),
(8, 'Gỗ Mít', '@quest#83', 'Gỗ Mít (Nhiệm vụ 2/2)', '@quest#84', 'Mít cho gỗ rất thơm. Hãy thu hoạch để tích luỹ gỗ cho việc xây nhà nào', '@quest#85', 0, 2, NULL, 10, 7),
(10, 'Di chuyển', '@quest#95', 'Quy hoạch (Nhiệm vụ 1/2)', '@quest#96', 'Học thao tác quy hoạch làng một chút nhé', '@quest#97', 0, 2, '8', NULL, 7);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_quest`
--
ALTER TABLE `q_quest`
  ADD CONSTRAINT `q_quest_ibfk_1` FOREIGN KEY (`QuestLineID`) REFERENCES `q_questline` (`QuestLineID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
