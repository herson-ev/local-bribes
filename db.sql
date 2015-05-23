-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2015 at 04:14 AM
-- Server version: 5.5.43-0+deb8u1
-- PHP Version: 5.6.7-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bribe`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`id` int(10) unsigned NOT NULL,
  `level` tinyint(4) NOT NULL,
  `parent` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `abbreviation` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `level`, `parent`, `name`, `abbreviation`) VALUES
(1, 1, 0, 'Province1', 'P1'),
(2, 1, 0, 'Province2', 'P2'),
(3, 1, 0, 'Province3', 'P3'),
(4, 1, 0, 'Province4', 'P4'),
(5, 2, 1, 'Canton1.1', 'C1'),
(6, 2, 1, 'Canton1.2', 'C2'),
(7, 2, 2, 'Canton2.1', 'C3'),
(8, 2, 2, 'Canton2.2', 'C4'),
(9, 2, 3, 'Canton3.1', 'C5'),
(10, 2, 3, 'Canton3.2', 'C6'),
(11, 2, 4, 'Canton4.1', 'C7'),
(12, 2, 4, 'Canton4.2', 'C8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;