-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2015 at 08:52 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mruc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE IF NOT EXISTS `student_tbl` (
`id` int(11) NOT NULL,
  `admNo` varchar(30) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Sname` varchar(20) NOT NULL,
  `school` varchar(50) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year_in` int(4) NOT NULL,
  `year_out` int(4) NOT NULL,
  `DOB` date NOT NULL,
  `date_admitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`id`, `admNo`, `Fname`, `Lname`, `Sname`, `school`, `faculty`, `course`, `year_in`, `year_out`, `DOB`, `date_admitted`) VALUES
(1, 'MRBIT211-0114/2012', 'Dismus', 'Kiplimo', 'Ng''eno', 'Information Technology', 'Information Technology', 'Bsc. Information Technology', 2013, 2016, '1992-07-10', '2015-02-25 10:23:10'),
(2, 'MRBIT211-0097/2012', 'Wilfred', 'Ketere', 'Lemayian', 'Information Technology', 'Information Technology', 'Bsc. Information Technology', 2013, 2016, '1990-12-12', '2015-02-25 10:26:45'),
(3, 'MRBIT211-0102/2012', 'Walter', 'Ruto', 'Kiplangat', 'Information Technology', 'Information Technology', 'Bsc. Information Technology', 2013, 2016, '1993-03-16', '2015-02-25 10:28:06'),
(4, 'MRBIT211-0086/2012', 'Milcah', 'Chebii', '', 'Information Technology', 'Information Technology', 'Bsc. Information Technology', 2013, 2016, '1993-03-07', '2015-02-25 10:32:58'),
(5, 'MRBIT211-0087/2012', 'Fred', 'Mwololo', '', 'Information Technology', 'Information Technology', 'Bsc. Information Technology', 2013, 2016, '1991-12-02', '2015-02-25 10:34:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `admNo` (`admNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
