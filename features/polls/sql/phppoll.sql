-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2017 at 06:27 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phppoll`
--

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` text,
  `starts` date DEFAULT NULL,
  `ends` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `question`, `starts`, `ends`) VALUES
(1, 'what is your fav language?', '0000-00-00', '0000-00-00'),
(2, 'What is my name?', '2017-04-10', '2017-04-12'),
(3, 'This is test question', '2017-04-12', '2017-04-12'),
(4, 'one more question', '2017-04-12', '2017-04-12'),
(5, 'test question', '2017-04-12', '2017-04-13'),
(6, '', '0000-00-00', '0000-00-00'),
(7, '', '0000-00-00', '0000-00-00'),
(8, '', '0000-00-00', '0000-00-00'),
(9, '', '0000-00-00', '0000-00-00'),
(10, '', '0000-00-00', '0000-00-00'),
(11, '', NULL, NULL),
(12, 'test', NULL, NULL),
(13, NULL, NULL, NULL),
(14, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `polls_answers`
--

CREATE TABLE `polls_answers` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `poll` int(11) NOT NULL,
  `choice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls_answers`
--

INSERT INTO `polls_answers` (`id`, `user`, `poll`, `choice`) VALUES
(3, 1, 1, 1),
(4, 2, 1, 2),
(5, 2, 1, 1),
(6, 2, 1, 2),
(7, 2, 1, 2),
(8, 2, 1, 2),
(9, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `polls_choices`
--

CREATE TABLE `polls_choices` (
  `id` int(11) NOT NULL,
  `poll` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls_choices`
--

INSERT INTO `polls_choices` (`id`, `poll`, `name`) VALUES
(1, 1, 'I love it'),
(2, 1, 'It''s alright'),
(3, 1, 'I hate it'),
(4, 2, 'I love polls'),
(5, 2, 'They''re ok '),
(4, 2, 'I can not bare it ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'aqsa'),
(2, 'Arshad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls_answers`
--
ALTER TABLE `polls_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `polls_answers`
--
ALTER TABLE `polls_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
