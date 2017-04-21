-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 12:51 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charts`
--

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `country` varchar(50) NOT NULL,
  `vdate` date NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `browser`, `country`, `vdate`, `gender`) VALUES
(1, '120.1.2.01', 'Chrome', 'India', '2017-03-01', 'Male'),
(2, '120.1.0.53', 'Firefox', 'US', '2017-03-01', 'Male'),
(3, '198.0.0.5', 'Safari', 'UK', '2017-03-02', 'Male'),
(4, '198.0.0.5', 'Safari', 'India', '2017-09-03', 'Male'),
(5, '198.0.0.6', 'Chrome', 'India', '2017-09-03', 'Male'),
(6, '198.0.0.7', 'Chrome', 'US', '2017-03-03', 'Male'),
(7, '198.0.0.8', 'Safari', 'Russia', '2017-03-04', 'Male'),
(8, '198.0.0.8', 'Firefox', 'Russia', '2017-03-04', 'Female'),
(9, '198.0.0.10', 'Firefox', 'Russia', '2016-09-05', 'Female'),
(10, '198.0.0.8', 'Safari', 'India', '2017-09-05', 'Female'),
(11, '198.0.0.12', 'Chrome', 'UK', '2016-09-05', 'Female'),
(12, '198.0.0.14', 'Chrome', 'India', '2016-09-05', 'Female'),
(13, '198.0.0.14', 'Chrome', 'India', '2016-09-06', 'Female'),
(14, '198.0.0.15', 'IE', 'US', '2016-09-06', ''),
(15, '198.0.0.16', 'Chrome', 'US', '2016-09-06', ''),
(16, '198.0.0.15', 'IE', 'UK', '2016-09-07', ''),
(17, '198.0.0.16', 'IE', 'US', '2016-09-07', ''),
(18, '198.0.0.18', 'Chrome', 'India', '2016-09-07', ''),
(19, '198.0.0.19', 'Chrome', 'India', '2016-09-07', ''),
(20, '198.0.0.20', 'Firefox', 'India', '2016-09-07', ''),
(21, '198.0.0.20', 'Safari', 'India', '2016-09-07', ''),
(22, '198.0.0.22', 'Chrome', 'UK', '2016-09-07', ''),
(23, '198.0.0.22', 'Safari', 'UK', '2016-09-09', ''),
(24, '198.0.0.24', 'Opera', 'India', '2016-09-09', ''),
(25, '198.0.0.24', 'Opera', 'India', '2016-09-10', ''),
(26, '198.0.0.23', 'Opera', 'US', '2016-09-10', ''),
(27, '198.0.0.22', 'Opera', 'US', '2016-09-10', ''),
(28, '198.0.0.21', 'Safari', 'US', '2015-09-10', ''),
(29, '198.0.0.21', 'Chrome', 'US', '2015-09-10', ''),
(30, '198.0.0.55', 'Firefox', 'US', '2015-09-10', ''),
(31, '198.0.0.55', 'Chrome', 'US', '2015-09-10', ''),
(32, '198.0.0.57', 'Firefox', 'Russia', '2015-09-10', ''),
(33, '198.0.0.58', 'UC Browser', 'Russia', '2015-09-10', ''),
(34, '198.0.0.60', 'Chrome', 'Russia', '2015-09-10', ''),
(35, '198.0.0.60', 'Firefox', 'Russia', '2015-09-10', ''),
(36, '198.0.0.61', 'Safari', 'India', '2015-09-10', ''),
(37, '198.0.0.62', 'Safari', 'Brazil', '2015-09-10', ''),
(38, '198.0.0.63', 'Firefox', 'Brazil', '2015-09-10', ''),
(39, '198.0.0.64', 'Chrome', 'Brazil', '2015-09-10', ''),
(40, '198.0.0.65', 'Safari', 'Spain', '2015-09-10', ''),
(41, '198.0.0.78', 'UC Browser', 'Spain', '2015-09-10', ''),
(42, '198.0.0.79', 'Opera', 'Spain', '2015-09-10', ''),
(43, '198.0.0.79', 'Safari', 'Spain', '2015-09-10', ''),
(44, '198.0.0.5', 'Chrome', 'Brazil', '2015-09-10', ''),
(45, '198.0.0.5', 'Chrome', 'Brazil', '2015-09-10', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
