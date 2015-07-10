-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2015 at 03:45 AM
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
-- Table structure for table `institution`
--

CREATE TABLE IF NOT EXISTS `institution` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id`, `name`) VALUES
(1, 'Institution A'),
(2, 'Institution B'),
(3, 'Police'),
(4, 'Customs'),
(5, 'Municipality X'),
(6, 'Municipality Y');

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
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `event` int(1) NOT NULL,
  `detail` text,
  `amount` decimal(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
