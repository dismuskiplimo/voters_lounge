-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2015 at 08:56 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voters_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspirant_tbl`
--

CREATE TABLE IF NOT EXISTS `aspirant_tbl` (
`id` int(11) NOT NULL,
  `admNo` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `registrar` varchar(150) NOT NULL,
  `nomID` int(11) NOT NULL,
  `school` varchar(50) NOT NULL,
  `position` varchar(30) NOT NULL,
  `img_url` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aspirant_tbl`
--

INSERT INTO `aspirant_tbl` (`id`, `admNo`, `fname`, `lname`, `reg_date`, `registrar`, `nomID`, `school`, `position`, `img_url`) VALUES
(3, 'MRBIT211-0097/2012', 'Wilfred', 'Lemayian', '2015-02-27 16:27:17', '0', 0, '', 'Catering', 'images/uploads/7943072626b5f6c066cce4b75efad4edc28dfac11425387050.jpg'),
(4, 'MRBIT211-0086/2012', 'Milcah', 'Chebii', '2015-02-28 11:02:01', '0', 0, '', 'president', 'images/uploads/b30ff17d14b759c017197570526ff51b33cc83c51425121321.jpg'),
(5, 'MRBIT211-0087/2012', 'Christopher', 'Mwololo', '2015-02-28 15:45:53', '0', 0, '', 'president', 'images/uploads/7943072626b5f6c066cce4b75efad4edc28dfac11425138353.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE IF NOT EXISTS `dates` (
`id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `start`, `end`, `date_registered`) VALUES
(4, '2015-03-10', '2015-03-11', '2015-03-10 20:18:25'),
(5, '2015-03-21', '2015-03-23', '2015-03-21 18:05:04'),
(6, '2015-03-20', '2015-03-20', '2015-03-21 18:08:06'),
(7, '2015-03-21', '2015-03-22', '2015-03-21 18:08:43'),
(8, '2015-03-21', '2015-03-22', '2015-03-21 18:11:37'),
(9, '2015-03-21', '2015-03-22', '2015-03-21 18:13:35'),
(10, '2015-03-21', '2015-03-21', '2015-03-22 17:26:45'),
(11, '2015-03-24', '2015-03-27', '2015-03-24 13:14:07'),
(12, '2015-01-07', '2015-03-18', '2015-03-24 13:24:36'),
(13, '2015-03-24', '2015-03-27', '2015-03-24 14:45:10'),
(14, '2015-04-28', '2015-04-30', '2015-03-27 22:51:57'),
(15, '2015-03-27', '2015-03-30', '2015-03-28 16:56:56'),
(16, '2015-03-30', '2015-04-06', '2015-03-30 12:54:04'),
(17, '2015-04-06', '2015-04-10', '2015-04-07 06:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `positions_tbl`
--

CREATE TABLE IF NOT EXISTS `positions_tbl` (
`id` int(11) NOT NULL,
  `abbreviation` varchar(150) NOT NULL,
  `details` varchar(150) NOT NULL,
  `plural` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions_tbl`
--

INSERT INTO `positions_tbl` (`id`, `abbreviation`, `details`, `plural`) VALUES
(1, 'president', 'Presidential Aspirant', 'Presidential Aspirants'),
(2, 'vice', 'Vice President Aspirant', 'Vice President Aspirants'),
(3, 'finance', 'Finance Secretary', 'Finance Secretaries'),
(4, 'sports', 'Sports minister', 'Sports ministers'),
(5, 'Catering', 'Catering Minister', 'Catering Ministers'),
(10, 'entertainment', 'Entertainment Secretary', 'Entertainment Secretaries');

-- --------------------------------------------------------

--
-- Table structure for table `registrar_tbl`
--

CREATE TABLE IF NOT EXISTS `registrar_tbl` (
`id` int(11) NOT NULL,
  `regNo` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrar_tbl`
--

INSERT INTO `registrar_tbl` (`id`, `regNo`, `fname`, `lname`, `username`, `password`) VALUES
(1, 'MRB201', 'Brian', 'Kangogo', 'brian', 'brian'),
(2, 'MBT5', 'Gregory', 'Isaac', 'gregz', 'gregz'),
(4, 'MBT1', 'Gregory', 'Isaac', 'gregz', 'chimo'),
(5, 'MBT2', 'Gregory', 'Isaac', 'gregz', '4d87329d397968b32e4c51f66b88c4039da2de30'),
(6, 'MBT3', 'Dismus', 'Kiplimo', 'chimo', '4d87329d397968b32e4c51f66b88c4039da2de30'),
(7, 'MRBIT211-0125/2012', 'brian', 'brayo', 'bbrayo', '06ad7b66e1822683e2bbf0ba08217580899868dc');

-- --------------------------------------------------------

--
-- Table structure for table `voters_tbl`
--

CREATE TABLE IF NOT EXISTS `voters_tbl` (
`id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `admNo` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_status` tinyint(1) NOT NULL DEFAULT '0',
  `vote_status` tinyint(1) NOT NULL DEFAULT '0',
  `registrar` varchar(30) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(150) NOT NULL,
  `img_url` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters_tbl`
--

INSERT INTO `voters_tbl` (`id`, `fname`, `lname`, `sname`, `admNo`, `username`, `password`, `reg_status`, `vote_status`, `registrar`, `date_registered`, `email`, `img_url`) VALUES
(25, 'Dismus', 'Kiplim', '', 'MRBIT211-0114/2012', 'dis', '5be58a3a0eb92eb6e5c3225a8530c316577999e7', 1, 0, 'MBT3', '2015-03-26 13:23:42', 'dizkip@yahoo.com', 'images/default.png'),
(26, 'Milcah', 'Chebii', '', 'MRBIT211-0087/2012', 'milly', 'e09a395c5e3ac034a4f7f2746c9b7b32485016fa', 0, 0, '', '2015-04-05 18:30:12', 'milly@gmail.com', 'images/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `votes_tbl`
--

CREATE TABLE IF NOT EXISTS `votes_tbl` (
`id` int(11) NOT NULL,
  `candidateID` varchar(30) NOT NULL,
  `school` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_tbl`
--

INSERT INTO `votes_tbl` (`id`, `candidateID`, `school`, `time`) VALUES
(1, 'MRBIT211-0087/2012', 'Information Technology', '2015-03-28 16:57:27'),
(2, 'MRBIT211-0097/2012', 'Information Technology', '2015-03-28 16:57:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aspirant_tbl`
--
ALTER TABLE `aspirant_tbl`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `admNo` (`admNo`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions_tbl`
--
ALTER TABLE `positions_tbl`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrar_tbl`
--
ALTER TABLE `registrar_tbl`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `regNo` (`regNo`);

--
-- Indexes for table `voters_tbl`
--
ALTER TABLE `voters_tbl`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes_tbl`
--
ALTER TABLE `votes_tbl`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspirant_tbl`
--
ALTER TABLE `aspirant_tbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `positions_tbl`
--
ALTER TABLE `positions_tbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `registrar_tbl`
--
ALTER TABLE `registrar_tbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `voters_tbl`
--
ALTER TABLE `voters_tbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `votes_tbl`
--
ALTER TABLE `votes_tbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
