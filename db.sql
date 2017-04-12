-- phpMyAdmin SQL Dump
-- version 4.6.6deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2017 at 01:35 AM
-- Server version: 5.5.53-0+deb8u1
-- PHP Version: 7.0.16-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bohdantest`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums1`
--

CREATE TABLE `albums1` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `cover_photo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums1`
--

INSERT INTO `albums1` (`id`, `name`, `description`, `date_created`, `cover_photo`) VALUES
(3, 'My Canada Trip', 'Oh wow!!Beautiful Canada..I was To mush excited .......... ', '2016-08-24', '22802.jpg'),
(4, 'Our India', 'India is my home country here I am sharing some beautiful tourist spots from India', '2017-02-28', '11330.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `global_type` int(11) NOT NULL DEFAULT '2',
  `cat_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `event_start` varchar(255) NOT NULL,
  `event_end` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '0',
  `posted_by` int(10) NOT NULL,
  `posted_date` datetime NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `verified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `global_type`, `cat_id`, `title`, `image`, `description`, `contact`, `address`, `lat`, `lng`, `event_start`, `event_end`, `rating`, `posted_by`, `posted_date`, `approved`, `verified`) VALUES
(1, 2, 2, 'LinX', 'features/restaurants/images/3.jpg', 'Located in northwest Toronto (formerly Etobicoke), the Humber North Campus has approximately 20,000 full-time and 57,000 part-time students.1,000 of them living in residence.[8] The campus includes University of Guelph-Humber, with a collaborative university-college partnership between the University of Guelph and Humber College.\r\n\r\nHumber Arboretum[edit]\r\nLocated behind Humber College\'s North campus, the Humber Arboretum consists of botanical gardens and natural areas surrounding the Humber River.[9] This unique site is home to the Carolinian bioregion, the most diverse ecosystem in Canada, and boasts over 1,700 species of plants and animals. The Humber Arboretum covers approximately 250 acres (101 ha) of the West Humber River Valley between Highway 27 and the 427 and is easily accessed from Humber College Blvd.\r\n\r\nThe Arboretum is one of the resources of Humber College. It provides faculty and students with an outdoor classroom and living laboratory at their disposal for research, innovation, hands-on projects, and applied work experience. The Arboretum is also linked with programs and services College-wide.[citation needed]\r\n\r\nThe Humber Arboretum was originally started by Humber College horticulture students in 1977.Its purpose is to facilitate research and education, establish and maintain plant collections, promote conservation and restoration practices, and provide a visitor experience.\r\n\r\nThe Centre for Urban Ecology, located in the Humber Arboretum, provides educational programming focused on urban ecology. It also serves as a venue for meetings, conferences, weddings, and special events.', '647 999 5555 ', 'Toronto', '43.728', '-79.606', '2017-04-03T12:00', '2017-04-03T15:00', '10', 1, '2017-03-12 20:09:01', 1, 0),
(2, 2, 2, 'Tim Hortons', 'features/restaurants/images/2.jpg', 'Seneca offers more than 145 full-time programs and 135 part-time programs including 14 Bachelor\'s degrees and 30 graduate certificates.[2]\r\n\r\nMany programs offer experiential learning opportunities such as co-op, placements, internships and community service options, while others include a mandatory co-op period prior to graduation. Seneca also offers career search assistance to graduating students. Seneca College programs are developed and kept current with the assistance of advisory committees made up of key industry members. They are in place to ensure the education students receive provides the skills necessary for career success.\r\n\r\nSeneca College is the leader in Ontario in university and college pathways. It has more than 70 transfer agreements with both local and international post-secondary institutions, including universities in Australia, England, South Africa and the U.S. These agreements allow students to apply their college education to obtain credit towards a university degree.\r\n\r\n', '123 456 7890', 'Toronto', '43.795', '-79.350', '2017-05-03T12:00', '2017-04-03T03:00', '9', 1, '2017-03-12 20:12:35', 1, 0),
(39, 2, 1, 'CN Tower Restaurant', 'features/restaurants/images/place58d7350eb8c12.jpg', 'The CN Tower (French: Tour CN) is a 553.3 m-high (1,815.3 ft) concrete communications and observation tower in downtown Toronto, Ontario, Canada.[3][6] Built on the former Railway Lands, it was completed in 1976, becoming the world\'s tallest free-standing structure and world\'s tallest tower at the time. It held both records for 34 years until the completion of Burj Khalifa and Canton Tower in 2010. It is now the third tallest tower in the world and remains the tallest free-standing structure in the Western Hemisphere, a signature icon of Toronto\'s skyline, and a symbol of Canada,[7][8] attracting more than two million international visitors annually.[5][9]\r\n\r\nIts name \"CN\" originally referred to Canadian National, the railway company that built the tower. Following the railway\'s decision to divest non-core freight railway assets, prior to the company\'s privatization in 1995, it transferred the tower to the Canada Lands Company, a federal Crown corporation responsible for real estate development. Since the name CN Tower became common in daily usage, the abbreviation was eventually expanded to Canadian National Tower or Canada\'s National Tower. However, neither of these names is commonly used.[10]\r\n\r\nIn 1995, the CN Tower was declared one of the modern Seven Wonders of the World by the American Society of Civil Engineers. It also belongs to the World Federation of Great Towers, where it holds second-place ranking.[11][12][5]', '647 999 5555', '301 Front St W, Toronto, ON M5V 2T6', '43.642735', '-79.387096', '2017-04-03T00:00', '2017-04-03T03:00', '0', 1, '2017-03-25 23:19:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `events_categories`
--

CREATE TABLE `events_categories` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_categories`
--

INSERT INTO `events_categories` (`id`, `title`, `publish_date`) VALUES
(1, 'IT', '2017-03-12 19:59:53'),
(2, 'Concert', '0000-00-00 00:00:00'),
(3, 'Party', '2017-03-12 20:01:50'),
(4, 'Event type 1', '2017-03-12 20:02:18'),
(5, 'Event type 2', '2017-03-12 20:02:43'),
(6, 'Event type 3', '2017-03-12 20:03:21'),
(7, 'Event type 4', '2017-03-12 20:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(5) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `question` mediumtext,
  `answer` longtext,
  `curdate` date DEFAULT NULL,
  `likes` int(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `user_name`, `user_email`, `question`, `answer`, `curdate`, `likes`) VALUES
(3, '', '', 'How do I create a account?', 'If you see the signup form, fill out your name, email address or mobile phone number, password, date of birth and gender. If you don\'t see the form, click Sign Up, then fill out the form.\r\n\r\n\r\n\r\n\r\nIf you\'re having trouble logging into your account here are a few things to try: Reset your password Login with your username or phone number if you forgot your email address Check out our login troubleshooting tips If you\'re still having trouble, we can help you recover your account. ', '2017-03-24', 5),
(4, '', '', 'How do I log into my account?', '    Email address: You can log in with any email address that\'s listed on your account\r\n    Username: You can also log in with your username\r\n    Phone number: If you have a mobile phone number confirmed on your account you can enter it here (skip the zeros before the country code and any symbols)\r\n\r\nEnter your password\r\nClick Log In\r\n\r\n\r\n\r\nIf you\'re having trouble logging into your account here are a few things to try: Reset your password Login with your username or phone number if you forgot your email address Check out our login troubleshooting tips If you\'re still having trouble, we can help you recover your account. ', '2017-03-24', 2),
(5, '', '', 'I can\'t log in.', 'If you\'re having trouble logging into your account here are a few things to try:\r\n\r\n    Reset your password\r\n    Login with your username or phone number if you forgot your email address\r\n    Check out our login troubleshooting tips\r\n\r\nIf you\'re still having trouble, we can help you recover your account.\r\n\r\n\r\n\r\nIf you\'re having trouble logging into your account here are a few things to try: Reset your password Login with your username or phone number if you forgot your email address Check out our login troubleshooting tips If you\'re still having trouble, we can help you recover your account. \r\n\r\n\r\n\r\n\r\nIf you\'re having trouble logging into your account here are a few things to try: Reset your password Login with your username or phone number if you forgot your email address Check out our login troubleshooting tips If you\'re still having trouble, we can help you recover your account. ', '2017-03-24', 1),
(6, '', '', 'How do I change or reset my password?', 'If you know your current password, you can change it:\r\n\r\n    Click in the top right corner of page and select Settings\r\n    Click Password\r\n    Type your current and new passwords\r\n    Click Save Changes\r\n\r\nIf you don\'t know your current password, you can reset it:\r\n\r\n    Go to the Find Your Account Page\r\n    Type the email, phone number, full name or username associated with your account, then click Search\r\n    Follow the on-screen instructions\r\n\r\nIf you\'re still having trouble, we can help you recover your account.\r\n\r\n\r\nIf you\'re having trouble logging into your account here are a few things to try: Reset your password Login with your username or phone number if you forgot your email address Check out our login troubleshooting tips If you\'re still having trouble, we can help you recover your account. \r\n\r\nIf you\'re having trouble logging into your Facebook account here are a few things to try: Reset your password Login with your username or phone number if you forgot your email address Check out our login troubleshooting tips If you\'re still having trouble, we can help you recover your account. ', '2017-03-24', 6),
(7, '', '', 'How can I make my password strong?', 'When you create a new password, make sure that it\'s at least 6 characters long. Try to use a complex combination of numbers, letters and punctuation marks.\r\nIf you see a message letting you know the password you entered isn\'t strong enough, try mixing together uppercase and lowercase letters. You can also make the password more complex by making it longer with a phrase or series of words that you can easily remember, but no one else knows.\r\nKeep in mind that your Facebook password should also be different than the passwords you use to log into other accounts, like your email or bank account.', '2017-03-08', 4),
(9, 'hh', 'dd', 'fff', NULL, '2017-03-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `type_id` int(10) NOT NULL,
  `item_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`type_id`, `item_title`) VALUES
(1, 'place'),
(2, 'event'),
(3, 'cafe'),
(4, 'trip');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user` varchar(235) NOT NULL,
  `message` varchar(255) NOT NULL,
  `textcolor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user`, `message`, `textcolor`) VALUES
(8, 'Aqsa', 'Hi are you good', '#85CEFF');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `albm_id` int(11) NOT NULL,
  `imgurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `name`, `albm_id`, `imgurl`) VALUES
(13, 'CN Tower', 3, '23038.jpg'),
(14, 'Niagara Fall', 3, '25951.jpg'),
(15, 'Lake Ontario', 3, '26273.jpg'),
(16, 'India Gate', 4, '28870.jpg'),
(17, 'Taj Mahal', 4, '2183.jpg'),
(18, 'Golden Temple Amritsar', 4, '29620.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(10) NOT NULL,
  `global_type` int(11) NOT NULL DEFAULT '1',
  `cat_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `working_hours` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '0',
  `posted_by` int(10) NOT NULL,
  `posted_date` datetime NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `verified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `global_type`, `cat_id`, `title`, `image`, `description`, `contact`, `address`, `lat`, `lng`, `working_hours`, `rating`, `posted_by`, `posted_date`, `approved`, `verified`) VALUES
(1, 1, 2, ' Humber College - North Campus', 'features/places/images/3.jpg', 'Located in northwest Toronto (formerly Etobicoke), the Humber North Campus has approximately 20,000 full-time and 57,000 part-time students.1,000 of them living in residence.[8] The campus includes University of Guelph-Humber, with a collaborative university-college partnership between the University of Guelph and Humber College.\r\n\r\nHumber Arboretum[edit]\r\nLocated behind Humber College\'s North campus, the Humber Arboretum consists of botanical gardens and natural areas surrounding the Humber River.[9] This unique site is home to the Carolinian bioregion, the most diverse ecosystem in Canada, and boasts over 1,700 species of plants and animals. The Humber Arboretum covers approximately 250 acres (101 ha) of the West Humber River Valley between Highway 27 and the 427 and is easily accessed from Humber College Blvd.\r\n\r\nThe Arboretum is one of the resources of Humber College. It provides faculty and students with an outdoor classroom and living laboratory at their disposal for research, innovation, hands-on projects, and applied work experience. The Arboretum is also linked with programs and services College-wide.[citation needed]\r\n\r\nThe Humber Arboretum was originally started by Humber College horticulture students in 1977.Its purpose is to facilitate research and education, establish and maintain plant collections, promote conservation and restoration practices, and provide a visitor experience.\r\n\r\nThe Centre for Urban Ecology, located in the Humber Arboretum, provides educational programming focused on urban ecology. It also serves as a venue for meetings, conferences, weddings, and special events.', '647 999 5555 ', 'Toronto', '43.728', '-79.606', '{\"M_S\":\"09:00\",\"M_E\":\"23:00\",\"T_S\":\"09:00\",\"T_E\":\"23:00\",\"W_S\":\"08:00\",\"W_E\":\"20:00\",\"R_S\":\"09:00\",\"R_E\":\"23:00\",\"F_S\":\"10:00\",\"F_E\":\"23:00\",\"S_S\":\"10:00\",\"S_E\":\"21:00\",\"N_S\":\"10:00\",\"N_E\":\"23:00\"}', '10', 1, '2017-03-12 20:09:01', 1, 0),
(2, 1, 2, 'Seneca College Newnham Campus', 'features/places/images/2.jpg', 'Seneca offers more than 145 full-time programs and 135 part-time programs including 14 Bachelor\'s degrees and 30 graduate certificates.[2]\n\nMany programs offer experiential learning opportunities such as co-op, placements, internships and community service options, while others include a mandatory co-op period prior to graduation. Seneca also offers career search assistance to graduating students. Seneca College programs are developed and kept current with the assistance of advisory committees made up of key industry members. They are in place to ensure the education students receive provides the skills necessary for career success.\n\nSeneca College is the leader in Ontario in university and college pathways. It has more than 70 transfer agreements with both local and international post-secondary institutions, including universities in Australia, England, South Africa and the U.S. These agreements allow students to apply their college education to obtain credit towards a university degree.\n\n', '123 456 7890', 'Toronto', '43.795', '-79.350', '{\"M_S\":\"09:00\",\"M_E\":\"12:00\",\"T_S\":\"09:00\",\"T_E\":\"12:00\",\"W_S\":\"08:00\",\"W_E\":\"20:00\",\"R_S\":\"09:00\",\"R_E\":\"23:00\",\"F_S\":\"10:00\",\"F_E\":\"23:00\",\"S_S\":\"10:00\",\"S_E\":\"21:00\",\"N_S\":\"10:00\",\"N_E\":\"12:00\"}', '9', 1, '2017-03-12 20:12:35', 1, 0),
(39, 1, 1, 'CN Tower', 'features/places/images/place58d7350eb8c12.jpg', 'The CN Tower (French: Tour CN) is a 553.3 m-high (1,815.3 ft) concrete communications and observation tower in downtown Toronto, Ontario, Canada.[3][6] Built on the former Railway Lands, it was completed in 1976, becoming the world\'s tallest free-standing structure and world\'s tallest tower at the time. It held both records for 34 years until the completion of Burj Khalifa and Canton Tower in 2010. It is now the third tallest tower in the world and remains the tallest free-standing structure in the Western Hemisphere, a signature icon of Toronto\'s skyline, and a symbol of Canada,[7][8] attracting more than two million international visitors annually.[5][9]\r\n\r\nIts name \"CN\" originally referred to Canadian National, the railway company that built the tower. Following the railway\'s decision to divest non-core freight railway assets, prior to the company\'s privatization in 1995, it transferred the tower to the Canada Lands Company, a federal Crown corporation responsible for real estate development. Since the name CN Tower became common in daily usage, the abbreviation was eventually expanded to Canadian National Tower or Canada\'s National Tower. However, neither of these names is commonly used.[10]\r\n\r\nIn 1995, the CN Tower was declared one of the modern Seven Wonders of the World by the American Society of Civil Engineers. It also belongs to the World Federation of Great Towers, where it holds second-place ranking.[11][12][5]', '647 999 5555', '301 Front St W, Toronto, ON M5V 2T6', '43.642735', '-79.387096', '{\"M_S\":\"09:00\",\"M_E\":\"22:30\",\"T_S\":\"09:00\",\"T_E\":\"22:30\",\"W_S\":\"09:00\",\"W_E\":\"22:30\",\"R_S\":\"09:00\",\"R_E\":\"22:30\",\"F_S\":\"09:00\",\"F_E\":\"22:30\",\"S_S\":\"09:00\",\"S_E\":\"22:30\",\"N_S\":\"09:00\",\"N_E\":\"22:30\"}', '0', 1, '2017-03-25 23:19:54', 1, 0),
(40, 1, 1, 'CN Tower', 'features/places/images/place58d7350eb8c12.jpg', 'The CN Tower (French: Tour CN) is a 553.3 m-high (1,815.3 ft) concrete communications and observation tower in downtown Toronto, Ontario, Canada.[3][6] Built on the former Railway Lands, it was completed in 1976, becoming the world\'s tallest free-standing structure and world\'s tallest tower at the time. It held both records for 34 years until the completion of Burj Khalifa and Canton Tower in 2010. It is now the third tallest tower in the world and remains the tallest free-standing structure in the Western Hemisphere, a signature icon of Toronto\'s skyline, and a symbol of Canada,[7][8] attracting more than two million international visitors annually.[5][9]\r\n\r\nIts name \"CN\" originally referred to Canadian National, the railway company that built the tower. Following the railway\'s decision to divest non-core freight railway assets, prior to the company\'s privatization in 1995, it transferred the tower to the Canada Lands Company, a federal Crown corporation responsible for real estate development. Since the name CN Tower became common in daily usage, the abbreviation was eventually expanded to Canadian National Tower or Canada\'s National Tower. However, neither of these names is commonly used.[10]\r\n\r\nIn 1995, the CN Tower was declared one of the modern Seven Wonders of the World by the American Society of Civil Engineers. It also belongs to the World Federation of Great Towers, where it holds second-place ranking.[11][12][5]', '647 999 5555', '301 Front St W, Toronto, ON M5V 2T6', '43.642735', '-79.387096', '{\"M_S\":\"09:00\",\"M_E\":\"22:30\",\"T_S\":\"09:00\",\"T_E\":\"22:30\",\"W_S\":\"09:00\",\"W_E\":\"22:30\",\"R_S\":\"09:00\",\"R_E\":\"22:30\",\"F_S\":\"09:00\",\"F_E\":\"22:30\",\"S_S\":\"09:00\",\"S_E\":\"22:30\",\"N_S\":\"09:00\",\"N_E\":\"22:30\"}', '0', 1, '2017-03-25 23:19:54', 1, 0),
(41, 1, 1, 'CN Tower', 'features/places/images/place58d7350eb8c12.jpg', 'The CN Tower (French: Tour CN) is a 553.3 m-high (1,815.3 ft) concrete communications and observation tower in downtown Toronto, Ontario, Canada.[3][6] Built on the former Railway Lands, it was completed in 1976, becoming the world\'s tallest free-standing structure and world\'s tallest tower at the time. It held both records for 34 years until the completion of Burj Khalifa and Canton Tower in 2010. It is now the third tallest tower in the world and remains the tallest free-standing structure in the Western Hemisphere, a signature icon of Toronto\'s skyline, and a symbol of Canada,[7][8] attracting more than two million international visitors annually.[5][9]\r\n\r\nIts name \"CN\" originally referred to Canadian National, the railway company that built the tower. Following the railway\'s decision to divest non-core freight railway assets, prior to the company\'s privatization in 1995, it transferred the tower to the Canada Lands Company, a federal Crown corporation responsible for real estate development. Since the name CN Tower became common in daily usage, the abbreviation was eventually expanded to Canadian National Tower or Canada\'s National Tower. However, neither of these names is commonly used.[10]\r\n\r\nIn 1995, the CN Tower was declared one of the modern Seven Wonders of the World by the American Society of Civil Engineers. It also belongs to the World Federation of Great Towers, where it holds second-place ranking.[11][12][5]', '647 999 5555', '301 Front St W, Toronto, ON M5V 2T6', '43.642735', '-79.387096', '{\"M_S\":\"09:00\",\"M_E\":\"22:30\",\"T_S\":\"09:00\",\"T_E\":\"22:30\",\"W_S\":\"09:00\",\"W_E\":\"22:30\",\"R_S\":\"09:00\",\"R_E\":\"22:30\",\"F_S\":\"09:00\",\"F_E\":\"22:30\",\"S_S\":\"09:00\",\"S_E\":\"22:30\",\"N_S\":\"09:00\",\"N_E\":\"22:30\"}', '0', 1, '2017-03-25 23:19:54', 1, 0),
(42, 1, 1, 'CN Tower', 'features/places/images/place58d7350eb8c12.jpg', 'The CN Tower (French: Tour CN) is a 553.3 m-high (1,815.3 ft) concrete communications and observation tower in downtown Toronto, Ontario, Canada.[3][6] Built on the former Railway Lands, it was completed in 1976, becoming the world\'s tallest free-standing structure and world\'s tallest tower at the time. It held both records for 34 years until the completion of Burj Khalifa and Canton Tower in 2010. It is now the third tallest tower in the world and remains the tallest free-standing structure in the Western Hemisphere, a signature icon of Toronto\'s skyline, and a symbol of Canada,[7][8] attracting more than two million international visitors annually.[5][9]\r\n\r\nIts name \"CN\" originally referred to Canadian National, the railway company that built the tower. Following the railway\'s decision to divest non-core freight railway assets, prior to the company\'s privatization in 1995, it transferred the tower to the Canada Lands Company, a federal Crown corporation responsible for real estate development. Since the name CN Tower became common in daily usage, the abbreviation was eventually expanded to Canadian National Tower or Canada\'s National Tower. However, neither of these names is commonly used.[10]\r\n\r\nIn 1995, the CN Tower was declared one of the modern Seven Wonders of the World by the American Society of Civil Engineers. It also belongs to the World Federation of Great Towers, where it holds second-place ranking.[11][12][5]', '647 999 5555', '301 Front St W, Toronto, ON M5V 2T6', '43.642735', '-79.387096', '{\"M_S\":\"09:00\",\"M_E\":\"22:30\",\"T_S\":\"09:00\",\"T_E\":\"22:30\",\"W_S\":\"09:00\",\"W_E\":\"22:30\",\"R_S\":\"09:00\",\"R_E\":\"22:30\",\"F_S\":\"09:00\",\"F_E\":\"22:30\",\"S_S\":\"09:00\",\"S_E\":\"22:30\",\"N_S\":\"09:00\",\"N_E\":\"22:30\"}', '0', 1, '2017-03-25 23:19:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `places_categories`
--

CREATE TABLE `places_categories` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places_categories`
--

INSERT INTO `places_categories` (`id`, `title`, `publish_date`) VALUES
(1, 'Arts & Entertainment', '2017-03-12 19:59:53'),
(2, 'Colleges & Universities', '0000-00-00 00:00:00'),
(3, 'Nightlife Spots', '2017-03-12 20:01:50'),
(4, 'Outdoors & Recreation', '2017-03-12 20:02:18'),
(5, 'Professional & Other Places', '2017-03-12 20:02:43'),
(6, 'Shop & Service', '2017-03-12 20:03:21'),
(7, 'Travel & Transport', '2017-03-12 20:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) NOT NULL,
  `global_type` int(11) NOT NULL DEFAULT '3',
  `cat_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `working_hours` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '0',
  `posted_by` int(10) NOT NULL,
  `posted_date` datetime NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `verified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `global_type`, `cat_id`, `title`, `image`, `description`, `contact`, `address`, `lat`, `lng`, `working_hours`, `rating`, `posted_by`, `posted_date`, `approved`, `verified`) VALUES
(1, 3, 2, 'LinX', 'features/restaurants/images/3.jpg', 'Located in northwest Toronto (formerly Etobicoke), the Humber North Campus has approximately 20,000 full-time and 57,000 part-time students.1,000 of them living in residence.[8] The campus includes University of Guelph-Humber, with a collaborative university-college partnership between the University of Guelph and Humber College.\r\n\r\nHumber Arboretum[edit]\r\nLocated behind Humber College\'s North campus, the Humber Arboretum consists of botanical gardens and natural areas surrounding the Humber River.[9] This unique site is home to the Carolinian bioregion, the most diverse ecosystem in Canada, and boasts over 1,700 species of plants and animals. The Humber Arboretum covers approximately 250 acres (101 ha) of the West Humber River Valley between Highway 27 and the 427 and is easily accessed from Humber College Blvd.\r\n\r\nThe Arboretum is one of the resources of Humber College. It provides faculty and students with an outdoor classroom and living laboratory at their disposal for research, innovation, hands-on projects, and applied work experience. The Arboretum is also linked with programs and services College-wide.[citation needed]\r\n\r\nThe Humber Arboretum was originally started by Humber College horticulture students in 1977.Its purpose is to facilitate research and education, establish and maintain plant collections, promote conservation and restoration practices, and provide a visitor experience.\r\n\r\nThe Centre for Urban Ecology, located in the Humber Arboretum, provides educational programming focused on urban ecology. It also serves as a venue for meetings, conferences, weddings, and special events.', '647 999 5555 ', 'Toronto', '43.728', '-79.606', '{\"M_S\":\"09:00\",\"M_E\":\"23:00\",\"T_S\":\"09:00\",\"T_E\":\"23:00\",\"W_S\":\"08:00\",\"W_E\":\"20:00\",\"R_S\":\"09:00\",\"R_E\":\"23:00\",\"F_S\":\"10:00\",\"F_E\":\"23:00\",\"S_S\":\"10:00\",\"S_E\":\"21:00\",\"N_S\":\"10:00\",\"N_E\":\"23:00\"}', '10', 1, '2017-03-12 20:09:01', 1, 0),
(2, 3, 2, 'Tim Hortons', 'features/restaurants/images/2.jpg', 'Seneca offers more than 145 full-time programs and 135 part-time programs including 14 Bachelor\'s degrees and 30 graduate certificates.[2]\n\nMany programs offer experiential learning opportunities such as co-op, placements, internships and community service options, while others include a mandatory co-op period prior to graduation. Seneca also offers career search assistance to graduating students. Seneca College programs are developed and kept current with the assistance of advisory committees made up of key industry members. They are in place to ensure the education students receive provides the skills necessary for career success.\n\nSeneca College is the leader in Ontario in university and college pathways. It has more than 70 transfer agreements with both local and international post-secondary institutions, including universities in Australia, England, South Africa and the U.S. These agreements allow students to apply their college education to obtain credit towards a university degree.\n\n', '123 456 7890', 'Toronto', '43.795', '-79.350', '{\"M_S\":\"09:00\",\"M_E\":\"12:00\",\"T_S\":\"09:00\",\"T_E\":\"12:00\",\"W_S\":\"08:00\",\"W_E\":\"20:00\",\"R_S\":\"09:00\",\"R_E\":\"23:00\",\"F_S\":\"10:00\",\"F_E\":\"23:00\",\"S_S\":\"10:00\",\"S_E\":\"21:00\",\"N_S\":\"10:00\",\"N_E\":\"12:00\"}', '9', 1, '2017-03-12 20:12:35', 1, 0),
(39, 3, 1, 'CN Tower Restaurant', 'features/restaurants/images/place58d7350eb8c12.jpg', 'The CN Tower (French: Tour CN) is a 553.3 m-high (1,815.3 ft) concrete communications and observation tower in downtown Toronto, Ontario, Canada.[3][6] Built on the former Railway Lands, it was completed in 1976, becoming the world\'s tallest free-standing structure and world\'s tallest tower at the time. It held both records for 34 years until the completion of Burj Khalifa and Canton Tower in 2010. It is now the third tallest tower in the world and remains the tallest free-standing structure in the Western Hemisphere, a signature icon of Toronto\'s skyline, and a symbol of Canada,[7][8] attracting more than two million international visitors annually.[5][9]\r\n\r\nIts name \"CN\" originally referred to Canadian National, the railway company that built the tower. Following the railway\'s decision to divest non-core freight railway assets, prior to the company\'s privatization in 1995, it transferred the tower to the Canada Lands Company, a federal Crown corporation responsible for real estate development. Since the name CN Tower became common in daily usage, the abbreviation was eventually expanded to Canadian National Tower or Canada\'s National Tower. However, neither of these names is commonly used.[10]\r\n\r\nIn 1995, the CN Tower was declared one of the modern Seven Wonders of the World by the American Society of Civil Engineers. It also belongs to the World Federation of Great Towers, where it holds second-place ranking.[11][12][5]', '647 999 5555', '301 Front St W, Toronto, ON M5V 2T6', '43.642735', '-79.387096', '{\"M_S\":\"09:00\",\"M_E\":\"22:30\",\"T_S\":\"09:00\",\"T_E\":\"22:30\",\"W_S\":\"09:00\",\"W_E\":\"22:30\",\"R_S\":\"09:00\",\"R_E\":\"22:30\",\"F_S\":\"09:00\",\"F_E\":\"22:30\",\"S_S\":\"09:00\",\"S_E\":\"22:30\",\"N_S\":\"09:00\",\"N_E\":\"22:30\"}', '0', 1, '2017-03-25 23:19:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_categories`
--

CREATE TABLE `restaurants_categories` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants_categories`
--

INSERT INTO `restaurants_categories` (`id`, `title`, `publish_date`) VALUES
(1, 'Cafe', '2017-03-12 19:59:53'),
(2, 'Restaurant', '0000-00-00 00:00:00'),
(3, 'Nightlife', '2017-03-12 20:01:50'),
(4, 'Pub', '2017-03-12 20:02:18'),
(5, 'Bakery', '2017-03-12 20:02:43'),
(6, 'Fast food', '2017-03-12 20:03:21'),
(7, 'Smth', '2017-03-12 20:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `visit_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(10) NOT NULL,
  `global_type` int(11) NOT NULL DEFAULT '4',
  `cat_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `trip_location` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '0',
  `posted_by` int(10) NOT NULL,
  `posted_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `global_type`, `cat_id`, `title`, `image`, `description`, `date_start`, `date_end`, `items`, `trip_location`, `lat`, `lng`, `rating`, `posted_by`, `posted_date`, `status`) VALUES
(6, 4, 1, 'Good', NULL, 'Nexxt', '0012-02-12', '0212-02-11', '{\"places\":\"[39,41,40]\",\"events\":\"[39,2]\",\"cafes\":\"[1]\"}', 'Toronto, ON, Canada', '43.653226', '-79.38318429999998', '0', 1, '2017-04-12 01:13:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trip_categories`
--

CREATE TABLE `trip_categories` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_categories`
--

INSERT INTO `trip_categories` (`id`, `title`, `publish_date`) VALUES
(1, 'Entertainment', '2017-03-12 19:59:53'),
(2, 'Historical', '0000-00-00 00:00:00'),
(3, 'Trip cat 3', '2017-03-12 20:01:50'),
(4, 'Trip cat4', '2017-03-12 20:02:18'),
(5, 'Trip cat 5', '2017-03-12 20:02:43'),
(6, 'Shop & Service', '2017-03-12 20:03:21'),
(7, 'Trip cat 6', '2017-03-12 20:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `created`, `modified`, `status`) VALUES
(1, 'Bohdan', 'Mostytskyy', 'bodiamost@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:31:25', '2017-03-26 04:31:25', '1'),
(2, 'Bohdan', 'Mostytskyy', 'bodiamost@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:32:41', '2017-03-26 04:32:41', '1'),
(3, 'Bohdan', 'Mostytskyy', 'bodiamost@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:34:17', '2017-03-26 04:34:17', '1'),
(4, 'Bohdan', 'Mostytskyy', 'bodiamost@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:35:07', '2017-03-26 04:35:07', '1'),
(5, 'Bohdan', 'Mostytskyy', 'bodiamost111@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:53:20', '2017-03-26 04:53:20', '1'),
(6, 'Bohdan', 'Mostytskyy', 'bodiamost1234@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:55:03', '2017-03-26 04:55:03', '1'),
(7, 'Bohdan', 'Mostytskyy', 'bodiamost111111@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 04:59:45', '2017-03-26 04:59:45', '1'),
(8, 'Bohdan', 'Mostytskyy', 'bodiamos11111111111111t@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6479094347', '2017-03-26 05:11:07', '2017-03-26 05:11:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(10) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `loadness` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `item_type_id`, `item_id`, `user_id`, `date`, `duration`, `loadness`) VALUES
(1, 1, 1, 1, '2017-03-22 09:21:26', 100, 2),
(30, 3, 1, 1, '121212-12-12T00:12', 12, 1),
(31, 4, 1, 1, 'none', 0, 0),
(32, 1, 40, 1, '212121-02-11T02:12', 10, 10),
(33, 1, 39, 1, '212121-02-11T02:12', 10, 10),
(34, 1, 40, 1, '212121-02-11T02:12', 10, 10),
(35, 1, 39, 1, '212121-02-11T02:12', 10, 10),
(36, 1, 40, 1, '212121-02-11T02:12', 10, 10),
(37, 1, 39, 1, '212121-02-11T02:12', 10, 10),
(38, 1, 39, 1, '212121-02-11T02:12', 10, 10),
(39, 1, 40, 1, '212121-02-11T02:12', 10, 10),
(40, 1, 39, 1, '2071-12-12T00:12', 1, 1),
(41, 4, 1, 1, 'none', 0, 0),
(42, 1, 1, 2, '2005-03-01T12:05', 2, 2),
(43, 1, 2, 2, '2017-03-03T12:12', 10, 10),
(44, 1, 39, 2, '1222-02-12T00:12', 1, 1),
(45, 1, 39, 2, '0221-02-11T02:12', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums1`
--
ALTER TABLE `albums1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_categories`
--
ALTER TABLE `events_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places_categories`
--
ALTER TABLE `places_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants_categories`
--
ALTER TABLE `restaurants_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_visits_fk` (`visit_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_categories`
--
ALTER TABLE `trip_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_users_fk` (`user_id`),
  ADD KEY `visits_itemtypes_fk` (`item_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums1`
--
ALTER TABLE `albums1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `events_categories`
--
ALTER TABLE `events_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `places_categories`
--
ALTER TABLE `places_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `restaurants_categories`
--
ALTER TABLE `restaurants_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `trip_categories`
--
ALTER TABLE `trip_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_itemtypes_fk` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`type_id`),
  ADD CONSTRAINT `visits_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
