-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2019 at 12:39 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sls`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(300) NOT NULL,
  `news_disc` text NOT NULL,
  `news_filename` varchar(200) DEFAULT NULL,
  `news_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_disc`, `news_filename`, `news_stamp`) VALUES
(1, 'Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-01-16 05:18:19'),
(2, '1.1.1.Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-16 05:18:50'),
(3, '1.1.2.Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-16 05:19:14'),
(4, 'Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-17 15:53:01'),
(5, 'Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-17 15:53:51'),
(6, 'Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-17 15:54:00'),
(7, 'Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-17 15:54:07'),
(8, 'Analysis of antigen85 like proteins in\r\nbacterial genomes', 'Swathi A, Guruprasad K and Guruprasad L, Analysis of antigen85 like proteins in\r\nbacterial genomes, The first Indian symposium of protein society- Protein Structure &\r\nFunction P1-19 October 18-20, (2002) IIT Bombay \r\n', '0', '2019-05-17 15:55:46'),
(9, 'ggg', 'tgg', 'uploads/news/9.jpg', '2019-06-25 12:33:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
